@extends('front.layouts.app')
@include('includes.customCss')

@section('main')
    <section class="section-5">
        <div class="container my-5">
            <div class="py-lg-2">&nbsp;</div>

            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p class="mb-0 pb-0">{{ Session::get('success') }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <p class="mb-0 pb-0">{{ Session::get('error') }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow-lg border-0 p-5 rounded-lg">
                        <h1 class="gradient-text h3 mb-4 text-center text-primary fw-bold">Login to Larajobs</h1>
                        <form action="{{ route('account.authenticate') }}" method="post">
                            @csrf
                            <div class="mb-4">
                                <label for="email" class="mb-2 text-secondary fw-bold">Email</label>
                                <input type="text" value="{{ old('email') }}" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror rounded-pill p-3 border-primary shadow-sm"
                                    placeholder="example@example.com">

                                @error('email')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="password" class="mb-2 text-secondary fw-bold">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror rounded-pill p-3 border-primary shadow-sm"
                                    placeholder="Enter Password">

                                @error('password')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit"
                                    class="btn btn-gradient fw-bold rounded-full px-5 py-2">Login</button>
                                <a href="{{ route('account.forgotPassword') }}" class="text">Forgot
                                    Password?</a>
                            </div>
                        </form>
                    </div>
                    <div class="mt-4 text-center">
                        <p class="text-secondary">Don't have an account? <a href="{{ route('account.registration') }}"
                                class="text">Register</a></p>
                    </div>
                </div>
            </div>
            <div class="py-lg-5">&nbsp;</div>
        </div>
    </section>
@endsection
