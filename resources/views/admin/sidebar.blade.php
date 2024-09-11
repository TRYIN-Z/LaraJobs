<div class="card account-nav border-0 shadow-lg mb-4 mb-lg-0">
    <div class="card-body p-0">
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('admin.users') }}" class="text text-slate-800 d-flex align-items-center">
                    <i class="bi bi-person me-2"></i> Users
                </a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('admin.jobs') }}" class="text text-slate-800 d-flex align-items-center">
                    <i class="bi bi-briefcase me-2"></i> Jobs
                </a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('admin.jobApplications') }}" class="text text-slate-800 d-flex align-items-center">
                    <i class="bi bi-file-earmark-text me-2"></i> Job Applications
                </a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('account.logout') }}"
                    class="text text-slate-800 d-flex align-items-center hover:text-red-600">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</div>
