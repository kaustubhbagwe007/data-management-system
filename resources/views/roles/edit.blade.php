@extends('layouts.main')

@section('main')

@include('roles.form', [
    'role' => $role
])

@endsection