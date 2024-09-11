<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::orderBy('id', 'ASC')->with('user', 'applications')->paginate(10);
        return view('admin.jobs.list', [
            'jobs' => $jobs
        ]);
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);

        $categories = Category::orderBy('name', 'ASC')->get();
        $jobTypes = JobType::orderBy('name', 'ASC')->get();

        return view('admin.jobs.edit', [
            'job' => $job,
            'categories' => $categories,
            'jobTypes' => $jobTypes,
        ]);
    }

    public function update(Request $request, $id)
    {
        $job = Job::find($id);

        $job->status = $request->status;
        $job->isFeatured = (!empty($request->isFeatured)) ? $request->isFeatured : 0;
        $job->save();

        session()->flash('success', 'Job updated successfully.');

        return response()->json([
            'status' => true,
            'errors' => []
        ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $job = Job::find($id);

        if ($job == null) {
            session()->flash('error', 'Either job deleted or not found');
            return response()->json([
                'status' => false
            ]);
        }

        $job->delete();
        session()->flash('success', 'Job deleted successfully.');
        return response()->json([
            'status' => true
        ]);
    }
}
