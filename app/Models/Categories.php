<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable =[
        'name',
        'slug',
        'image',
    ];
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class); // One category has many subcategories
    }
}
