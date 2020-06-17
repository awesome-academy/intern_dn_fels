@extends('layouts.application.master')

@section('content')

<div class="container">
    <div class="enrolled">
        <h2>{{ trans('course.labels.yourCourses') }}</h2>

        <div class="course-list row">
            @foreach ($enrolledCourses as $course)
                <div class="col-6">
                    @include('application.course.meta')
                </div>
            @endforeach
        </div>
    
    </div>

    <hr>

    <div class="all">

        <h2>{{ trans('course.labels.category') }}</h2>

        <div class="category-list d-flex flex-row">
            @foreach ($categories as $category)
                <div class="category w-25 text-center card mx-1 mb-4 shadow-sm {{ Request::input('category') == $category->id ? 'bg-success text-white' : 'bg-light' }}">
                    <div class="card-body">
                        <a href="{{ Request::fullUrlWithQuery(['category' => $category->id]) }}" class="text-dark">
                            {{ $category->name }}
                            <img src="{{ url($category->image) }}" class="img-fluid">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        @if (!empty($allCourses))

            <div class="course-list row">
                @foreach ($allCourses as $course)
                    <div class="col-12">
                        @include('application.course.meta')
                    </div>
                @endforeach
            </div>
        
        @endif

    </div>
</div>

@endsection
