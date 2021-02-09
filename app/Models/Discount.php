<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';
    protected $fillable = [
        'name',
        'type',
        'value',
        'active',
        'sort',
        'categories'
    ];
    protected $casts = [
        'categories' => 'array'
    ];
    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}

