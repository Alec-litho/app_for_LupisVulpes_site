<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Art extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'link',
        'year',
        'text',
        'characters',
        'fandom',
        'show',
        'art_type',
        'colors_ids',
        'is_plushie',
        'is_commission',
        'color_id',
    ];
}
