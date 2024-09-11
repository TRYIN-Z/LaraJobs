@extends('front.layouts.app')

@section('main')

    <!-- Hero Section -->
    <section
        class="relative h-72 bg-gradient-to-r from-blue-500 to-purple-600 flex flex-col justify-center items-center text-center space-y-6 mb-8 shadow-lg rounded-lg overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-20 bg-no-repeat bg-center bg-cover"></div>
        <div class="z-10">
            <h1 class="text-5xl font-extrabold uppercase text-white drop-shadow-md">
                Lara<span class="text-gray-600">Jobs</span>
            </h1>
            <p class="text-xl text-gray-300 font-semibold my-4 drop-shadow-md">
                Find or post jobs
            </p>
            <a href="{{ route('jobs') }}"
                class="mt-4 px-6 py-3 bg-white text-blue-600 font-semibold rounded-full shadow-md hover:text-purple-600 transition ease-in-out duration-200">
                Get Started
            </a>
        </div>
    </section>

    <!-- Search Section -->
    <section class="py-10 bg-gray-100">
        <div class="container mx-auto">
            <div class="bg-white p-8 rounded-xl shadow-lg">
                <form action="{{ route('jobs') }}" method="GET" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div>
                            <label for="keyword" class="block text-sm font-medium text-gray-700">Keyword</label>
                            <input type="text"
                                class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                                name="keyword" id="keyword" placeholder="Job title, skills, or company">
                        </div>
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text"
                                class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                                name="location" id="location" placeholder="City or state">
                        </div>
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category" id="category"
                                class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500">
                                <option value="">Select a Category</option>
                                @if ($newCategories->isNotEmpty())
                                    @foreach ($newCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="w-full px-6 py-3 btn btn-gradient rounded-full fw-bold">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="py-5 bg-gray-50">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold mb-6">Categories</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @if ($categories->isNotEmpty())
                    @foreach ($categories as $category)
                        <div class="p-4 bg-white rounded-lg shadow-md text-center">
                            <a href="{{ route('jobs', ['category' => $category->id]) }}">
                                <h4 class="text-xl font-semibold">{{ $category->name }}</h4>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- Top Jobs -->
    <section class="py-5">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold mb-6">Top Jobs ({{ $featuredJobs->count() }})</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @if ($featuredJobs->isNotEmpty())
                    @foreach ($featuredJobs as $featuredJob)
                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <h3 class="text-2xl font-semibold mb-2">{{ $featuredJob->title }}</h3>
                            <p class="text-gray-700">{{ Str::words(strip_tags($featuredJob->description), 5) }}</p>
                            <div class="mt-4">
                                <p class="text-sm text-gray-600"><i class="fa fa-map-marker-alt"></i>
                                    {{ $featuredJob->location }}</p>
                                <p class="text-sm text-gray-600"><i class="fa fa-clock"></i>
                                    {{ $featuredJob->jobType->name }}</p>
                                @if (!is_null($featuredJob->salary))
                                    <p class="text-sm text-gray-600"><i class="fa fa-dollar-sign"></i>
                                        {{ $featuredJob->salary }}</p>
                                @endif
                            </div>
                            <a href="{{ route('jobDetail', $featuredJob->id) }}"
                                class="mt-4 inline-block px-4 py-2 btn-gradient">
                                Details
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- Jobs -->
    <section class="py-5 bg-gray-50">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold mb-6">Jobs ({{ $latestJobs->count() }})</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @if ($latestJobs->isNotEmpty())
                    @foreach ($latestJobs as $latestJob)
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-2xl font-semibold mb-2">{{ $latestJob->title }}</h3>
                            <p class="text-gray-700">{{ Str::words(strip_tags($latestJob->description), 5) }}</p>
                            <div class="mt-4">
                                <p class="text-sm text-gray-600"><i class="fa fa-map-marker-alt"></i>
                                    {{ $latestJob->location }}</p>
                                <p class="text-sm text-gray-600"><i class="fa fa-clock"></i>
                                    {{ $latestJob->jobType->name }}</p>
                                @if (!is_null($latestJob->salary))
                                    <p class="text-sm text-gray-600"><i class="fa fa-dollar-sign"></i>
                                        {{ $latestJob->salary }}</p>
                                @endif
                            </div>
                            <a href="{{ route('jobDetail', $latestJob->id) }}"
                                class="mt-4 inline-block px-4 py-2 btn-gradient">
                                Details
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

@endsection
