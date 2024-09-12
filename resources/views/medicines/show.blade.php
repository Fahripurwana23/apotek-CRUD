@extends('layouts.template')

@section('content')

<h1>Detail Medicine</h1>
<table class="table table-bordered">
    <tr>
        <th>Nama</th>
        <td>{{ $medicine->name }}</td>
    </tr>
    <tr>
        <th>Tipe</th>
        <td>{{ $medicine->type }}</td>
    </tr>
    <tr>
        <th>Harga</th>
        <td>{{ $medicine->price }}</td>
    </tr>
    <tr>
        <th>Stok</th>
        <td>{{ $medicine->stock }}</td>
    </tr>
    <tr>
        <th>Kode</th>
        <td>{{ $medicine->code }}</td>
    </tr>
    <tr>
        <th>Barcode</th>
        <td>{!! $barcode !!}</td> <!-- Menampilkan barcode -->
    </tr>
</table>
<a href="{{ route('medicine.home') }}" class="btn btn-secondary">Kembali</a>

@endsection
