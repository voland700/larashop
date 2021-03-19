<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequestValidate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $h1 = 'Предложения услуг';
        $services = Service::orderBy('sort', 'asc')->paginate(20);
        return view('admin.services_index', compact('h1', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $h1 = 'Создание нового предложения услуг';
        return view('admin.services_create', compact('h1'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequestValidate $request)
    {
        $service = new Service($request->all());
        $service->active = $request->has('active') ? 1 : 0;
        if($request->hasFile('img')) {
            $image = $request->file('img');
            $fileName =  time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/upload/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileName);
            $service->img = 'storage'.$path_to.'/'.$fileName;
        }
        if($request->hasFile('prev_img')) {
            $image = $request->file('prev_img');
            $fileName =  time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/upload/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileName);
            $service->prev_img = 'storage'.$path_to.'/'.$fileName;
        }
        $service->save();
        return redirect()->route('services.index')->with('success', 'Предложение услуг создано');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $h1 = 'Редактирование предложения услуг';
        $service = Service::find($id);
        return view('admin.services_update', compact('h1', 'service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequestValidate $request, $id)
    {
        $service = Service::find($id);
        $data = $request->all();
        $data['active'] = $request->has('active') ? 1 : 0;
        if ($request->hasFile('img')) {
            if (Storage::disk('public')->exists(str_replace('storage', '', $service->img))){
                Storage::disk('public')->delete(str_replace('storage', '', $service->img));
            }
            $image = $request->file('img');
            $fileName =  time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/upload/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileName);
            $data['img'] = 'storage'.$path_to.'/'.$fileName;
        }
        if ($request->hasFile('prev_img')) {
            if (Storage::disk('public')->exists(str_replace('storage', '', $service->prev_img))){
                Storage::disk('public')->delete(str_replace('storage', '', $service->prev_img));
            }
            $image = $request->file('prev_img');
            $fileName =  time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/upload/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileName);
            $data['prev_img'] = 'storage'.$path_to.'/'.$fileName;
        }
        $service->update($data);
        return redirect()->route('services.index')->with('success', 'Данные предложения обнавлены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        if (Storage::disk('public')->exists(str_replace('storage', '', $service->img))){
            Storage::disk('public')->delete(str_replace('storage', '', $service->img));
        }
        if (Storage::disk('public')->exists(str_replace('storage', '', $service->prev_img))){
            Storage::disk('public')->delete(str_replace('storage', '', $service->prev_img));
        }
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Предложение услуг удалено');
    }

    public function ServiceImgRemove(Request $request)
    {
        $service = Service::find($request->id);
        $type = $request->type;
        $imageFile = $service->$type;
        if (Storage::disk('public')->exists(str_replace('storage', '', $imageFile))){
            Storage::disk('public')->delete(str_replace('storage', '', $imageFile));
        }
        $service->$type = null;
        $service->save();
    }

}
