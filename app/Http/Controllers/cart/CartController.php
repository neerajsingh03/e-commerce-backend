<?php

namespace App\Http\Controllers\cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
class CartController extends Controller
{
    // **************************************ADD TO CAT FUNCTION***********************************//
    public function addTocart(Request $request){
        $validator = Validator::make($request->all(),[
            'productId' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['error' => 'validation failed'],400);
        }
        $id = $request->productId;
        $quantity = 1;
        $product = Product::find($id);
        $price = $product ? $product->discount_price : $product->price;

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        DB::beginTransaction();

        try {
            // Handle authenticated user cart
            $cart = null;
            if (Auth::check()) {
                $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
            }
    
            // Check if the product is already in the cart
            $cartItem = CartItem::where('cart_id', $cart->id)
                                ->where('product_id', $product->id)
                                ->first();
    
            if ($cartItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product is already in the cart.',
                    'cart' => $cart->load('items.product'),
                    'count' => $cart->items()->count(),
                ]);
            }
    
            // Add product to cart if not already there
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $price,
            ]);
          
            // Commit transaction
            DB::commit();
    
            // Reload cart and return success response
            $cart->load('items.product');
            $itemCount = $cart->items()->count();
    
            return response()->json([
                'success' => true,
                'message' => 'Product added to the cart successfully.',
                'cart' => $cart,
                'count' => $itemCount,
            ]);
    
        } catch (\Exception $e) {
            // Rollback transaction on failure
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'An error occurred. Please try again.'], 500);
        }
    }

    // **************************************USER CART PRODUCT FUNCTION***********************************//
    public function UserCartProducts($userId){
        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Empty API data provided'], 400);
        }
        $cart = Cart::where('user_id', $userId)->first();
        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Cart not found'], 404);
        }
        $userCartProducts = CartItem::where('cart_id', $cart->id)
                                    ->with('product') // Eager load the related product
                                    ->get();
        $totalPrice = CartItem::whereHas('cart', function ($query) use ($userId) {
                                    $query->where('user_id', $userId);
                                })->sum('price');
        return response()->json([
            'success' => true,
            'cartProducts' => $userCartProducts,
            'totalPrice' => $totalPrice
        ], 200);
    }
    // **************************************CART PRODCUT INCREASE AND DECREASE FUNCTION***********************************//
    public function increaseCartQuantity(Request $request){
        
       $validator = $request->validate([
         'cartItemId' => 'required',
       ]);
       if($request->type === 'increase'){
            $id = $request->cartItemId;
            $cartItem = CartItem::find($id);
            $product = Product::where('id',$cartItem->product_id)->first();
            $price = $product ? $product->discount_price : $product->price;
            if(!$cartItem){
            return response()->json(['success' => false ,'message' => 'cart item not found']);
            };
            $cartItem->quantity +=1;
            $cartItem->price = $price * $cartItem->quantity;
            $cartItem->save();
            return response()->json(['success' => true, 'message' => 'cart item increase successfully']);
       }elseif($request->type ==='decrease'){
            $id = $request->cartItemId;
            $cartItem = CartItem::find($id);
            $product = Product::where('id',$cartItem->product_id)->first();
            $price = $product ? $product->discount_price : $product->price;
            if(!$cartItem){
            return response()->json(['success' => false ,'message' => 'cart item not found']);
            };
            if($cartItem->quantity > 1){
                $cartItem->quantity -=1;
                $cartItem->price = $price * $cartItem->quantity;
                $cartItem->save();
                return response()->json(['success' => true, 'message' => 'cart item decrease successfully']);
            }
            return response()->json(['success' => false, 'message' => 'Quantity cannot be less than 1'], 400);
       }
    }

    public function removeUserCartItems(Request $request){
        if (!$request->id) {
            return response()->json(['success' => false, 'message' => 'Empty API data provided'], 400);
        }
        $userId = auth()->id();
        $cartItem = CartItem::where('id', $request->id)->first();
        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Cart item not found'], 400);
        }
        $cartItem->delete();
        $cart = Cart::where('user_id', $userId)->first();
        if (!$cart || $cart->items()->count() === 0) {
            return response()->json(['success' => true, 'count' => '']);
        }
        $itemCount =  $cart->items()->count();
        return response()->json([
            'success' => true,
            'message' => 'Cart item removed successfully',
            'count' => $itemCount
        ], 200);
    }
}
