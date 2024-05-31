<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Medicine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    
    public function register()
    {
        return view('auth/register');
    }
    public function registerSave(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'image'=> 'required',
            'email' => 'required|email|unique:users',
            'password'=> [
                'required',
                'confirmed',
                'min:8',
                'max:15',
                'regex:/[A-Z]/','regex:/[a-z]/','regex:/[0-9()<>?]/',]
            ],[
                'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number',
        ]);

        $dataRegister = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => ""
        ];

        if($request->has('image')){
            $image = $request->file('image');

            // Ubah nama pengguna menjadi huruf kecil dan ganti spasi dengan tanda '-'
            $username = strtolower(str_replace(' ', '-', $request->name));

            //capture.jpg
            $nameFile = $username . '-' . time() . '.' . $image->getClientOriginalExtension();

            //Path upload
            $path = 'uploads/userpicture/';
            $image->move($path, $nameFile);

            //Masukkan path image ke array data
            $dataRegister['image'] = $path . $nameFile;
        }

        User::create($dataRegister);

        return redirect()->route('login');
    }

    public function login()
    {
        return  view('auth/login');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email'=> 'required|email',
            'password'=> 'required',
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth,failed')
            ]);
        }
        
        $request->session()->regenerate();
        
            return redirect()->route('medicine.home');
        
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return redirect('/login');
    }
}