<?php

namespace App\Http\Controllers\categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\SubCategory;
use App\Models\Product;
class CategoriesController extends Controller
{
    // **************************************ADD CATEGORIES FUNCTION***********************************//
    public function addCategory(Request $request){
        $validator  = Validator::make($request->all(),[
            'name' => 'required|unique:categories',
            'image' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        };
        $categoy = new Categories;

        if($request->hasFile('image')){
            $image = $request->image;
            $imageName = time(). '.' . $image->getClientOriginalExtension();
            $image->move(public_path('categories/image'),$imageName);
            $imageUrl = 'categories/image/' . $imageName;
        }
        $categoy->name = $request->name;
        $categoy->slug =  Str::slug($request->name);
        $categoy->image = $imageUrl;
        $categoy->save();
        return response()->json(['success' => true , 'message' => 'Category added successfully'],200);
    }
    public function getCategories(){
        $allCategories = Categories::all();
        return response()->json(['allCategories' => $allCategories, 'success' =>true],200);
    }

    // **************************************ADD SUB CATEGORIES FUNCTION***********************************//
    public function addSubCategory(Request $request){
        
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
            'category_id'  => 'required',
            'image'        => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        };
        if($request->hasFile('image')){
            $image = $request->image;
            $imageName = time() .'.' . $image->getClientOriginalExtension();
            $image->move(public_path('sub-categories/image'), $imageName);
            $imageUrl = 'sub-categories/image/' . $imageName;
        }
        $subCategory = new SubCategory;
        $subCategory->name = $request->name;
        $subCategory->slug  = Str::slug($request->name);
        $subCategory->description = $request->description;
        $subCategory->image       = $imageUrl;
        $subCategory->category_id  = $request->category_id;
        $subCategory->save();
        return response()->json(['success' => true , 'message' => 'Sub category added successfully'],201);
    }

    // **************************************FIND SUB CATEGORIES FUNCTION***********************************//
    public function fetchSubCategory($id)
    {
        if (!$id) {
            return response()->json(['success' => false, 'message' => 'Empty API data provided'], 400);
        }
        $subCategory = SubCategory::where('category_id', $id)->get();
        if($subCategory->isEmpty()){
            return response()->json(['error' => 'subcategory not found'],404);
        }else{
            return response()->json(['success' => true , 'subcategory' => $subCategory],200);
        }
    }
     // **************************************GET SUB CATEGORIES FUNCTION***********************************//
    public function SubCategories()
    {

        $allSubCategories = SubCategory::with('products')->get();
 
        if(!$allSubCategories->isEmpty()){
            return response()->json(['success' => true , 'allSubCategories' => $allSubCategories],200);
        }
        return response()->json(['error' => 'sub categoires are empty'],404);
    }
}
