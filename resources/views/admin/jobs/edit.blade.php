@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-light py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 bg-white shadow-sm">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item text"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item text-blue-400 hover:text-purple-400"><a
                                    href="{{ route('admin.jobs') }}">Jobs</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('admin.sidebar')
                </div>
                <div class="col-lg-9">
                    @include('front.message')

                    <form action="{{ route('admin.jobs.update', ['id' => $job->id]) }}" method="post" id="editJobForm" name="editJobForm">
                        @csrf
                        <div class="card border-0 shadow-lg rounded-xl">
                            <div class="card-body p-4">
                                <h3 class="fs-4 mb-4">Job Details</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
                                        <input type="text" id="title" name="title" value="{{ $job->title }}" placeholder="Job Title" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="category" class="form-label">Category<span class="text-danger">*</span></label>
                                        <select name="category" id="category" class="form-select" disabled>
                                            <option value="">Select a Category</option>
                                            @if ($categories->isNotEmpty())
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $job->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="jobType" class="form-label">Job Type<span class="text-danger">*</span></label>
                                        <select name="jobType" id="jobType" class="form-select" disabled>
                                            <option value="">Select Job Type</option>
                                            @if ($jobTypes->isNotEmpty())
                                                @foreach ($jobTypes as $jobType)
                                                    <option value="{{ $jobType->id }}" {{ $job->job_type_id == $jobType->id ? 'selected' : '' }}>
                                                        {{ $jobType->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="vacancy" class="form-label">Vacancy<span class="text-danger">*</span></label>
                                        <input type="number" id="vacancy" name="vacancy" value="{{ $job->vacancy }}" min="1" placeholder="Vacancy" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="salary" class="form-label">Salary</label>
                                        <input type="text" id="salary" name="salary" value="{{ $job->salary }}" placeholder="Salary" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="location" class="form-label">Location<span class="text-danger">*</span></label>
                                        <input type="text" id="location" name="location" value="{{ $job->location }}" placeholder="Location" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <div class="form-check">
                                            <input {{ ($job->isFeatured == 1) ? 'checked' : '' }} class="form-check-input" type="checkbox" value="1" id="isFeatured" name="isFeatured">
                                            <label class="form-check-label" for="isFeatured">
                                                Top
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-4 col-md-6">
                                        <div class="form-check-inline">
                                            <input {{ ($job->status == 1) ? 'checked' : '' }} class="form-check-input" type="radio" value="1" id="status-active" name="status">
                                            <label class="form-check-label" for="status-active">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input {{ ($job->status == 0) ? 'checked' : '' }} class="form-check-input" type="radio" value="0" id="status-block" name="status">
                                            <label class="form-check-label" for="status-block">
                                                Block
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="description" class="form-label">Description<span class="text-danger">*</span></label>
                                    <textarea id="description" name="description" class="form-control" rows="5" placeholder="Description" readonly>{{ $job->description }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="benefits" class="form-label">Benefits</label>
                                    <textarea id="benefits" name="benefits" class="form-control" rows="5" placeholder="Benefits" readonly>{{ $job->benefits }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="responsibility" class="form-label">Responsibility</label>
                                    <textarea id="responsibility" name="responsibility" class="form-control" rows="5" placeholder="Responsibility" readonly>{{ $job->responsibility }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="qualifications" class="form-label">Qualifications</label>
                                    <textarea id="qualifications" name="qualifications" class="form-control" rows="5" placeholder="Qualifications" readonly>{{ $job->qualifications }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="experience" class="form-label">Experience <span class="text-danger">*</span></label>
                                    <select name="experience" id="experience" class="form-select" disabled>
                                        <option value="1" {{ $job->experience == 1 ? 'selected' : '' }}>1 Year</option>
                                        <option value="2" {{ $job->experience == 2 ? 'selected' : '' }}>2 Years</option>
                                        <option value="3" {{ $job->experience == 3 ? 'selected' : '' }}>3 Years</option>
                                        <option value="4" {{ $job->experience == 4 ? 'selected' : '' }}>4 Years</option>
                                        <option value="5" {{ $job->experience == 5 ? 'selected' : '' }}>5 Years</option>
                                        <option value="6" {{ $job->experience == 6 ? 'selected' : '' }}>6 Years</option>
                                        <option value="7" {{ $job->experience == 7 ? 'selected' : '' }}>7 Years</option>
                                        <option value="8" {{ $job->experience == 8 ? 'selected' : '' }}>8 Years</option>
                                        <option value="9" {{ $job->experience == 9 ? 'selected' : '' }}>9 Years</option>
                                        <option value="10" {{ $job->experience == 10 ? 'selected' : '' }}>10 Years</option>
                                        <option value="10_plus" {{ $job->experience == '10_plus' ? 'selected' : '' }}>10+ Years</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="keywords" class="form-label">Keywords</label>
                                    <input type="text" id="keywords" name="keywords" value="{{ $job->keywords }}" placeholder="Keywords" class="form-control" readonly>
                                </div>

                                <h3 class="fs-4 mt-5 border-top pt-4">Company Details</h3>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="company_name" class="form-label">Name<span class="text-danger">*</span></label>
                                        <input type="text" id="company_name" name="company_name" value="{{ $job->company_name }}" placeholder="Company Name" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="company_location" class="form-label">Location</label>
                                        <input type="text" id="company_location" name="company_location" value="{{ $job->company_location }}" placeholder="Location" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="website" class="form-label">Website</label>
                                    <input type="text" id="website" name="website" value="{{ $job->company_website }}" placeholder="Website" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="card-footer bg-light p-4">
                                <button type="submit" class="btn btn-gradient fw-bold rounded-full">Update Job</button>
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
        $("#editJobForm").submit(function(e) {
            e.preventDefault();
            $("button[type='submit']").prop('disabled', true);
            $.ajax({
                url: '{{ route('admin.jobs.update', $job->id) }}',
                type: 'PUT',
                dataType: 'json',
                data: $("#editJobForm").serializeArray(),
                success: function(response) {
                    $("button[type='submit']").prop('disabled', false);
                    window.location.href = "{{ route('admin.jobs') }}";
                }
            });
        });

        function deleteUser(id) {
            if (confirm("Are you sure you want to delete?")) {
                $.ajax({
                    url: '{{ route('admin.users.destroy') }}',
                    type: 'delete',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        window.location.href = "{{ route('admin.users') }}";
                    }
                });
            }
        }
    </script>
@endsection
