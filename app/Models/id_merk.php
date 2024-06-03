<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class id_merk extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'name',
        'logo',
        'status',
        'created_by',
        'updated_by',
    ];
}
