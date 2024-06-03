@extends('layouts.template')

@section('content')
@if(Session::get('success'))
<div class="alert alert-success">{{ Session::get('success')}}></div>
@endif
@if(Session::get('deleted'))
<div class="alert alert-success">{{ Session::get('deleted')}}></div>
@endif
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>logo</th>
            <th>status</th>
            <th>created_by</th>
            <th>updated_by</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <a class="btn btn-primary float-end" href="{{ route('merk.create') }}" role="button">Tambah merk</a>
    <tbody>
        @php $no = 1; @endphp
        @foreach ($id_merk as $item)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $item->name }}</td>
            <td><img src="{{ asset($item->logo) }}" alt="logo" class="logo" style="width: auto; height: 50px"></td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->created_by }}</td>
            <td>{{ $item->updated_by }}</td>
            <td class="d-flex justify-content-center">
                <a href="{{ route('merk.edit', $item->id ) }}" class="btn btn-primary me-3">Edit</a>
                <form action="{{ route('merk.delete', $item['id']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</form>
@endsection
