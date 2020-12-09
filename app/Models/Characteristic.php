<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    protected $table = 'characteristic';
    protected $fillable = [
        'product_id',
        'attribute_id',
        'value'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function attribute()
    {
        return $this->hasOne(Attribute::class);
    }

}
