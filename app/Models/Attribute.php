<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\isNan;

class Attribute extends Model
{
    protected $table = 'attribute';
    protected $fillable = [
        'name',
        'sort'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function setSortAttribute($value)
    {
        if(!is_null((int)$value)){
            $this->sort = $value;
        } else {
            $this->sort = 200;
        }
    }
}
