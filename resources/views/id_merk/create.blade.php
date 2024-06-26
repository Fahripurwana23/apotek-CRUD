@extends('layouts.template')

@section('content')
<form action="{{ route('merk.store') }}" method="POST" enctype="multipart/form-data" class="card p-5">
    @csrf

    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Nama_merk</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="logo" class="col-sm-2 col-form-label">Logo_merk</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="logo" name="logo">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="status" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-10">
            <select class="form-select" id="status" name="status">
                <option selected disabled hidden>Pilih</option>
                <option value="1">active</option>
                <option value="0">in active</option>
            </select>
        </div>
    </div>    
    <div class="mb-3 row">
        <label for="created_by" class="col-sm-2 col-form-label">Created By</label>
        <div class="col-sm-10">
            <input type="text" value="{{ Auth::user()->name }}" class="form-control" id="created_by" name="created_by" readonly>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="updated_by" class="col-sm-2 col-form-label">Updated By</label>
        <div class="col-sm-10">
            <input type="text" value="{{ Auth::user()->name }}" class="form-control" id="updated_by" name="updated_by" readonly>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
</form>
@endsection
