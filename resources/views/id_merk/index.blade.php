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
            <th>Nama_merk</th>
            <th>Logo_merk</th>
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
                <span class="badge badge-success">active</span>
                @else
                <span class="badge badge-danger">inactive</span>
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
                    <form action="{{ route('merk.updateStatus', $item->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="{{ $item->status ? '0' : '1' }}">
                        <button type="button" class="btn {{ $item->status ? 'btn-danger' : 'btn-success' }} toggle-status" data-id="{{ $item->id }}">
                            {{ $item->status ? 'inactive' : 'active' }}
                        </button>
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
        const toggleStatusButtons = document.querySelectorAll('.toggle-status');

        toggleStatusButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const form = this.closest('form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to change the status!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, change it!',
                    cancelButtonText: 'No, cancel!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
