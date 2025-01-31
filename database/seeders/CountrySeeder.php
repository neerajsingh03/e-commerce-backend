<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http; 
use App\Models\Country; 





class CountrySeeder extends Seeder
{
    public function run()
    {
        $response = Http::get('https://restcountries.com/v3.1/all'); 

        $countries = $response->json(); 

        foreach ($countries as $country) {
            Country::create([
                'name' => $country['name']['common'],
                'code' => $country['cca2'] ?? null,
            ]);
        }
    }
}