<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderIcon extends Model
{
    protected $table = 'slider_icon';
    protected $fillable = [
        'name',
        'active',
        'sort',
        'img',
        'link'
    ];
}
