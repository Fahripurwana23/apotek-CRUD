@extends('layouts.template')

@section('content')

<div class="container mr-3">
    <div class="d-flex justify-content-end">
        <a href="{{ route('create') }}" class="btn btn-primary">pembelian baru</a>
    </div>

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-center">NO</th>
                <th>Pembeli</th>
                <th>Obat</th>
                <th>Total Bayar</th>
                <th>Kasir</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php $no =1;@endphp
            @foreach ($orders as $item )
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $item['name_customer'] }}</td>
                    <td>
                        {{-- Decode JSON string to array --}}
                        @php $medicines = json_decode($item['medicines'], true); @endphp

                        {{-- karena kolom medicines pada tabel orders bertipe json yang diubah formatnya menjadi array maka untuk mengakses/menampilkan itemnya perlu menggunakan looping --}}
                        @foreach ($medicines as $medicine )
                            <ol>
                                <li>
                                    {{-- mengakses key array assoc dari tiap item array value kolom medicines --}}
                                    {{ $medicine['name_medicine'] }}( {{ number_format($medicine['price'],0,',','.') }}) : Rp. {{ number_format
                                    ($medicine['sub_price'],0,',','.') }} <small>qty {{ $medicine['qty'] }}</small>
                                </li>
                            </ol>
                        @endforeach
                    </td>
                    <td>Rp. {{  number_format($item['total_price'],0,',','.') }}</td>
                    <td>{{ $item['user']['name'] }}</td>
                    <td>
                        <a href="" class="btn btn-secondary">Download struk</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        {{-- jika data ada atau >0 --}}
        @if($orders->count())
        {{-- munculkan tampilan pagination --}}
            {{ $orders->links() }}
        @endif
    </div>
</div>
@endsection
