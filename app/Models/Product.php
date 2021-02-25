<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'name',
        'slug',
        'active',
        'hit',
        'new',
        'stock',
        'advice',
        'sort',
        'category_id',
        'h1',
        'meta_title',
        'meta_description',
        'prev',
        'description',
        'img',
        'prev_img',
        'base_price',
        'price',
        'currency',
        'properties'
    ];

    protected $casts = [
        'properties' => 'array',
    ];


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

    public function discount()
    {
        return $this->belongsToMany(Discount::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function advantages()
    {
        return $this->belongsToMany(Advantage::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    //Accessors

    public function getPhotoAttribute()
    {
        return (!$this->img==NULL) ? $this->img : 'img/general/no-photo.jpg';
    }

    public function getPrevPhotoAttribute()
    {
        return (!$this->prev_img==NULL) ? $this->prev_img : 'img/general/no-photo_thumbnail.jpg';
    }





}
