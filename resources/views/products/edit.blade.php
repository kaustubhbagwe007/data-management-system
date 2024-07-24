@extends('layouts.main')

@section('main')

@include('products.form', [
    'product' => $product
])

@endsection