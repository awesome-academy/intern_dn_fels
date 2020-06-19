@extends('layouts.application.master')

@section('content')
    <div class="container">
        <div class="w-75 mx-auto">
            <div id="title" class="title">
                <h1>{{ $lesson->name }}</h1>
            </div>

            <hr>

            <div id="description" class="text">
                <p>{{ $lesson->description }}</p>
            </div>

            <div class="item-list row">
                @foreach ($words as $word)
                    <div class="col-4">
                        <div class="w3-card-4 word-card">
                            <img src="{{ $word->word->image_url }}" alt="{{ $word->word->value }}">
                            
                            <div class="w3-container w3-center">
                                <p>{{ $word->word->value }}</p>    
                                <hr>
                                <p>{{ $word->word->definition }}</p>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            <hr>

            <div id="action" class="text text-center">
                @if ($lesson->isCompleted)
                    <a href="{{ route('lessons.result', ['lesson' => $lesson]) }}" class="btn btn-outline-success" target="_blank">{{ trans('lesson.labels.viewResult') }}</a>
                @else
                    <a href="{{ route('lessons.test', ['lesson' => $lesson]) }}" class="btn btn-outline-danger" target="_blank">{{ trans('lesson.labels.toTest') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection
