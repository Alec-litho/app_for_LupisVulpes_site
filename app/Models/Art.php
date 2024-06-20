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
        'race',
        'art_type',
        'colors_ids',
        'is_animation_clip',
        'is_plushie',
        'is_commission',
        'color_id',
    ];
}
