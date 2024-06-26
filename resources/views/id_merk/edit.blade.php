@extends('layouts.template')
@section('content')
<form action="{{ route('merk.update', $id_merk->id) }}" method="POST" enctype="multipart/form-data" class="card p-5">
    @csrf
    @method('PATCH')
    @if($errors->any())
        <ul class="alert alert-danger p-3">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Nama_merk :</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $id_merk->name) }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="logo" class="col-sm-2 col-form-label">Logo_merk :</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="logo" name="logo" value="{{ $id_merk->logo }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="status" class="col-sm-2 col-form-label">Status:</label>
        <div class="col-sm-10">
            @php
            $status = $id_merk->status;
            $statusText = $status == 1 ? 'active' : 'inactive';
            @endphp
            <input type="text" class="form-control" id="status" name="status_text" value="{{ $statusText }}" readonly>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="created_by" class="col-sm-2 col-form-label">Created By :</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="created_by" name="created_by" value="{{ old('created_by', $id_merk->created_by) }}">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="updated_by" class="col-sm-2 col-form-label">Updated By :</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="updated_by" name="updated_by" value="{{ Auth::user()->name }}">
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
</form>

@endsection
