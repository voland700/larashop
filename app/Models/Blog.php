<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog';
    protected $guarded = [];
    public function gallery()
    {
        return $this->hasMany(Gallery::class);
    }
}
