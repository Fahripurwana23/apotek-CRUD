<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrderExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::with('user')->get();
    }
    // heading nama-nama th dari file excel
    public function headings(): array
    {
        return [
            "Nama Pembeli", "Obat", "Total Bayar", "Kasir", "Tanggal"
        ];
    }
    // map: data yang akan dimunculkan di excelnya (sama kaya foreach di blade)
    public function map($item): array
    {
        $dataObat = '';
    
        // Periksa apakah $item->medicines adalah array
        if (is_array($item->medicines)) {
            foreach ($item->medicines as $value) {
                // Ubah object/array data dari column medicines menjadi string dengan hasil: vitamin A (qty 2: Rp. 18.000),
                $format = $value["nama_medicine"] . " (qty" . $value['qty'] . ": Rp." . number_format($value['sub_price']) . "),";
                $dataObat .= $format;
            }
        }
    
        return [
            $item->name_customer,
            $dataObat,
            $item->total_price,
            $item->user->name,
            \Carbon\Carbon::parse($item->created_at)->isoFormat('YYYY-MM-DD HH:mm:ss'),
        ];
    }
    
}