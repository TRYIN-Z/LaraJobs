@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2 py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 bg-white shadow-sm">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item text"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Account Settings</li>
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

                <form action="" method="post" id="editJobForm" name="editJobForm">
                    <div class="card border-0 shadow-sm rounded-xl mb-4">
                        <div class="card-body p-4">
                            <h3 class="fs-4 mb-4">Job</h3>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
                                    <input value="{{ $job->title }}" type="text" id="title" name="title" class="form-control" placeholder="Job Title">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="category" class="form-label">Category<span class="text-danger">*</span></label>
                                    <select name="category" id="category" class="form-select">
                                        <option value="">Select a Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ ($job->category_id == $category->id) ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="jobType" class="form-label">Job Type<span class="text-danger">*</span></label>
                                    <select name="jobType" id="jobType" class="form-select">
                                        <option value="">Select Job Type</option>
                                        @foreach ($jobTypes as $jobType)
                                            <option value="{{ $jobType->id }}" {{ ($job->job_type_id == $jobType->id) ? 'selected' : '' }}>
                                                {{ $jobType->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="vacancy" class="form-label">Vacancy<span class="text-danger">*</span></label>
                                    <input value="{{ $job->vacancy }}" type="number" id="vacancy" name="vacancy" class="form-control" placeholder="Vacancy" min="1">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="salary" class="form-label">Salary</label>
                                    <input value="{{ $job->salary }}" type="text" id="salary" name="salary" class="form-control" placeholder="Salary">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="location" class="form-label">Location<span class="text-danger">*</span></label>
                                    <input value="{{ $job->location }}" type="text" id="location" name="location" class="form-control" placeholder="Location">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label">Description<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" id="description" rows="5" placeholder="Description">{{ $job->description }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="benefits" class="form-label">Benefits</label>
                                <textarea class="form-control" name="benefits" id="benefits" rows="5" placeholder="Benefits">{{ $job->benefits }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="responsibility" class="form-label">Responsibility</label>
                                <textarea class="form-control" name="responsibility" id="responsibility" rows="5" placeholder="Responsibility">{{ $job->responsibility }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="qualifications" class="form-label">Qualifications</label>
                                <textarea class="form-control" name="qualifications" id="qualifications" rows="5" placeholder="Qualifications">{{ $job->qualifications }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label for="experience" class="form-label">Experience <span class="text-danger">*</span></label>
                                <select name="experience" id="experience" class="form-select">
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ ($job->experience == $i) ? 'selected' : '' }}>{{ $i }} Year{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                    <option value="10_plus" {{ ($job->experience == '10_plus') ? 'selected' : '' }}>10+ Years</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="keywords" class="form-label">Keywords</label>
                                <input value="{{ $job->keywords }}" type="text" id="keywords" name="keywords" class="form-control" placeholder="Keywords">
                            </div>

                            <h3 class="fs-4 mt-5 border-top pt-4">Company Details</h3>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="company_name" class="form-label">Name<span class="text-danger">*</span></label>
                                    <input value="{{ $job->company_name }}" type="text" id="company_name" name="company_name" class="form-control" placeholder="Company Name">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="company_location" class="form-label">Location</label>
                                    <input value="{{ $job->company_location }}" type="text" id="company_location" name="company_location" class="form-control" placeholder="Location">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="company_website" class="form-label">Website</label>
                                <input value="{{ $job->company_website }}" type="text" id="company_website" name="company_website" class="form-control" placeholder="Website">
                            </div>
                        </div>
                        <div class="card-footer bg-light p-4">
                            <button type="submit" class="btn btn-gradient rounded-full">Update Job</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
@endsection


@section('customJs')
<script type="text/javascript">
$("#editJobForm").submit(function(e){
    e.preventDefault();
    $("button[type='submit']").prop('disabled',true);
    $.ajax({
        url: '{{ route("account.updateJob",$job->id) }}',
        type: 'POST',
        dataType: 'json',
        data: $("#editJobForm").serializeArray(),
        success: function(response) {
            $("button[type='submit']").prop('disabled',false);
            if(response.status == true) {

                $("#title").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                $("#category").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                $("#jobType").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                $("#vacancy").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                $("#location").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')


                $("#description").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                $("#company_name").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                window.location.href="{{ route('account.myJobs') }}";

            } else {
                var errors = response.errors;

                if (errors.title) {
                    $("#title").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    .html(errors.title)
                } else {
                    $("#title").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }

                if (errors.category) {
                    $("#category").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    .html(errors.category)
                } else {
                    $("#category").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }

                if (errors.jobType) {
                    $("#jobType").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    .html(errors.jobType)
                } else {
                    $("#jobType").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }

                if (errors.vacancy) {
                    $("#vacancy").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    .html(errors.vacancy)
                } else {
                    $("#vacancy").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }

                if (errors.location) {
                    $("#location").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    .html(errors.location)
                } else {
                    $("#location").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }

                if (errors.description) {
                    $("#description").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    .html(errors.description)
                } else {
                    $("#description").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }

                if (errors.company_name) {
                    $("#company_name").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    .html(errors.company_name)
                } else {
                    $("#company_name").removeClass('is-invalid')
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
