<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'categories';
    protected $guarded = [];
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
