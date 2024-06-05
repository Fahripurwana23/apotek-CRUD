@extends('layouts.template')

@section('content')
<form action="{{ route('merk.store') }}" method="POST" enctype="multipart/form-data" class="card" >
    @csrf

    @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if($errors->any())
    <ul class="alert alert-danger">
        @foreach ( $errors->all() as $error )
                    <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
    <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="logo" class="col-sm-2 col-form-label rounded">logo</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="logo" name="logo">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="type" class="col-sm-2 col-form-label">status :</label>
            <select class="form-select" id="status" name="status">
                <option selected disabled hidden>Pilih</option>
                <option value="1">In Stock</option>
                <option value="0">Out of Stock</option>
            </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="created_by" class="col-sm-2 col-form-label">created_by</label>
            <div class="col-sm-10">
                <input type="" value="{{ Auth::user()->name }}" class="form-control" id="created_by" name="created_by">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="updated_by" class="col-sm-2 col-form-label">updated_by</label>
            <div class="col-sm-10">
                <input type="" value="{{ Auth::user()->name }}" class="form-control" id="updated_by" name="updated_by">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
</form>
@endsection
