<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Support\Str;

class Category extends Model
{
    use NodeTrait;


    protected $table = 'categories';
    protected $fillable = [
        'created_at',
        'updated_at',
        'parent_id',
        '_lft ',
        '_rgt ',
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

    //Accessors
    public function getImageAttribute()
    {
        return (!$this->img==NULL) ? $this->img : 'storage/upload/images/general/no-photo.jpg';
    }

    public function getThumbnailAttribute()
    {
        return (!$this->prev_img==NULL) ? $this->prev_img : 'storage/upload/images/general/no-photo_thumbnail.jpg';
    }

}
