<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currency';
    protected $primaryKey = 'currency';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'currency',
        'CharCode',
        'Name',
        'Nomina',
        'Date'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'currency', 'currency');
    }
}
