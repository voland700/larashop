<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';
    protected $fillable = [
        'name',
        'active',
        'sort',
        'img',
        'text',
        'position',
        'color',
        'background'
    ];
}
