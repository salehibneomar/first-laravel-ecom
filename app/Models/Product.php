<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'price',
        'discount',
        'code',
        'quantity',
        'condition',
        'status',
        'image',
        'is_featured',
        'short_description',
        'long_description',
        'brand_id',
        'category_id',
    ];

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function brand(){
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

}
