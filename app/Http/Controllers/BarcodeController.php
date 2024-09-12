<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Tambahkan ini
use Picqer\Barcode\BarcodeGeneratorPNG; // Juga tambahkan ini jika belum diimpor

class BarcodeController extends Controller
{
    public function barcodeIndex(Request $request)
    {
        $generator = new BarcodeGeneratorPNG();
        $image = $generator->getBarcode('081331723987', $generator::TYPE_CODE_128);

        Storage::put('barcodes/barcode.png', $image);

        return response($image)->header('Content-type','image/png');
    }
}
