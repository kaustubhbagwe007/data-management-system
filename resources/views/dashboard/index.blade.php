@extends('layouts.main')

@section('main')

<div class="container-fluid p-0">

    <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

    <div class="row">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Users</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="users"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{ $userCount }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Categories</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="server"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{ $categoryCount }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Products</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="box"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{ $productCount }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection