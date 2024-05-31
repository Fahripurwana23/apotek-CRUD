<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserDataController extends Controller
{
    public function index()
    {
        // Mengambil data pengguna dengan pagination
        $users = User::paginate(10); // Mengambil 10 data per halaman
        return view('user-data', compact('users'));
    }
}
