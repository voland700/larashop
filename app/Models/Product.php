<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;



class Product extends Model
{
    use Sluggable;

    protected $table = 'product';
    protected $fillable = [
        'name',
        'slug',
        'active',
        'sort',
        'category_id',
        'h1',
        'meta_title',
        'meta_description',
        'prev',
        'description',
        'img',
        'prev_img',
        'price',
        'currency'
    ];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function currency()
    {
        return $this->hasOne('App\Models\Currency', 'currency', 'currency');
    }

    public function attribute()
    {
        return $this->hasMany(Attribute::class);
    }

    public function image()
    {
        return $this->hasMany(Image::class);
    }









}
