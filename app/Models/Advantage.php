<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Advantage extends Model
{
    protected $table = 'advantage';
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
