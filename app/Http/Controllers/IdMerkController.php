<?php

namespace App\Http\Controllers;

use App\Models\id_merk; // Ubah ini ke IdMerk
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;


class IdMerkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_merk = id_merk::all();
        return view('id_merk.index', compact('id_merk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('id_merk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'logo' => 'required|file|mimes:jpg,jpeg,png',
        'status' => 'required',
        'created_by' => 'required',
        'updated_by' => 'required',
    ]);

    $datamerk = [
        'name' => $request->name,
        'logo' => '',
        'status' => ($request->status == '1') ? 1 : 0, // Mengubah string '1' atau '0' menjadi integer 1 atau 0
        'created_by' => $request->created_by,
        'updated_by' => $request->updated_by, 
    ];

    if ($request->hasFile('logo')) {
        $image = $request->file('logo');
        $username = strtolower(str_replace(' ', '-', $request->name));
        $nameFile = $username . '-' . time() . '.' . $image->getClientOriginalExtension();
        $path = 'uploads/logomerk/';
        $image->move(public_path($path), $nameFile);
        $datamerk['logo'] = $path . $nameFile;
    }

    id_merk::create($datamerk);

    return redirect()->route('merk.home')->with('success', 'Berhasil menambah data merk');
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(id_merk $id_merk)
    {
        return view('id_merk.edit', compact('id_merk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, id_merk $id_merk)
    {
        $request->validate([
            'name' => 'required|min:3',
            'logo' => 'nullable|file|mimes:jpg,jpeg,png',
            'created_by' => 'required',
            'updated_by' => 'required',
        ]);

        $datamerk = [
            'name' => $request->name,
            'created_by' => $request->created_by,
            'updated_by' => $request->updated_by,
        ];

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');

            // Ubah nama pengguna menjadi huruf kecil dan ganti spasi dengan tanda '-'
            $username = strtolower(str_replace(' ', '-', $request->name));

            // Nama file baru
            $nameFile = $username . '-' . time() . '.' . $image->getClientOriginalExtension();

            // Path upload
            $path = 'uploads/logomerk/';
            $image->move(public_path($path), $nameFile);

            // Masukkan path image ke array data
            $datamerk['logo'] = $path . $nameFile;
        } else {
            $datamerk['logo'] = $id_merk->logo;
        }

        $id_merk->update($datamerk);

        return redirect()->route('merk.home')->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(id_merk $id_merk)
    {
        $id_merk->delete();

        return redirect()->back()->with('deleted','Berhasil menghapus data');
    }
    
    public function updateStatus(Request $request, id_merk $id_merk)
{
    $request->validate([
        'status' => 'required|integer',
    ]);

    $id_merk->update([
        'status' => $request->status,
    ]);

    $message = $request->status ? 'Berhasil mengubah menjadi active' : 'Berhasil mengubah menjadi inactive';
    
    return redirect()->route('merk.home')->with('success', $message);
}
}
