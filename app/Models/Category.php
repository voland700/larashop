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


}
