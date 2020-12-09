<?php

namespace App\Models;

;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use Sluggable;
    protected $table = 'categories';
    protected $fillable = [
        'created_at',
        'updated_at',
        'category_id',
        'name',
        'slug',
        'active',
        'sort',
        'h1',
        'meta_title',
        'meta_description',
        'description',
        'img',
        'prev_img'
    ];
    // get - рекурсия вложенных категроий
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class)->with('categories');
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

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



}
