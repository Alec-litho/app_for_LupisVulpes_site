<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{ 
    use HasFactory;

    protected $fillable = [
        "base_color",
        "original_hue",
        "close_hue_name",
        "close_hue",
        "hsv"
    ];
};
