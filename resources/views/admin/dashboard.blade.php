@extends('front.layouts.app')

@section('main')
<section class="section-5 py-5 flex flex-col">
    <div class="container flex-1">
        <!-- Breadcrumb Navigation -->
        <div class="row mb-4">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 shadow-lg p-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item text"><a href="{{ route('home') }}" class="text-decoration-none text-slate-800">Home</a></li>
                        <li class="breadcrumb-item active text-slate-600" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row flex-1">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4 mb-lg-0">
                @include('admin.sidebar')
            </div>

            <!-- Dashboard Content -->
            <div class="col-lg-9">
                @include('front.message')
                <div class="card border-0 shadow-lg rounded-3">
                    <div class="card-body text-center">
                        <p class="h2 mb-0 fw-bold">Welcome Administrator!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<!-- Add any custom JavaScript if needed -->
@endsection
