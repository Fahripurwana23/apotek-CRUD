@extends('layouts.template')
@section('content')
<div class="my-5 d-flex justify-content-end" >
    <a href="" class="btn btn-primary"> Export Data (excel)</a>
</div>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>NO</th>
            <th>Pembeli</th>
            <th>Obat</th>
            <th>Kasir</th>
            <th>Tanggal Pembelian</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order )
        <tr>
            {{-- menampilkan angka ururtan berdasarkan pagnite (digunakan ketika mengambil data  dengan paginte/simplepaginite) --}}
            <td>{{ ($orders->currentpage()-1 * $orders->perpage() + $loop->$index + 1) }}</td>
            <td>{{ $order->name_cutomer }}</td>
            <td>
            {{-- nested loop : didalam looping ada looping --}}
            {{-- karna column medicines tipe datanya berbentuk array json, maka untuk mengakses nya perlu di looping jg --}}
            <ol>
                @foreach ($order['medicines'] as $medicine )
                    <li>
                        {{--  hasil yang di inginkan : --}}
                        {{-- 1. nama obat('3000') : Rp 15000 qty5 --}}
                        {{ $medicine['name_medicine'] }}
                        ( Rp. {{ number_format($medicine['price'],0,',','.') }});
                        Rp. {{ number_format($medicine['sub_price'],0,',','.') }}
                        <small>qty{{ $medicine['qty'] }}</small></li>
                @endforeach
            </ol>
        </td>
        <td>{{ $order['user'] ['name'] }}</td>
        {{-- carbon : package bawaan laravel untuk mengatur hal hal yang berkaitan dengan tipee data date/datetime --}}
        @php
            // stting lokal time sebagai wilayah indonesia
            setlocale(LC_ALL, 'IND');
        @endphp
            <td>{{ Carbon\Carbon::parse($orders->$created_at)->formatLocalized('%d %B %Y') }}</td>
            <td>  <a href="{{ route('download'), $order['id'] }}" class="btn btn-secondary " ></a></td>
        </tr>
        @endforeach
    </tbody>
</table>
    @endsection