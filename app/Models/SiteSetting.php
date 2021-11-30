<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'logo',
        'tab_icon',
        'email',
        'phone',
        'address',
    ];
}
