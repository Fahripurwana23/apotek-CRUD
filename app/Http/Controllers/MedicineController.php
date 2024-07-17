<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Models\User;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicines =Medicine::all();
        return view('medicines.index',compact('medicines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medicines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'type' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        Medicine::create([
            'name' =>$request->name,
            'type' => $request->type,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        // atau jika seluruh data input akan di masukan ke db bisa dengan printah medicine:::create($request->all());

        return redirect('medicine')->with('success','Berhasil menambah data obat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit($id)
{
    $medicines = Medicine::find($id);
    if (!$medicines) {
        return redirect()->route('medicine.home')->with('error', 'Data not found');
    }
    return view('medicines.edit', compact('medicines'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'type' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        Medicine::where('id', $id)->update([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);


        return redirect()->route('medicine.home')->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Medicine::where('id', $id)->delete();

        return redirect()->back()->with('deleted','Berhasil menghapus data');
    }

    public function stock($id)
    {
        $medicines = Medicine::orderBy('stock', 'ASC')->get();
        //dd($medicines); // Dump dan die untuk memeriksa isi dari $medicines
        return view('medicines.stock', compact('medicines'));
    }
}
