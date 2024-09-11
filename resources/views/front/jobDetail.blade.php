@extends('front.layouts.app')

@section('main')
    <section class="section-4 bg-white py-5">
        <div class="container mb-4">
            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 shadow-sm">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('jobs') }}" class="text-decoration-none text-muted">
                            <i class="fa fa-arrow-left text"></i> Back to Jobs
                        </a>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="container job_details_area">
            <div class="row">
                <div class="col-md-8">
                    @include('front.message')

                    <div class="card shadow-sm border-0 mb-4 bg-light">
                        <div class="p-4">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h4 class="mb-1 fw-bold">{{ $job->title }}</h4>
                                    <div class="d-flex align-items-center text-muted">
                                        <span><i class="fa fa-map-marker-alt"></i> {{ $job->location }}</span>
                                        <span class="ms-3"><i class="fa fa-clock"></i> {{ $job->jobType->name }}</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <a href="javascript:void(0);" onclick="saveJob({{ $job->id }})"
                                        class="text-danger fs-4">
                                        <i class="fa {{ $count == 1 ? 'fa-heart' : 'fa-heart-o' }}"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="p-4">
                            <h5>Job Description</h5>
                            <div>{!! nl2br($job->description) !!}</div>
                            @if (!empty($job->responsibility))
                                <h5 class="mt-4">Responsibility</h5>
                                <div>{!! nl2br($job->responsibility) !!}</div>
                            @endif
                            @if (!empty($job->qualifications))
                                <h5 class="mt-4">Qualifications</h5>
                                <div>{!! nl2br($job->qualifications) !!}</div>
                            @endif
                            @if (!empty($job->benefits))
                                <h5 class="mt-4">Benefits</h5>
                                <div>{!! nl2br($job->benefits) !!}</div>
                            @endif

                            <div class="text-end mt-4">
                                @if (Auth::check())
                                    <a href="javascript:void(0);" onclick="saveJob({{ $job->id }}, this);"
                                        class="btn btn-secondary rounded-full fw-bold">
                                        <i class="fa {{ $count == 1 ? 'fa-bookmark-o' : 'fa-bookmark' }}"
                                            aria-hidden="true"></i>
                                        <span class="ms-2">{{ $count == 1 ? 'Unsave' : 'Save' }}</span>
                                    </a>
                                    @if (!$application || $application->status == 'rejected')
                                        <a href="javascript:void(0);" onclick="applyJob({{ $job->id }})"
                                            class="btn btn-gradient rounded-full ms-2 fw-bold">Apply</a>
                                    @else
                                    <a href="javascript:void(0);" onclick="applyJob({{ $job->id }})"
                                        class="btn btn-gradient rounded-full ms-2 fw-bold">Applied</a>
                                    @endif
                                @else
                                    <a href="javascript:void(0);" class="btn btn-outline-secondary disabled">Login to
                                        Save</a>
                                    <a href="javascript:void(0);" class="btn btn-primary ms-2 disabled">Login to Apply</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if (Auth::check() && Auth::user()->id == $job->user_id)
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="p-4 bg-white">
                                <h5 class="mb-3">Applicants</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Designation</th>
                                                <th>Applied Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($applications->isNotEmpty())
                                                @foreach ($applications as $application)
                                                    @if ($application->status != 'rejected')
                                                        <tr>
                                                            <td>{{ $application->user->name }}</td>
                                                            <td>{{ $application->user->email }}</td>
                                                            <td>{{ $application->user->mobile }}</td>
                                                            <td>{{ $application->user->designation }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($application->applied_date)->format('d M, Y') }}
                                                            </td>
                                                            <td>
                                                                @if ($application->status == 'pending')
                                                                    <button class="btn btn-success btn-sm rounded-full"
                                                                        onclick="updateStatus('{{ $application->id }}', 'accepted')">Accept</button>
                                                                    <button class="btn btn-danger btn-sm rounded-full"
                                                                        onclick="updateStatus('{{ $application->id }}', 'rejected')">Reject</button>
                                                                @else
                                                                    <span class="text-green-600">Accepted</span>
                                                                @endif
                                                    @endif
                                                    </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5" class="text-center">No applicants found</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="p-4 bg-light">
                            <h5>Job Summary:</h5>
                            <ul class="list-unstyled">
                                <li>Published on: <span
                                        class="fw-bold">{{ \Carbon\Carbon::parse($job->created_at)->format('d M, Y') }}</span>
                                </li>
                                <li>Vacancy: <span class="fw-bold">{{ $job->vacancy }}</span></li>
                                @if (!empty($job->salary))
                                    <li>Salary: <span class="fw-bold">{{ $job->salary }}</span></li>
                                @endif
                                <li>Location: <span class="fw-bold">{{ $job->location }}</span></li>
                                <li>Job Nature: <span class="fw-bold">{{ $job->jobType->name }}</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0">
                        <div class="p-4 bg-light">
                            <h5>Company Details:</h5>
                            <ul class="list-unstyled">
                                <li>Name: <span class="fw-bold">{{ $job->company_name }}</span></li>
                                @if (!empty($job->company_location))
                                    <li>Location: <span class="fw-bold">{{ $job->company_location }}</span></li>
                                @endif
                                @if (!empty($job->company_website))
                                    <li>Website: <span class="fw-bold"><a href="{{ $job->company_website }}"
                                                class="text">{{ $job->company_website }}</a></span></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script type="text/javascript">
        function applyJob(id) {
            if (confirm("Are you sure you want to apply for this job?")) {
                $.ajax({
                    url: '{{ route('applyJob') }}',
                    type: 'post',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        window.location.href = "{{ url()->current() }}";
                    }
                });
            }
        }

        function saveJob(id) {
            $.ajax({
                url: '{{ route('saveJob') }}',
                type: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    window.location.href = "{{ url()->current() }}";
                }
            });
        }

        function updateStatus(applicationId, status) {
            let url = '';

            if (status === 'accepted') {
                url = '/applications/' + applicationId + '/accept';
            } else if (status === 'rejected') {
                url = '/applications/' + applicationId + '/reject';
            }

            $.ajax({
                url: url,
                type: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: applicationId
                },
                success: function(response) {
                    if (response.success) {
                        alert('Application ' + status + ' successfully!');
                        location.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                    alert('An error occurred. Please try again.');
                }
            });
        }
    </script>
@endsection
