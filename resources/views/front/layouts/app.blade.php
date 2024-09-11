@include('includes.customCss')

<!DOCTYPE html>
<html lang="en_AU">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>LaraJobs</title>
    <link rel="icon" href="{{ asset('images/larajobs-logo.svg') }}" />
    <meta name="description" content="" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="pinterest" content="nopin" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container flex justify-between items-center p-3 py-2">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img class="w-24" src="{{ asset('images/larajobs-trans.svg') }}" alt="Larajobs" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item">
                            <a class="text mr-3" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="text" href="{{ route('jobs') }}">Find Jobs</a>
                        </li>
                    </ul>

                    @if (!Auth::check())
                        <a class="btn btn-gradient rounded-full fw-bold px-4 py-2 me-2"
                            href="{{ route('account.login') }}">Login</a>
                    @else
                        @if (Auth::user()->role == 'admin')
                            <a class="btn btn-gradient px-4 py-2 fw-bold rounded-full me-2"
                                href="{{ route('admin.dashboard') }}">Admin</a>
                        @else
                            <a class="me-2 text px-4 py-2" href="{{ route('account.profile') }}">Welcome,
                                {{ auth()->user()->name }}!</a>
                            @if (Auth::user()->role == 'employer')
                                <a class="btn btn-gradient rounded-full fw-bold px-4 py-2"
                                    href="{{ route('account.createJob') }}">Post a Job</a>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-1">
        @yield('main')
    </main>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-lg">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-lg font-semibold fw-bold rounded-full" id="exampleModalLabel">Change
                        Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="profilePicForm" name="profilePicForm" action="{{ route('account.updateProfilePic') }}"
                        method="POST" enctype="multipart/form-data" class="p-3 border rounded">
                        @csrf
                        <div class="mb-3">
                            <label for="image" class="form-label font-medium">Profile Image</label>
                            <div class="d-flex align-items-center justify-content-center bg-light border border-secondary border-dashed rounded-lg position-relative"
                                style="height: 200px;">
                                <p class="text-muted font-weight-medium">Drop your image here or click to upload</p>
                                <input type="file" id="image" name="image"
                                    class="position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer">
                            </div>
                            <p class="text-danger mt-2" id="image-error"></p>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-gradient rounded-pill px-4 mx-2">Update</button>
                            <button type="button" class="btn btn-secondary rounded-pill px-4"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title pb-0" id="exampleModalLabel">Change Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="profilePicForm" name="profilePicForm" action="{{ route('account.updateProfilePic') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <p class="text-danger" id="image-error"></p>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mx-3">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <footer class="bg-dark py-4 text-center text-white">
        <div class="container">
            <p class="text-white font-weight-bold mb-0">© 2024 LaraJobs Company, All Rights Reserved</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-lazyload/17.4.0/lazyload.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#profilePicForm").submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '{{ route('account.updateProfilePic') }}',
                type: 'post',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == false) {
                        var errors = response.errors;
                        if (errors.image) {
                            $("#image-error").html(errors.image);
                        }
                    } else {
                        window.location.href = '{{ url()->current() }}';
                    }
                }
            });
        });
    </script>

    @yield('customJs')
</body>

</html>
