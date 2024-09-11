<div class="card profile-card border-0 shadow mb-4 p-3 text-center">
    <div class="s-body mt-3">
        @if (Auth::user()->image != '')
            <img src="{{ asset('images/' . Auth::user()->image) }}" alt="avatar"
                class="rounded-circle img-fluid profile-avatar"
                style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #6e7bff; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
        @else
            <img src="{{ asset('images/black.jpg') }}" alt="avatar" class="rounded-circle img-fluid profile-avatar"
                style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #6e7bff; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
        @endif

        <h5 class="mt-3 pb-0 gradient-text">{{ Auth::user()->name }}</h5>
        <p class="text-muted mb-1 fs-6">{{ Auth::user()->designation }}</p>
        <div class="d-flex justify-content-center mb-2">
            <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button"
                class="btn btn-gradient fw-bold rounded-full">Change
                Profile Picture</button>
        </div>
    </div>
</div>

<div class="card account-nav border-0 shadow mb-4 mb-lg-0">
    <div class="card-body p-0">
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between p-3">
                <a href="{{ route('account.profile') }}" class="text">Account Settings</a>
            </li>
            @if (Auth::user()->role == 'employer')
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{ route('account.createJob') }}" class="text">Post a Job</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{ route('account.myJobs') }}" class="text">My Jobs</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{ route('account.myJobApplications') }}" class="text">Application</a>
                </li>
            @endif
            @if (Auth::user()->role == 'user')
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{ route('account.myJobApplications') }}" class="text">Jobs Applied</a>
                </li>
            @endif
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('account.savedJobs') }}" class="text">Saved Jobs</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('account.logout') }}" class="text hover:text-red-600">Logout</a>
            </li>
        </ul>
    </div>
</div>
