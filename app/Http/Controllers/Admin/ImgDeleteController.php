<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Image;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;



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

    public function imgProductRemove(Request $request)
    {
        $product = Product::find($request->id);
        $type = $request->type;
        $pathImg = $product->$type;
        if (Storage::disk('public')->exists(str_replace('storage', '', $product->$type))){
            Storage::disk('public')->delete(str_replace('storage', '', $product->$type));
        }
        $product->$type = null;
        $product->save();
    }

    public function imageProductRemove(Request $request)
    {
        $image = Image::find($request->id);
        if (Storage::disk('public')->exists(str_replace('storage', '', $image->img))){
            Storage::disk('public')->delete(str_replace('storage', '', $image->img));
        }
        if (Storage::disk('public')->exists(str_replace('storage', '', $image->thumbnail))){
            Storage::disk('public')->delete(str_replace('storage', '', $image->thumbnail));
        }
        $image->delete();
    }

    public function imageAllProductRemove(Request $request)
    {
        $images = DB::table('image')->where('product_id', $request->id);
        foreach ($images->get() as $image){
            if (Storage::disk('public')->exists(str_replace('storage', '', $image->img))){
                Storage::disk('public')->delete(str_replace('storage', '', $image->img));
            }
            if (Storage::disk('public')->exists(str_replace('storage', '', $image->thumbnail))){
                Storage::disk('public')->delete(str_replace('storage', '', $image->thumbnail));
            }
        }
        $images->delete();
    }

    public function slideRemove(Request $request)
    {
        $slide = Slider::find($request->id);
        if($request->type == 'background'){
            if (Storage::disk('public')->exists(str_replace('storage', '', $slide->background))){
                Storage::disk('public')->delete(str_replace('storage', '', $slide->background));
            }
            $slide->background = 'img/general/no-slide.jpg';
        }
        if($request->type == 'img'){
            if (Storage::disk('public')->exists(str_replace('storage', '', $slide->img))){
                Storage::disk('public')->delete(str_replace('storage', '', $slide->img));
            }
            $slide->img = null;
        }
        $slide->save();
    }

    public function bannerRemove(Request $request)
    {
        $banner = Banner::find($request->id);
        if (Storage::disk('public')->exists(str_replace('storage', '', $banner->img))){
            Storage::disk('public')->delete(str_replace('storage', '', $banner->img));
        }
        $banner->img = 'img/general/no_banner.jpg';
        $banner->save();
    }






}
