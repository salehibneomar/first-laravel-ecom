<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerSlider extends Model
{
    use HasFactory;

    protected $fillable = [
        'short_note',
        'normal_title',
        'colored_title',
        'short_description',
        'image',
        'status',
    ];
}
