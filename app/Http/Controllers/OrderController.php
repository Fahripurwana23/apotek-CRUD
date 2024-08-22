<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Order;
use Barryvdh\DomPDF\PDF as DomPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Excel;
use App\Exports\OrderExport;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('user')->simplePaginate(10);
        return view('kasir.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medicines = Medicine::all();
        return view('kasir.create', compact('medicines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_customer' => 'required',
            'medicines' => 'required|array',
            'quantities' => 'required|array',
            'quantities.*' => 'required|numeric|min:1',
        ]);
    
        $arrayAssocMedicines = [];
    
        foreach ($request->medicines as $index => $id) {
            $medicine = Medicine::find($id);
            $count = $request->quantities[$index];
    
            if ($medicine->stock < $count) {
                return redirect()->back()->with('error', 'Stock obat tidak mencukupi untuk obat: ' . $medicine->name);
            }
    
            $subPrice = $medicine->price * $count;
    
            $arrayItem = [
                "id" => $id,
                "name_medicine" => $medicine->name,
                "qty" => $count,
                "price" => $medicine->price,
                "sub_price" => $subPrice,
            ];
    
            array_push($arrayAssocMedicines, $arrayItem);
    
            // Kurangi stok obat
            $medicine->stock -= $count;
            $medicine->save();
        }
    
        $totalPrice = 0;
        foreach ($arrayAssocMedicines as $item) {
            $totalPrice += (int)$item['sub_price'];
        }
    
        $priceWithPPN = $totalPrice + ($totalPrice * 0.1);
    
        $proses = Order::create([
            'user_id' => Auth::user()->id,
            'medicines' => json_encode($arrayAssocMedicines),
            'name_customer' => $request->name_customer,
            'total_price' => $priceWithPPN,
        ]);
    
        if ($proses) {
            $order = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->first();
            return redirect()->route('print', $order->id);
        }
    }
    

    /*
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view('kasir.print', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        if ($order) {
            $order->delete();
            return redirect()->route('index')->with('success', 'Data berhasil dihapus');
        }

        return redirect()->route('index')->with('error', 'Data tidak ditemukan');
    }

    public function downloadPDF($id)
    {
        $order = Order::find($id)->toArray();
        view()->share('order', $order);
        $pdf = PDF::loadView('kasir.print', $order);
        return $pdf->download('receipt.pdf');
    }

    public function data()
    {
        $orders = Order::with('user')->simplePaginate(5);
        return view ('kasir.index2', compact('orders'));
    }
    
    public function exportExcel()
    {
        $file_name = 'data_pembelian'.'.xlsx';
        return Excel::download(new OrderExport, $file_name);
    }
}
