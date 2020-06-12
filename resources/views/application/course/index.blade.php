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
        <h2>{{ trans('course.labels.allCourses') }}</h2>

        {{ $allCourses->links() }}
        
        <div class="course-list row">
            @foreach ($allCourses as $course)
                <div class="col-12">
                    @include('application.course.meta')
                </div>
            @endforeach
        </div>

        {{ $allCourses->links() }}
    </div>
</div>

@endsection
