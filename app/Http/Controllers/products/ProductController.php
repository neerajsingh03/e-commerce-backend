<?php

namespace App\Http\Controllers\products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Product;
class ProductController extends Controller
{
     // **************************************ADD PRODUCT FUNCTION***********************************//
     public function addProduct(Request $request){
      
        $validator = Validator::make($request->all(),[
            'selectedSubcategory' => 'required',
            'name'                => 'required',
            'price'               => 'required',
            'discountPrice'       => 'required',
            'stockQuantity'       => 'required',
            'image'               => 'required',
            'description'         =>  'required',
        ]);
        if($validator->fails()){
            return response()->json(['error' => 'validation failed'],400);
        }
        if($request->hasFile('image')){
            $image = $request->image;
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/products/image'),$imageName);
            $imageUrl = 'products/image/'. $imageName;
        }
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $counter = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $sku = strtoupper(substr($request->name, 0, 3)) . rand(100, 999); 
        $product = new Product;
        $product->name = $request->name;
        $product->slug = $slug;
        $product->price = $request->price;
        $product->subcategory_id = $request->selectedSubcategory;
        $product->discount_price = $request->discountPrice;
        $product->description     = $request->description;
        $product->stock           = $request->stockQuantity;
        $product->sku             = $sku;
        $product->image           = $imageUrl;
        $product->save();
        return response()->json(['success' => true ,'msg' => 'Product created successfully'], 201);
    }
    //******************************FETCH PRODUCT FUNCTION******************************* //
    public function fetchProduct($id){
        if(!$id){
            return response()->json(['success' => false, 'message' => 'Empty API data provided'], 400);
        }
        $topRatedProduct = Product::max('price');
        
        $products = Product::where('subcategory_id',$id)->get();
        if($products->isEmpty()){
            return response()->json(['success' => false, 'msg' => 'product not found'],404);
        }
        return response()->json(['success' => true, 'msg' => 'product fetch successfully','products' =>$products,'maxprice' => $topRatedProduct],200);
    }
     // **************************************GET PRODUCTS AND PRODUCT FUNCTION***********************************//

     public function products($slug = null){
        if($slug){
            $product = Product::where('slug',$slug)->first();
            return response()->json(['success' => true , 'product' => $product],200);
        }
        $products = Product::all();
        if(!$products->isEmpty()){
            return response()->json(['success' => true , 'products' => $products],200);
        }
        return response()->json(['error' => 'products are empty'],404);
    }
}
