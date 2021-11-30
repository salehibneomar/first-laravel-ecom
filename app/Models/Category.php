<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'status',
        'parent_id',
    ];

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function subcategories(){
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function tree(){
        return $this->hasMany(Category::class, 'parent_id', 'id')->with('subcategories');
    }

    public function backtree(){
        return $this->belongsTo(Category::class, 'parent_id', 'id')->with('parent');
    }

    
}
