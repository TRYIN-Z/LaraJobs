@extends('front.layouts.app')
@include('includes.customCss')

@section('main')
    <section class="section-3 py-5 bg-light">
        <div class="container">
            <!-- Header Section -->
            <div class="row mb-4 align-items-center">
                <div class="col-md-8 col-lg-10">
                    <div class="d-flex align-items-center bg-white rounded-3 shadow-sm p-3">
                        <h2 class="fw-bold text-slate-800 mb-0">Find Jobs</h2>
                    </div>
                </div>
                <div class="col-md-4 col-lg-2">
                    <div class="d-flex justify-content-end rounded-3 bg-white shadow-sm p-2">
                        <select name="sort" id="sort"
                            class="btn form-control border-0 rounded-3 text-slate-800 fw-bold mb-0 hover:text-blue-600 transition duration-150 ease-in-out">
                            <option value="1" {{ Request::get('sort') == '1' ? 'selected' : '' }}>Latest</option>
                            <option value="0" {{ Request::get('sort') == '0' ? 'selected' : '' }}>Oldest</option>
                        </select>
                    </div>
                </div>
            </div>


            <!-- Search and Job Listings -->
            <div class="row pt-5">
                <!-- Sidebar -->
                <div class="col-md-4 col-lg-3 mb-4">
                    <form action="" name="searchForm" id="searchForm">
                        <div class="card border-0 shadow-lg p-4 rounded-xl bg-white">
                            <div class="mb-4">
                                <h3 class="fw-bold text-slate-800 mb-2">Keywords</h3>
                                <input value="{{ Request::get('keyword') }}" type="text" name="keyword" id="keyword"
                                    placeholder="Keywords" class="form-control rounded-full px-3 py-2 shadow-sm">
                            </div>

                            <div class="mb-4">
                                <h3 class="fw-bold text-slate-800 mb-2">Location</h3>
                                <input value="{{ Request::get('location') }}" type="text" name="location" id="location"
                                    placeholder="Location" class="form-control rounded-full px-3 py-2 shadow-sm">
                            </div>

                            <div class="mb-4">
                                <h3 class="fw-bold text-slate-800 mb-2">Category</h3>
                                <select name="category" id="category"
                                    class="form-control rounded-full px-3 py-2 shadow-sm">
                                    <option value="">Select a Category</option>
                                    @if ($categories)
                                        @foreach ($categories as $category)
                                            <option {{ Request::get('category') == $category->id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="mb-6">
                                <h3 class="font-semibold text-lg text-slate-800 mb-4">Job Type</h3>
                                @if ($jobTypes->isNotEmpty())
                                    @foreach ($jobTypes as $jobType)
                                        <div class="form-check mb-2 d-flex align-items-center justify-content-between">
                                            <label
                                                class="form-check-label text-slate-600 cursor-pointer hover:text-blue-600 transition duration-150 ease-in-out"
                                                for="job-type-{{ $jobType->id }}">{{ $jobType->name }}</label>
                                            <input {{ in_array($jobType->id, $jobTypeArray) ? 'checked' : '' }}
                                                class="form-check-input ms-2" type="checkbox" value="{{ $jobType->id }}"
                                                id="job-type-{{ $jobType->id }}" name="job_type">
                                        </div>
                                    @endforeach
                                @endif
                            </div>


                            <div class="mb-4">
                                <h3 class="fw-bold text-slate-800 mb-2">Experience</h3>
                                <select name="experience" id="experience"
                                    class="form-control rounded-full px-3 py-2 shadow-sm">
                                    <option value="">Select Experience</option>
                                    <option value="1" {{ Request::get('experience') == 1 ? 'selected' : '' }}>1 Year
                                    </option>
                                    <option value="2" {{ Request::get('experience') == 2 ? 'selected' : '' }}>2
                                        Years</option>
                                    <option value="3" {{ Request::get('experience') == 3 ? 'selected' : '' }}>3
                                        Years</option>
                                    <option value="4" {{ Request::get('experience') == 4 ? 'selected' : '' }}>4
                                        Years</option>
                                    <option value="5" {{ Request::get('experience') == 5 ? 'selected' : '' }}>5
                                        Years</option>
                                    <option value="6" {{ Request::get('experience') == 6 ? 'selected' : '' }}>6
                                        Years</option>
                                    <option value="7" {{ Request::get('experience') == 7 ? 'selected' : '' }}>7
                                        Years</option>
                                    <option value="8" {{ Request::get('experience') == 8 ? 'selected' : '' }}>8
                                        Years</option>
                                    <option value="9" {{ Request::get('experience') == 9 ? 'selected' : '' }}>9
                                        Years</option>
                                    <option value="10" {{ Request::get('experience') == 10 ? 'selected' : '' }}>10
                                        Years</option>
                                    <option value="10_plus"
                                        {{ Request::get('experience') == '10_plus' ? 'selected' : '' }}>10+ Years
                                    </option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-gradient fw-bold py-2 px-4 rounded-full">Search</button>
                            <a href="{{ route('jobs') }}"
                                class="btn btn-secondary mt-3 text-slate-800 fw-bold py-2 px-4 rounded-full hover:text-slate-800">Reset</a>
                        </div>
                    </form>
                </div>

                <!-- Job Listings -->
                <div class="col-md-8 col-lg-9">
                    <div class="job_listing_area">
                        <div class="mb-4">
                            <h4 class="text-slate-800 font-bold text-2xl md:text-3xl lg:text-4xl">
                                <span class="text-blue-600">{{ $jobs->total() }}</span> Job{{ $jobs->total() > 1 ? 's' : '' }} Found
                            </h4>
                            <p class="text-slate-600 mt-2">
                                Explore the latest job opportunities tailored to your skills and preferences.
                            </p>
                        </div>
                        <div class="job_lists">
                            <div class="row">
                                @if ($jobs->isNotEmpty())
                                    @foreach ($jobs as $job)
                                        <div class="col-md-4 mb-4">
                                            <div
                                                class="card border-0 p-4 shadow-lg rounded-xl transition-transform transform hover:scale-105 bg-white">
                                                <div class="card-body">
                                                    <h3 class="fs-5 pb-2 mb-0 fw-bold text-slate-800">{{ $job->title }}
                                                    </h3>
                                                    <p class="text-slate-600">
                                                        {{ Str::words(strip_tags($job->description), $words = 10, '...') }}
                                                    </p>
                                                    <div class="bg-light p-3 border rounded-xl">
                                                        <p class="mb-0 text-slate-600">
                                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                            <span class="ps-1">{{ $job->location }}</span>
                                                        </p>
                                                        <p class="mb-0 text-slate-600">
                                                            <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                            <span class="ps-1">{{ $job->jobType->name }}</span>
                                                        </p>
                                                        @if (!is_null($job->salary))
                                                            <p class="mb-0 text-slate-600">
                                                                <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                                <span class="ps-1">{{ $job->salary }}</span>
                                                            </p>
                                                        @endif
                                                    </div>
                                                    <div class="d-grid mt-3">
                                                        <a href="{{ route('jobDetail', $job->id) }}"
                                                            class="btn btn-gradient btn-lg fw-bold rounded-full">Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-md-12 mt-4">
                                        {{ $jobs->withQueryString()->links() }}
                                    </div>
                                @else
                                    <div class="col-md-12 text-center">
                                        <div
                                            class="p-4 bg-white text-gray-800 rounded-md shadow-md flex items-center justify-center">
                                            <i class="fa fa-info-circle text-blue-500 mr-3" aria-hidden="true"></i>
                                            <span class="text-lg font-semibold">Jobs not found</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $("#searchForm").submit(function(e) {
            e.preventDefault();

            var url = '{{ route('jobs') }}?';

            var keyword = $("#keyword").val();
            var location = $("#location").val();
            var category = $("#category").val();
            var experience = $("#experience").val();
            var sort = $("#sort").val();

            var checkedJobTypes = $("input:checkbox[name='job_type']:checked").map(function() {
                return $(this).val();
            }).get();

            if (keyword != "") {
                url += '&keyword=' + keyword;
            }

            if (location != "") {
                url += '&location=' + location;
            }

            if (category != "") {
                url += '&category=' + category;
            }

            if (experience != "") {
                url += '&experience=' + experience;
            }

            if (checkedJobTypes.length > 0) {
                url += '&jobType=' + checkedJobTypes;
            }

            url += '&sort=' + sort;

            window.location.href = url;

        });

        $("#sort").change(function() {
            $("#searchForm").submit();
        });
    </script>
@endsection
