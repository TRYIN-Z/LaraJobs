@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-light py-5">
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

                <form action="" method="post" id="createJobForm" name="createJobForm">
                    <div class="card border-0 shadow-lg rounded-xl">
                        <div class="card-body p-4">
                            <h3 class="fs-4 mb-4">Job Details</h3>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
                                    <input type="text" id="title" name="title" placeholder="Job Title" class="form-control">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="category" class="form-label">Category<span class="text-danger">*</span></label>
                                    <select name="category" id="category" class="form-select">
                                        <option value="">Select a Category</option>
                                        @if ($categories->isNotEmpty())
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="jobType" class="form-label">Job Type<span class="text-danger">*</span></label>
                                    <select name="jobType" id="jobType" class="form-select">
                                        <option value="">Select Job Type</option>
                                        @if ($jobTypes->isNotEmpty())
                                            @foreach ($jobTypes as $jobType)
                                                <option value="{{ $jobType->id }}">{{ $jobType->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="vacancy" class="form-label">Vacancy<span class="text-danger">*</span></label>
                                    <input type="number" id="vacancy" name="vacancy" min="1" placeholder="Vacancy" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="salary" class="form-label">Salary</label>
                                    <input type="text" id="salary" name="salary" placeholder="Salary" class="form-control">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="location" class="form-label">Location<span class="text-danger">*</span></label>
                                    <input type="text" id="location" name="location" placeholder="Location" class="form-control">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label">Description<span class="text-danger">*</span></label>
                                <textarea id="description" name="description" class="form-control" rows="5" placeholder="Description"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="benefits" class="form-label">Benefits</label>
                                <textarea id="benefits" name="benefits" class="form-control" rows="5" placeholder="Benefits"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="responsibility" class="form-label">Responsibility</label>
                                <textarea id="responsibility" name="responsibility" class="form-control" rows="5" placeholder="Responsibility"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="qualifications" class="form-label">Qualifications</label>
                                <textarea id="qualifications" name="qualifications" class="form-control" rows="5" placeholder="Qualifications"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="experience" class="form-label">Experience <span class="text-danger">*</span></label>
                                <select name="experience" id="experience" class="form-select">
                                    <option value="1">1 Year</option>
                                    <option value="2">2 Years</option>
                                    <option value="3">3 Years</option>
                                    <option value="4">4 Years</option>
                                    <option value="5">5 Years</option>
                                    <option value="6">6 Years</option>
                                    <option value="7">7 Years</option>
                                    <option value="8">8 Years</option>
                                    <option value="9">9 Years</option>
                                    <option value="10">10 Years</option>
                                    <option value="10_plus">10+ Years</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="keywords" class="form-label">Keywords</label>
                                <input type="text" id="keywords" name="keywords" placeholder="Keywords" class="form-control">
                            </div>

                            <h3 class="fs-4 mt-5 border-top pt-4">Company Details</h3>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="company_name" class="form-label">Name<span class="text-danger">*</span></label>
                                    <input type="text" id="company_name" name="company_name" placeholder="Company Name" class="form-control">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="company_location" class="form-label">Location</label>
                                    <input type="text" id="company_location" name="company_location" placeholder="Location" class="form-control">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="website" class="form-label">Website</label>
                                <input type="text" id="website" name="website" placeholder="Website" class="form-control">
                            </div>
                        </div>
                        <div class="card-footer bg-light p-4">
                            <button type="submit" class="btn btn-gradient fw-bold rounded-full">Save Job</button>
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
$("#createJobForm").submit(function(e){
    e.preventDefault();
    $("button[type='submit']").prop('disabled', true);

    $.ajax({
        url: '{{ route("account.saveJob") }}',
        type: 'POST',
        dataType: 'json',
        data: $("#createJobForm").serializeArray(),
        success: function(response) {
            $("button[type='submit']").prop('disabled', false);

            if(response.status === true) {
                $("input, select, textarea").removeClass('is-invalid');
                $("p").removeClass('invalid-feedback').html('');

                window.location.href = "{{ route('account.myJobs') }}";
            } else {
                var errors = response.errors;

                $("input, select, textarea").removeClass('is-invalid');
                $("p").removeClass('invalid-feedback').html('');

                $.each(errors, function(key, error) {
                    $("#" + key).addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(error);
                });
            }
        }
    });
});
</script>
@endsection
