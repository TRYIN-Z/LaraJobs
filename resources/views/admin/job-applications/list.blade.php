@extends('front.layouts.app')

@section('main')
<section class="section-5 flex flex-col">
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-white rounded-3 shadow-lg p-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item text"><a href="{{ route('admin.dashboard') }}"
                                class="text-decoration-none text-slate-800">Home</a></li>
                        <li class="breadcrumb-item active text-slate-600" aria-current="page">Job Applications</li>
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
                <div class="card border-0 shadow-lg mb-4">
                    <div class="card-body card-form">
                        <div class="card-body card-form">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="fs-4 mb-1">Job Applications</h3>
                                <p class="text-slate-800 fw-bold fs-4">
                                    <span class="text-blue-600">{{ $applications->total() }}</span> Job{{ $applications->total() > 1 ? 's' : '' }} Found                                </p>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Job Title</th>
                                        <th scope="col">Employee</th>
                                        <th scope="col">Employer</th>
                                        <th scope="col">Applied Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @if ($applications->isNotEmpty())
                                        @foreach ($applications as $application)
                                        <tr>
                                            <td>
                                                <p class="fw-bold">{{ $application->job->title }}</p>
                                            </td>
                                            <td>{{ $application->user->name }}</td>
                                            <td>
                                                {{ $application->employer->name }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($application->applied_date)->format('d M, Y') }}</td>
                                            <td>
                                                @if ($application->status == 'pending')
                                                    <span class="text-yellow-500">{{ $application->status }}</span>
                                                @elseif ($application->status == 'accepted')
                                                    <span class="text-green-500">{{ $application->status }}</span>
                                                @else
                                                    <span class="text-red-500">{{ $application->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="action-dots ">
                                                    <button href="#" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item hover:text-red-600" onclick="deleteJobApplication({{ $application->id }})" href="javascript:void(0);"  ><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="5"
                                                class="text-center py-4 bg-gray-100 text-gray-700 rounded-md shadow-sm">
                                                <i class="fa fa-info-circle text-blue-500 mr-2" aria-hidden="true"></i>
                                                <span class="font-semibold">No Job Found</span>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div>
                            {{ $applications->links() }}
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
    function deleteJobApplication(id) {
        if (confirm("Are you sure you want to delete?")) {
            $.ajax({
                url: '{{ route("admin.jobApplications.destroy") }}',
                type: 'delete',
                data: { id: id },
                dataType: 'json',
                success: function(response) {
                    window.location.href = "{{ route('admin.jobApplications') }}";
                }
            });
        }
    }
</script>
@endsection
