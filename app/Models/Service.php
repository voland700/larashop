<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'service';
    protected $guarded = [];
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
