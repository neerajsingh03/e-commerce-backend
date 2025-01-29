<?php

namespace App\Http\Controllers\cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
class CartController extends Controller
{
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
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            if (!$cart) {
                $cart = Cart::create([
                    'user_id' => Auth::id(),
                ]);
            }
        }
        $cartItem = CartItem::where('product_id',$product->id)
        ->where('product_id', $product->id)
        ->first();

        if ($cartItem) {
            return response()->json([
                'message' => 'Product is already in the cart.',
                'cart' => $cart->load('items.product')
            ]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->discount_price,
            ]);
        }
        return response()->json([
            'message' => 'Product added to the cart successfully.',
            'cart' => $cart->load('items.product'),
        ]);
    }

    public function UserCartProducts($userId){
        if(!$userId){
            return response()->json(['success' => false, 'message' => 'Empty API data provided'], 400);
        };
        $userCartProducts = Cart::where('user_id',$userId)->with('items.product')->get();
        if(!$userCartProducts->isEmpty()){
            return response()->json(['success' => true, 'cartProducts' => $userCartProducts],200);
        }
        return response()->json(['success' => false, 'message' => 'User cart product is empty'], 400);
    }
    public function countUserItems()
    {
        $id = auth()->user()->id;
        if(!$id){
            return response()->json(['success' => false, 'message' => 'User not found'], 400);
        }
        $cart = Cart::where('user_id',$id)->first();
        if($cart){
            $itemCount = $cart->items()->count();
            if($itemCount){
                return response()->json(['count' => $itemCount]);
            }
        }
    }
}
