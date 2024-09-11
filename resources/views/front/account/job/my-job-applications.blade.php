@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-light">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4 bg-white shadow-sm">
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
                    <div class="card border-0 shadow mb-4 p-3">
                        <div class="card-body card-form">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="fs-4 mb-1">
                                        @if (Auth::user()->role == 'user')
                                            Jobs Applied
                                        @else
                                            Applications
                                        @endif
                                    </h3>
                                </div>

                            </div>
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">Title</th>
                                            @if (Auth::user()->role == 'employer')
                                                <th scope="col">Name</th>
                                                <th scope="col">Designation</th>
                                            @endif
                                            <th scope="col">Applied Date</th>
                                            <th scope="col">Applicants</th>
                                            <th scope="col">Status</th>
                                            @if (Auth::user()->role == 'user')
                                                <th scope="col">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @if ($jobApplications->isNotEmpty())
                                            @foreach ($jobApplications as $jobApplication)
                                                <tr class="active">
                                                    <td>
                                                        <div class="job-name fw-bold">
                                                            <a href="{{ route('jobDetail', $jobApplication->job_id) }}">
                                                                {{ $jobApplication->job->title }}
                                                            </a>
                                                        </div>
                                                        <div class="info1">{{ $jobApplication->job->jobType->name }} .
                                                            {{ $jobApplication->job->location }}</div>
                                                    </td>
                                                    @if (Auth::user()->role == 'employer')
                                                        <td>{{ $jobApplication->user->name }}</td>
                                                        <td>{{ $jobApplication->user->designation }}</td>
                                                    @endif
                                                    <td>{{ \Carbon\Carbon::parse($jobApplication->applied_date)->format('d M, Y') }}
                                                    </td>
                                                    <td>{{ $jobApplication->job->applications->where('status', 'accepted')->count() }}
                                                        Applications</td>
                                                    <td>
                                                        @if ($jobApplication->status == 'pending')
                                                            @if (Auth::user()->role == 'user')
                                                                <div class="job-status text-capitalize text-yellow-500">
                                                                    Pending
                                                                </div>
                                                            @else
                                                                <button class="btn btn-success btn-sm rounded-full"
                                                                    onclick="updateStatus('{{ $jobApplication->id }}', 'accepted')">Accept</button>
                                                                <button class="btn btn-danger btn-sm rounded-full"
                                                                    onclick="updateStatus('{{ $jobApplication->id }}', 'rejected')">Reject</button>
                                                            @endif
                                                        @elseif ($jobApplication->status == 'accepted')
                                                            <div class="job-status text-capitalize text-green-500">
                                                                Accepted
                                                            </div>
                                                        @else
                                                            <div class="job-status text-capitalize text-red-500">
                                                                Rejected
                                                            </div>
                                                        @endif
                                                    </td>
                                                    @if (Auth::user()->role == 'user')
                                                        <td>
                                                            <div class="action-dots">
                                                                <button href="#" class="btn"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item"
                                                                            href="{{ route('jobDetail', $jobApplication->job_id) }}">
                                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                                            View</a></li>
                                                                    <li><a class="dropdown-item hover:text-red-600"
                                                                            href="#"
                                                                            onclick="removeJob({{ $jobApplication->id }})"><i
                                                                                class="fa fa-trash" aria-hidden="true"></i>
                                                                            Remove</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5"
                                                    class="text-center py-4 bg-gray-100 text-gray-700 rounded-md shadow-sm">
                                                    <i class="fa fa-info-circle text-blue-500 mr-2" aria-hidden="true"></i>
                                                    <span class="font-semibold">No Job Applications Found</span>
                                                </td>
                                            </tr>
                                        @endif


                                    </tbody>
                                </table>
                            </div>
                            <div>
                                {{ $jobApplications->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('customJs')
    <script type="text/javascript">
        function removeJob(id) {
            if (confirm("Are you sure you want to remove?")) {
                $.ajax({
                    url: '{{ route('account.removeJobs') }}',
                    type: 'post',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        window.location.href = '{{ route('account.myJobApplications') }}';
                    }
                });
            }
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
