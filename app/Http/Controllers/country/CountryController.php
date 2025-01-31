<?php

namespace App\Http\Controllers\country;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
class CountryController extends Controller
{
    public function countries(){
        $countries = Country::all();
        if(!$countries){
            return response()->json(['succes' => false, 'msg' => 'countries are empty'],401);
        }
        return response()->json(['success' => true , 'countries' => $countries],200);
    }
}
