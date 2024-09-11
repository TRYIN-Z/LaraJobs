@extends('front.layouts.app')

@section('main')
    <section class="section-5  bg-2 flex flex-col">
        <div class="container py-5">
            <div class="row mb-4">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-white rounded-3 shadow-lg p-3">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item text"><a href="{{ route('admin.dashboard') }}"
                                    class="text-decoration-none text-slate-800">Home</a></li>
                            <li class="breadcrumb-item active text-slate-600" aria-current="page">Jobs</li>
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
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="fs-4 mb-1">Jobs</h3>
                                <p class="text-slate-800 fw-bold fs-4">
                                    <span class="text-blue-600">{{ $jobs->total() }}</span> Job{{ $jobs->total() > 1 ? 's' : '' }} Found
                                </p>
                            </div>
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Created By</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @if ($jobs->isNotEmpty())
                                            @foreach ($jobs as $job)
                                                <tr>
                                                    <td>{{ $job->id }}</td>
                                                    <td>
                                                        <p class="fw-bold text-gray-800">{{ $job->title }}</p>
                                                        <p>Applicants: {{ $job->applications->where('status', '!=', 'rejected')->count() }}</p>
                                                    </td>
                                                    <td>{{ $job->user->name }}</td>
                                                    <td>
                                                        @if ($job->status == 1)
                                                            <p class="text-success">Active</p>
                                                        @else
                                                            <p class="text-danger">Block</p>
                                                        @endif
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($job->created_at)->format('d M, Y') }}</td>
                                                    <td>
                                                        <div class="action-dots ">
                                                            <button href="#" class="btn" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item"
                                                                        href="{{ route('admin.jobs.edit', $job->id) }}"><i
                                                                            class="fa fa-edit" aria-hidden="true"></i>
                                                                        Edit</a></li>
                                                                <li><a class="dropdown-item hover:text-red-600"
                                                                        onclick="deleteJob({{ $job->id }})"
                                                                        href="javascript:void(0);"><i class="fa fa-trash"
                                                                            aria-hidden="true"></i> Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="6"
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
                                {{ $jobs->links() }}
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
        function deleteJob(id) {
            if (confirm("Are you sure you want to delete?")) {
                $.ajax({
                    url: '{{ route('admin.jobs.destroy') }}',
                    type: 'delete',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        window.location.href = "{{ route('admin.jobs') }}";
                    }
                });
            }
        }
    </script>
@endsection
