@extends('layouts.template')

@section('content')

<div class="container mr-3">
    <div class="d-flex justify-content-end">
        <a href="{{ route('create') }}" class="btn btn-primary">Pembelian baru</a>
    </div>

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-center">NO</th>
                <th>Pembeli</th>
                <th>Obat</th>
                <th>Total Bayar</th>
                <th>Kasir</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($orders as $item)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $item['name_customer'] }}</td>
                    <td>
                        @php $medicines = json_decode($item['medicines'], true); @endphp
                        @foreach ($medicines as $medicine)
                            <ol>
                                <li>
                                    {{ $medicine['name_medicine'] }} ({{ number_format($medicine['price'], 0, ',', '.') }}): Rp. {{ number_format($medicine['sub_price'], 0, ',', '.') }} <small>qty {{ $medicine['qty'] }}</small>
                                </li>
                            </ol>
                        @endforeach
                    </td>
                    <td>Rp. {{ number_format($item['total_price'], 0, ',', '.') }}</td>
                    <td>{{ $item['user']['name'] }}</td>
                    <td>
                        <a href="{{ route('download', ['id' => $item['id']]) }}" class="btn btn-secondary">Download struk</a>
                        <form action="{{ route('orders.destroy', ['id' => $item['id']]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        @if($orders->count())
            {{ $orders->links() }}
        @endif
    </div>
</div>
@endsection
