@extends('layouts.template')

@section('content')

<div class="container mt-3">
    <form action="{{ route('store') }}" class="card m-auto p-5" method="POST">
        @csrf
        {{-- validasi error message --}}
        @if($errors->any())
            <ul class="alert alert-danger p-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @if(Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif
        @if(Auth::check())
            <p>penanggung jawab : {{ Auth::user()->name }}</p>
        @else
            <p>penanggung jawab : Tidak Terautentikasi</p>
        @endif
        <div class="mb-3 row">
            <label for="name_customer" class="col-sm-2 col-form-label">Nama pembeli</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name_customer" name="name_customer">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="medicines" class="col-sm-2 col-form-label">Obat</label>
            <div class="col-sm-10">
                {{-- name dibuat array karena nantinya data obat medicine akan berbentuk array/data bisa lebih dari satu --}}
                <select name="medicines[]" id="medicines" class="form-select">
                    <option selected hidden disabled>pesanan 1</option>
                    @foreach ($medicines as $item)
                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                </select>
                {{-- div pembungkus untuk tambahan select yang akan muncul --}}
                <div id="wrap-medicines"></div>
                <br>
                <p style="cursor:pointer" class="text-primary" id="add-select">+ tambah obat</p>
            </div>
        </div>
        <button type="submit" class="btn btn-block btn-lg btn-primary">konfirmasi pembelian</button>
    </form>
</div>
@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // definisikan no sebagai 2
    let no = 2;
    // ketika tag dengan id add-select di klik, jalankan fungsi berikut
    $("#add-select").on("click", function() {
        // tag html yang akan ditambahkan/muncul
        let en = `<br><select name="medicines[]" id="medicines" class="form-select">
            <option selected hidden disabled>pesanan ${no}</option>
            @foreach ($medicines as $item)
                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
            @endforeach
        </select>`;
        // append: ditambahkan elemen html di bagian sebelum penutup tag terkait (sebelum penutup tag yang id nya wrap-medicines)
        $("#wrap-medicines").append(en);
        // increment variable no agar angka yang muncul di option selalu bertambah 1 sesuai jumlah select nya
        no++;
    });
</script>
@endpush
