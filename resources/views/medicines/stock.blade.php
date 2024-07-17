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
            <td>{{ $item['name'] }}</td>
            <td style="{{ $item['stock'] <= 3 ? 'background: red; color: white' : 'background: none; color: black'}}">{{
                $item['stock'] }}</td>
            <td class="d-flex justify-content-center">
                <a href="{{ route('medicine.create') }}" class="btn btn-primary me-3">Tambah Stok</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="modal" tabindex="-1" id="edit-stock">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Data Stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss-"modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="form-stock">
                <div class="modal-body">
                    <div id="msg"></div>
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Obat :</label>
                        <input type="text" class="form-control" id="name" name="name" disabled>
                    </div>
                    <div class="nab-3">
                        <label for="stock" class="form-label">Stock Obat :</label>
                        <input type="number" class="form-control" id="stock" name="stock">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss-"modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
                    @endsection