@extends('layouts.template')

@section('content')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Barcode Generate</title>
        <h3>Your Barcode</h3>
        {!! $barcode !!}
@endsection
