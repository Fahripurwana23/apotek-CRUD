@extends('layouts.template')

@section('content')
@if(Session::get('success'))
<div class="alert alert-success">{{ Session::get('success') }}</div>
@endif
@if(Session::get('deleted'))
<div class="alert alert-success">{{ Session::get('deleted') }}</div>
@endif
<a class="btn btn-primary float-end" href="{{ route('merk.create') }}" role="button">Tambah Merk</a>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Logo</th>
            <th>Status</th>
            <th>Created By</th>
            <th>Updated By</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach ($id_merk as $item)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $item->name }}</td>
            <td><img src="{{ asset($item->logo) }}" alt="logo" class="logo" style="width: auto; height:50px;"></td>
            <td>
                @if($item->status)
                <button class="badge badge-success">In Stock</button>
                @else
                <button class="badge badge-danger">Out Stock</button>
                @endif
            </td>
            <td>{{ $item->created_by }}</td>
            <td>{{ $item->updated_by }}</td>
            <td class="d-flex justify-content-center align-items-center">
                <form action="{{ route('merk.edit', $item->id) }}" method="GET">
                    @csrf
                    <button type="submit" class="btn btn-primary me-2">Edit</button>
                </form>
                <div class="btn-group me-2" role="group">
                    <form action="{{ route('merk.updateStatus', ['id_merk' => $item->id]) }}" method="POST" id="form-in-stock-{{ $item->id }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="1">
                        <button type="button" class="btn btn-success btn-in-stock" data-id="{{ $item->id }}">In Stock</button>
                    </form>
                </div>
                <div class="btn-group me-2" role="group">
                    <form action="{{ route('merk.updateStatus', ['id_merk' => $item->id]) }}" method="POST" id="form-out-stock-{{ $item->id }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="0">
                        <button type="button" class="btn btn-danger btn-out-stock" data-id="{{ $item->id }}">Out Stock</button>
                    </form>
                </div>
                <div class="btn-group" role="group">
                    <form action="{{ route('merk.delete', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnInStock = document.querySelectorAll('.btn-in-stock');
        const btnOutStock = document.querySelectorAll('.btn-out-stock');

        btnInStock.forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Success!',
                    text: 'Item has been marked as In Stock.',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    document.getElementById('form-in-stock-' + id).submit();
                });
            });
        });

        btnOutStock.forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Error!',
                    text: 'Item has been marked as Out Stock.',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    document.getElementById('form-out-stock-' + id).submit();
                });
            });
        });
    });
</script>
