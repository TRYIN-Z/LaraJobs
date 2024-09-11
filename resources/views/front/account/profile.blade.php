@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2 bg-light">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4 shadow-sm bg-white">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item text"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Account Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('front.account.sidebar')
                </div>
                <div class="col-lg-9">
                    @include('front.message')
                    <div class="card border-0 shadow mb-4">
                        <form action="" method="post" id="userForm" name="userForm">
                            <div class="card-body p-4">
                                <h3 class="fs-4 mb-1 gradient-text fw-bold">My Profile</h3>
                                <div class="mb-4">
                                    <label for="name" class="mb-2 text-secondary fw-bold">Name</label>
                                    <input type="text" name="name" id="name" placeholder="Enter Name"
                                        class="form-control rounded-pill border-primary shadow-sm p-3"
                                        value="{{ $user->name }}">
                                    <p class="invalid-feedback"></p>
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="mb-2 text-secondary fw-bold">Email</label>
                                    <input type="text" name="email" id="email" placeholder="Enter Email"
                                        class="form-control rounded-pill border-primary shadow-sm p-3"
                                        value="{{ $user->email }}">
                                    <p class="invalid-feedback"></p>
                                </div>
                                @if (Auth::user()->role == 'user')
                                    <div class="mb-4">
                                        <label for="designation" class="mb-2 text-secondary fw-bold">Designation</label>
                                        <input type="text" name="designation" id="designation" placeholder="Designation"
                                            class="form-control rounded-pill border-primary shadow-sm p-3"
                                            value="{{ $user->designation }}">
                                    </div>
                                    <div class="mb-4">
                                        <label for="mobile" class="mb-2 text-secondary fw-bold">Mobile</label>
                                        <input type="text" name="mobile" id="mobile" placeholder="Mobile"
                                            class="form-control rounded-pill border-primary shadow-sm p-3"
                                            value="{{ $user->mobile }}">
                                    </div>
                                @endif
                            </div>
                            <div class="card-footer p-4">
                                <button type="submit"
                                    class="btn btn-gradient rounded-full px-5 py-2 fw-bold">Update</button>
                            </div>
                        </form>
                    </div>

                    <div class="card border-0 shadow mb-4">
                        <form action="" method="post" id="changePasswordForm" name="changePasswordForm">
                            <div class="card-body p-4">
                                <h3 class="fs-4 mb-1 gradient-text">Change Password</h3>
                                <div class="mb-4">
                                    <label for="old_password" class="mb-2 text-secondary fw-bold">Old Password</label>
                                    <input type="password" name="old_password" id="old_password" placeholder="Old Password"
                                        class="form-control rounded-pill border-primary shadow-sm p-3">
                                    <p class="invalid-feedback"></p>
                                </div>
                                <div class="mb-4">
                                    <label for="new_password" class="mb-2 text-secondary fw-bold">New Password</label>
                                    <input type="password" name="new_password" id="new_password" placeholder="New Password"
                                        class="form-control rounded-pill border-primary shadow-sm p-3">
                                    <p class="invalid-feedback"></p>
                                </div>
                                <div class="mb-4">
                                    <label for="confirm_password" class="mb-2 text-secondary fw-bold">Confirm
                                        Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password"
                                        placeholder="Confirm Password"
                                        class="form-control rounded-pill border-primary shadow-sm p-3">
                                    <p class="invalid-feedback"></p>
                                </div>
                            </div>
                            <div class="card-footer p-4">
                                <button type="submit"
                                    class="btn btn-gradient rounded-full px-5 py-2 fw-bold">Update</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script type="text/javascript">
        $("#userForm").submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('account.updateProfile') }}',
                type: 'put',
                dataType: 'json',
                data: $("#userForm").serializeArray(),
                success: function(response) {

                    if (response.status == true) {

                        $("#name").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('')

                        $("#email").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('')

                        window.location.href = "{{ route('account.profile') }}";

                    } else {
                        var errors = response.errors;

                        if (errors.name) {
                            $("#name").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.name)
                        } else {
                            $("#name").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                        }

                        if (errors.email) {
                            $("#email").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.email)
                        } else {
                            $("#email").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                        }
                    }

                }
            });
        });

        $("#changePasswordForm").submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('account.updatePassword') }}',
                type: 'post',
                dataType: 'json',
                data: $("#changePasswordForm").serializeArray(),
                success: function(response) {

                    if (response.status == true) {

                        $("#old_password").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('')

                        $("#new_password").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('')

                        window.location.href = "{{ route('account.profile') }}";

                    } else {
                        var errors = response.errors;

                        if (errors.old_password) {
                            $("#old_password").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.old_password)
                        } else {
                            $("#old_password").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                        }

                        if (errors.new_password) {
                            $("#new_password").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.new_password)
                        } else {
                            $("#new_password").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                        }

                        if (errors.confirm_password) {
                            $("#confirm_password").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.confirm_password)
                        } else {
                            $("#confirm_password").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                        }
                    }

                }
            });
        });
    </script>
@endsection
