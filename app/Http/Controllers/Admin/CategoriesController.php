<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Str, Config;
use App\Http\Models\Category;

class CategoriesController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getHome($module){
        $cats = Category::where('module', $module)->orderBy('name', 'Asc')->get();
        $data = ['cats' => $cats];
        return view('admin.categories.home', $data);
    }

    public function postCategoryAdd(Request $request){

        $rules = [
            'name' => 'required',
            'icon' => 'required'

        ];
        $messages = [
            'name.required' => 'Se requiere un nombre de la categoria.',
            'icon.required' => 'Se requiere de un icono para la categoria.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', '
                se ha producido un error,')->with( 'typealert', 'danger');
        else:
            $path = '/'.date('Y-m-d');
            $fileExt = trim($request->file('icon')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('icon')->getClientOriginalName()));
            $filename = rand(1,999).'-'.$name.'.'.$fileExt;

            $c = new Category;
            $c->module = $request->input('module');
            $c->name = e($request->input('name'));
            $c->slug = Str::slug($request->input('name'));
            $c->file_path = date('Y-m-d');
            $c->icono = $filename;
            if($c->save()):
                if($request->hasFile('icon')):
                    $fl = $request->icon->storeAs($path, $filename, 'uploads');
                endif;
                return back()->with('message', 'Guardado con exito')->with( 'typealert', 'success');
            endif;
        endif;

    }

    public function getCategoryEdit($id){
        $cat = Category::find($id);
        $data = ['cat' => $cat];
        return view('admin.categories.edit', $data);
    }

     public function postCategoryEdit(Request $request, $id){

        $rules = [
            'name' => 'required'

        ];
        $messages = [
            'name.required' => 'Se requiere un nombre de la categoria.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', '
                se ha producido un error,')->with( 'typealert', 'danger');
        else:
            

            $c = Category::find($id);
            $c->module = $request->input('module');
            $c->name = e($request->input('name'));
            $c->slug = Str::slug($request->input('name'));
            if($request->hasFile('icon')):
                $actual_icon = $c->icono;
                $actual_file_path = $c->file_path;
                $path = '/'.date('Y-m-d');
                $fileExt = trim($request->file('icon')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('icon')->getClientOriginalName()));
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $fl = $request->icon->storeAs($path, $filename, 'uploads');
                $c->file_path = date('Y-m-d');
                $c->icono = $filename;
                if(!is_null($actual_icon)):
                    unlink($upload_path.'/'.$actual_file_path.'/'.$actual_icon);
                endif;
            endif;
            if($c->save()):
                return back()->with('message', 'Se editó con éxito')->with( 'typealert', 'success');
            endif;
        endif;

    }

    public function getCategoryDelete($id){
        $c = Category::find($id);
        if($c->delete()):
            return back()->with('message', 'Se eliminó con éxito')->with( 'typealert', 'success');
        endif;
    }
}
