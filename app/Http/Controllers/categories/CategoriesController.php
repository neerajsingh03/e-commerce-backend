<?php

namespace App\Http\Controllers\categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\SubCategory;
class CategoriesController extends Controller
{
    public function index(Request $request){
      
      
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
            $image->move(public_path('subCategory/image'), $imageName);
            $imageUrl = 'subCategory/image' . $imageName;
        }
        $subCategory = new SubCategory;
        $subCategory->name = $request->name;
        $subCategory->slug  = Str::slug($request->name);
        $subCategory->description = $request->description;
        $subCategory->image       = $imageUrl;
        $subCategory->category_id  = $request->category_id;
        $subCategory->save();
        return response()->json(['success' => true , 'message' => 'Sub category added successfully'],200);
    }

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
}
