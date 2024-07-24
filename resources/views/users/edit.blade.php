@extends('layouts.main')

@section('main')

@include('users.form', [
    'user' => $user
])

@endsection