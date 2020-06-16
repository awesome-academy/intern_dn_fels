@extends('layouts.application.master')

@section('content')
    
    <div class="container">

        <div class="title my-4">
            <h2>{{ trans('course.labels.lessons') }}: {{ $lesson->name }}</h2>
            <h2>{{ trans('lesson.labels.result') }} {{ $score }}/{{ $total }}</h2>
        </div>

        <div class="questions my-2">
            @foreach ($questions as $key => $question)
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        {{ trans('lesson.labels.question') }} {{ $key + 1 }}: {{ $question->value }}
                    </div>

                    <div class="card-body">
                        <div class="form-check">
                            <input type="hidden" name="{{ $question->id }}">
                        </div>
                        @foreach ($question->answers as $answer)
                            <div class="form-check">
                                @if ($answer->is_correct)
                                    <input class="form-check-input" type="radio"
                                        name="{{ $question->id }}" value="{{ $answer->id }}"
                                        {{ isset($history[$question->id]) && $history[$question->id] == $answer->id ? 'checked' : '' }}
                                        disabled>
                                    <label class="form-check-label {{ isset($history[$question->id]) && $history[$question->id] == $answer->id ? 'text-success' : 'text-danger' }}" for="question-{{ $question->id }}">{{ $answer->word->value }}</label>
                                @else
                                    <input class="form-check-input" type="radio"
                                        name="{{ $question->id }}" value="{{ $answer->id }}"
                                        {{ isset($history[$question->id]) && $history[$question->id] == $answer->id ? 'checked' : '' }}
                                        disabled>
                                    <label class="form-check-label">{{ $answer->word->value }}</label>
                                @endif

                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="action d-flex flex-column flex-md-row">
            <a href="{{ route('lessons.show', ['lesson' => $lesson]) }}" class="btn btn-outline-primary mx-4">{{ trans('lesson.labels.backToLesson') }}</a>
            <a href="{{ route('courses.show', ['course' => $lesson->id]) }}" class="btn btn-outline-primary mx-4">{{ trans('lesson.labels.backToCourse') }}</a>
        </div>

    </div>
@endsection
