<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class ImgDeleteController extends Controller
{
    public function category_img(Request $request){
        $id = $request->id;
        $field = $request->field;
        $category = Category::find($id);
        if (Storage::disk('public')->exists(str_replace('storage', '', $category->$field))){
            Storage::disk('public')->delete(str_replace('storage', '', $category->$field));
        }
        $category->$field = NULL;
        $category->update();
        return true;
    }
}
