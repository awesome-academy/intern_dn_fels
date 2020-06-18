@extends('layouts.application.master')

@section('content')

<div class="container">

    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{ trans('home.summary') }}</h2>
                </div>
                <div class="card-body">
                    <div class="followed mb-4">
                        <div class="text-dark">{{ trans('home.follow', ['number' => count($follows)]) }}</div>
                        
                        @foreach ($follows->take(config('constants.homepage.max_user_number')) as $follow)
                            <div class="fade-image d-inline-block">
                                <img src="{{ asset($follow->avatar_url) }}" alt="Avatar" class="thumbnail" title="{{ $follow->name }}">
                            </div>
                        @endforeach
                    </div>

                    <div class="words">
                        <div class="text-dark">{{ trans('home.words', ['number' => count($words)]) }}</div>

                        @foreach ($words->take(config('constants.homepage.max_word_number')) as $word)
                            <span class="p-3 badge badge-primary">{{ $word->value }}</span>
                        @endforeach
                        ...

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            @if (!empty($activities))
                <div class="card">
                    <div class="card-header text-center">
                        <h2>{{ trans('home.myActivity') }}</h2>
                    </div>
                    
                    <div class="card-body panel overflow-auto">
                        <ul>
                            @foreach ($activities as $activity)
                                <li>
                                    <span class="text-secondary">({{ date(config('constants.homepage.datetime_format'), strtotime($activity->done_at)) }})</span> {{ $activity->message }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                        
                </div>
            @endif
        </div>

        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h2>{{ trans('home.peopleActivity') }}</h2>
                </div>
                
                <div class="card-body panel overflow-auto">
                    <ul>
                        @foreach ($followedActivities as $activity)
                            <li>
                                <span class="text-secondary">({{ date(config('constants.homepage.datetime_format'), strtotime($activity->done_at)) }})</span> {{ $activity->message }}
                            </li>
                        @endforeach
                    </ul>

                </div>
                    
            </div>
        </div>

    </div>
</div>
    
@endsection
