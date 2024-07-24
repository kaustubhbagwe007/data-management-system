@extends('layouts.main')

@section('main')

@include('categories.form', [
    'category' => $category
])

@endsection