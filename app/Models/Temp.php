<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temp extends Model
{
    protected $table = 'temp_files';
    public $timestamps = false;
    protected $fillable = [
        'image',
        'thumbnail',
        'original'
    ];
}
