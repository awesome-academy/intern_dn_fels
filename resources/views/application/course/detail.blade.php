@extends('layouts.application.master')

<link rel="stylesheet" href="{{ url('/css/course.css') }}">

@section('content')
    <div class="container" id="course_detail">
        <div class="w-75 mx-auto">
            <div id="title">
                <h1>{{ $course->name }}</h1>

                <div id="status">                    
                    @if ($course->isEnrolled)
                        <hr>
                        
                        <span class="badge badge-danger">
                            {{ trans('course.status.enrolled') }}
                        </span>

                        <span class="badge badge-{{ $course->isFinished ? 'success' : 'warning' }}">
                            {{ $course->isFinished ? trans('course.status.finished') : trans('course.status.progress') }}
                        </span>
                    @endif

                </div>
            </div>

            <hr>
    
            <div id="description">
                <p>{{ $course->description }}</p>
            </div>

            @if ($course->isEnrolled)
                <form action="{{ route('courses.leave', ['course' => $course]) }}" method="POST">
                    @csrf
                    <input type="submit" class="btn btn-outline-danger" value="{{ trans('course.labels.leave') }}">
                </form>

                <hr>

                <div class="lessons">
                    <h3 class="mb-4">{{ trans('course.labels.lessons') }}</h3>
                    <div class="lesson-list pl-4">
                        @foreach ($course->lessons as $lesson)
                            @include('application.lesson.meta', [
                                'lesson' => $lesson,
                            ])
                        @endforeach
                    </div>
                </div>
            @else
                <form action="{{ route('courses.enroll', ['course' => $course]) }}" method="POST">
                    @csrf
                    <input type="submit" class="btn btn-outline-success" value="{{ trans('course.labels.enroll') }}">
                </form>

                <hr>
            @endif

        </div>
    </div>
@endsection
