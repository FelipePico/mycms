<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Image, Auth, Config, Str, Hash;
use App\User;
class UserController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
    }

    public function getAccountEdit(){
        $birthday = (is_null(Auth::user()->birthday)) ?  [null,null,null] : explode('-', Auth::user()->birthday);
        $data = ['birthday'=>$birthday];
        return view('user.account_edit', $data);
    }

    public function postAccountAvatar(Request $request){
        $rules = [
            'avatar' => 'required'
        ];

        $messages = [
            'avatar.required' => 'Selecciones una imagen'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', '
                se ha producido un error,')->with( 'typealert', 'danger')->withInput();
        else:
            if($request->hasFile('avatar')):
                $path = '/'.Auth::id();
                $fileExt = trim($request->file('avatar')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads_user.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('avatar')->getClientOriginalName()));

                $filename = rand(1,999).'_'.$name.'.'.$fileExt;
                $file_file = $upload_path.'/'.$path.'/'.$filename;

                $u = User::find(Auth::id());
                $aa = $u->avatar;
                $u->avatar = $filename;

                if($u->save()):
                    if($request->hasFile('avatar')):
                        $fl = $request->avatar->storeAs($path, $filename, 'uploads_user');
                        $img = Image::make($file_file);
                        $img->fit(256, 256, function($constraint){
                            $constraint->upsize();
                        });
                        $img->save($upload_path.'/'.$path.'/av_'.$filename);
                    endif;
                    unlink($upload_path.'/'.$path.'/'.$aa);
                    unlink($upload_path.'/'.$path.'/av_'.$aa);
                    return back()->with('message', 'Avatar actualizado con ??xito')->with( 'typealert', 'success');
                endif;

            endif;
        endif;

    }
    public function postAccountPassword(Request $request){
        $rules = [
            'apassword' => 'required|min:8',
            'password' => 'required|min:8',
            'cpassword' => 'required|min:8|same:password'
        ];

        $messages = [
            'apassword.required' => 'Escriba su contrase??a actual',
            'apassword.min' => 'La contrase??a actual debe tener al menos 8 caracteres',
            'password.required' => 'Escriba su nueva contrase??a',
            'password.min' => 'La nueva contrase??a debe tener al menos 8 caracteres',
            'cpassword.required' => 'Confirme su nueva contrase??a',
            'cpassword.min' => 'La confirmaci??n de su nueva contrase??a debe tener al menos 8 caracteres',
            'cpassword.same' => 'Las contrase??as no coinciden'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', '
                se ha producido un error,')->with( 'typealert', 'danger')->withInput();
        else:
            $u = User::find(Auth::id());
            if(Hash::check($request->input('apassword'), $u->password)):
                $u->password = Hash::make($request->input('password')); 
                if($u->save()):
                    return back()->with('message', 'La contrase??a se actualiz?? con ??xito.')->with( 'typealert', 'success');
                endif;
            else:
                return back()->with('message', 'Su contrase??a actual es err??nea.')->with( 'typealert', 'danger');
            endif;
        endif;
    }

    public function postAccountInfo(Request $request){
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required|min:7|max:10',
            'year'=>'required',
            'day'=>'required'
        ];

        $messages = [
            'name.required'=>'Su nombre es requerido',
            'lastname.required'=>'Su apellido es requerido',
            'phone.required'=>'Su n??mero telefonico es requerido',
            'phone.min'=>'El n??mero telefonico debe tener como minimo 7 digitos',
            'phone.max'=>'El n??mero telefonico debe tener como maximo 10 digitos',
            'year.required'=>'El a??o de su nacimiento es requerido',
            'day.required'=>' El d??a de su nacimiento es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', '
                se ha producido un error,')->with( 'typealert', 'danger')->withInput();
        else:
            $date = $request->input('year').'-'.$request->input('month').'-'.$request->input('day');
            $u = User::find(Auth::id());
            $u->name = e($request->input('name'));
            $u->lastname = e($request->input('lastname'));
            $u->phone = e($request->input('phone'));
            $u->birthday = date("Y-m-d", strtotime($date));
            $u->gender = e($request->input('gender'));
            if($u->save()):
                return back()->with('message', 'Su informaci??n se actualiz?? con ??xito.')->with( 'typealert', 'success');
            endif;
        endif;

    }
}
