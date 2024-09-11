<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Models\Job;

class EmployerController extends Controller
{
    public function acceptApplication($applicationId)
{
    $application = JobApplication::findOrFail($applicationId);
    $application->status = 'accepted';
    $application->save();

    return response()->json(['success' => true, 'message' => 'Application accepted']);
}

public function rejectApplication($applicationId)
{
    $application = JobApplication::findOrFail($applicationId);
    $application->status = 'rejected';
    $application->save();

    return response()->json(['success' => true, 'message' => 'Application rejected']);
}

}
