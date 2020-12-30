<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'image';
    protected $fillable = [
        'product_id',
        'img',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
