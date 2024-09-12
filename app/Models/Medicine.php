<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable=[
        'type',
        'name',
        'price',
        'stock',
        'id',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($medicine) {
            $medicine->code = self::generateCode();
        });
    }
    
    private static function generateCode()
{
    $prefix = 'P';
    $day = date('d');    // Hari 2 digit
    $month = date('m');  // Bulan 2 digit
    $year = date('y');   // Tahun 2 digit
    
    // Mengambil urutan terakhir
    $lastMedicine = self::whereYear('created_at', date('Y'))
        ->whereMonth('created_at', date('m'))
        ->whereDay('created_at', date('d'))
        ->orderBy('code', 'desc')
        ->first();

    // Ambil urutan terakhir jika ada, jika tidak set ke 0
    $lastNumber = $lastMedicine ? intval(substr($lastMedicine->code, -4)) : 0;

    // Increment urutan dengan menambahkan 1
    $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

    // Menggabungkan prefix, tahun, bulan, dan urutan yang baru
    return "{$prefix}-{$year}-{$month}-{$newNumber}";
}

}
