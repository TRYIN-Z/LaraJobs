@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Applications for "{{ $job->title }}"</h1>

    @foreach ($applications as $application)
        <div class="application-card mb-3 p-3 border rounded">
            <h5 class="mb-2">Applicant: {{ $application->user->name }}</h5>
            <p>Status: <span id="status-{{ $application->id }}">{{ $application->status }}</span></p>

            <button class="btn btn-success btn-sm" onclick="updateStatus('{{ $application->id }}', 'accepted')">Accept</button>
            <button class="btn btn-danger btn-sm" onclick="updateStatus('{{ $application->id }}', 'rejected')">Reject</button>
        </div>
    @endforeach
</div>

<script>
function updateStatus(applicationId, status) {
    $.ajax({
        url: '/applications/' + applicationId + '/update-status',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            status: status
        },
        success: function(response) {
            $('#status-' + applicationId).text(status);
            alert(response.message);
        },
        error: function(xhr) {
            console.error('Error:', xhr.responseText);
            alert('An error occurred. Please try again.');
        }
    });
}
</script>
@endsection
