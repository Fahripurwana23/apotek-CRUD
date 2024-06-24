<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('profile.profile');
    }
    
    public function changeProfile(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required',
            'email'=> 'required|email',
            'image'=> 'required',
        ]);

        $user = User::find(Auth::user()->id);

        $dataUpdate = [
            'name' => $request->name,
            'email' => $request->email,
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
    
            //Hapus image lama
            $image_path = $user->image;
            if(User::exists($image_path)){
                @unlink($image_path);
            }
    
            //Masukkan path image ke array data
            $dataUpdate['image'] = $path . $nameFile;
        }
    
        User::where('id', Auth::user()->id)->update($dataUpdate);
    
        return redirect()->route('dashboard');
    }
}