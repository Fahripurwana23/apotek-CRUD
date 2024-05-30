@extends('layouts.template')

@section('content')
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Stok</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach ($medicines as $item)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $item->name }}</td>
            <td style="{{ $item->['stock'] <= 3 ? 'background: red; color: white' : 'background: none; color: black' '' }}">{{ $item->['stock'] }}</td>
            <td class="d-flex justify-content-center">
                <a href="#" class="btn btn-primary me-3">Tambah Stok</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
