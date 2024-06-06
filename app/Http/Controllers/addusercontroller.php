<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class addusercontroller extends Controller
{
    public function adduser()
    {
        return view('adduser');
    }
    public function adduserSave(Request $request)
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
        return redirect()->route('medicine.home');
    }
}