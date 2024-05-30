@extends('layouts.template')
@section('content')
<form action="{{ route('medicine.update', $medicines->id) }}" method="POST" class="card p-5">
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
    <label for="name" class="col-sm-2 col-form-label">Nama Obat :</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $medicines->name) }}">
    </div>
</div>
<div class="mb-3 row">
    <label for="type" class="col-sm-2 col-form-label">Jenis Obat</label>
    <div class="col-sm-10">
        <select class="form-select" id="type" name="type">
            <option selected disabled hidden>Pilih</option>
            <option value="tablet" {{ old('type', $medicines->type) == 'tablet' ? 'selected' : '' }}>tablet</option>
            <option value="sirup" {{ old('type', $medicines->type) == 'sirup' ? 'selected' : '' }}>sirup</option>
            <option value="kapsul" {{ old('type', $medicines->type) == 'kapsul' ? 'selected' : '' }}>kapsul</option>
        </select>
    </div>
</div>
<div class="mb-3 row">
    <label for="price" class="col-sm-2 col-form-label">Harga Obat :</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $medicines->price) }}">
    </div>
</div>
<div class="mb-3 row">
    <label for="stock" class="col-sm-2 col-form-label">Stock Obat :</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $medicines->stock) }}">
    </div>
</div>
<button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
</form>
@endsection
