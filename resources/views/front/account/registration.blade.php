@extends('front.layouts.app')
@include('includes.customCss')

@section('main')
    <section class="section-5">
        <div class="container my-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow-lg border-0 p-5 rounded-lg">
                        <h1 class="h3 mb-4 text-center gradient-text fw-bold">Register to Larajobs</h1>
                        <form action="" name="registrationForm" id="registrationForm">
                            <div class="mb-4">
                                <label for="name" class="mb-2 text-secondary fw-bold">Name</label>
                                <input type="text" name="name" id="name"
                                    class="form-control rounded-pill border-primary shadow-sm p-3" placeholder="Enter Name">
                                <p class="invalid-feedback"></p>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="mb-2 text-secondary fw-bold">Email</label>
                                <input type="text" name="email" id="email"
                                    class="form-control rounded-pill border-primary shadow-sm p-3"
                                    placeholder="Enter Email">
                                <p class="invalid-feedback"></p>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="mb-2 text-secondary fw-bold">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-control rounded-pill border-primary shadow-sm p-3"
                                    placeholder="Enter Password">
                                <p class="invalid-feedback"></p>
                            </div>
                            <div class="mb-4">
                                <label for="confirm_password" class="mb-2 text-secondary fw-bold">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password"
                                    class="form-control rounded-pill border-primary shadow-sm p-3"
                                    placeholder="Please confirm Password">
                                <p class="invalid-feedback"></p>
                            </div>
                            <div class="mb-4">
                                <label class="mb-2 text-secondary fw-bold">Role</label>
                                <div class="flex items-center space-x-6">
                                    <div class="form-check flex items-center">
                                        <input class="form-check-input mr-2" type="radio" name="role" id="employee" value="employee" checked>
                                        <label class="form-check-label text-gray-600 font-semibold" for="employee">
                                            Employee
                                        </label>
                                    </div>
                                    <div class="form-check flex items-center">
                                        <input class="form-check-input mr-2" type="radio" name="role" id="employer" value="employer">
                                        <label class="form-check-label text-gray-600 font-semibold" for="employer">
                                            Employer
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                class="btn btn-gradient rounded-full px-5 py-2 fw-bold">Register</button>
                        </form>
                    </div>
                    <div class="mt-4 text-center">
                        <p class="text-secondary">Have an account? <a href="{{ route('account.login') }}"
                                class="text">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('customJs')
<script>
$("#registrationForm").submit(function(e){
    e.preventDefault();

    $.ajax({
        url: '{{ route("account.processRegistration") }}',
        type: 'post',
        data: $("#registrationForm").serializeArray(),
        dataType: 'json',
        success: function(response) {
            if (response.status == false) {
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

                if (errors.password) {
                    $("#password").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    .html(errors.password)
                } else {
                    $("#password").removeClass('is-invalid')
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
            } else {
                $("#name").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('');

                $("#email").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                $("#password").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                $("#confirm_password").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('');

                window.location.href='{{ route("account.login") }}';
            }
        }
    });
});
</script>
@endsection
