@extends('layouts.auth')

@section('main')
    
<main class="d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <h1 class="h2">Welcome back!</h1>
                        <p class="lead">
                            Sign in to your account to continue
                        </p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-3">
                                <form id="login-form" action="{{ route('auth.authenticate') }}" method="POST">
                                    
                                    @csrf
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                            type="email" 
                                            name="email" 
                                            value="{{ old('email') }}" 
                                            placeholder="Enter your email" 
                                            required
                                            email
                                        />
                                        @error('email')
                                            <div class="mt-3">
                                                <p class="text-danger fw-bold">{{ $message }}</p>
                                            </div>
                                        @endError
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                            type="password" 
                                            name="password" 
                                            placeholder="Enter your password" 
                                            required
                                            minlength="8"
                                        />
                                        @error('password')
                                            <div class="mt-3">
                                                <p class="text-danger fw-bold">{{ $message }}</p>
                                            </div>
                                        @endError
                                    </div>
                                    {{-- <div>
                                        <div class="form-check align-items-center">
                                            <input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me" name="remember-me" checked>
                                            <label class="form-check-label text-small" for="customControlInline">Remember me</label>
                                        </div>
                                    </div> --}}
                                    @error('invalid-credentials')
                                        <div class="mt-3">
                                            <p class="text-danger fw-bold">{{ $message }}</p>
                                        </div>
                                    @endError
                                    <div class="d-grid gap-2 mt-5">
                                        <button class="btn btn-lg btn-primary" type="submit">Sign in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection