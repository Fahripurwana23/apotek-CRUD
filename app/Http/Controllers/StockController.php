<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Medicine;
class StockController extends Controller
{
   
    public function stock()
    {
        $medicines = Medicine::orderBy('stock', 'ASC')->get();
        //dd($medicines); // Dump dan die untuk memeriksa isi dari $medicines
        return view('medicines.stock', compact('medicines'));
    }
}
