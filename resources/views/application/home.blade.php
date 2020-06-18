@extends('layouts.application.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 col-md-6">
            @if (!empty($activities))
                <div class="card">
                    <div class="card-header text-center">
                        <h2>{{ trans('activity.myActivity') }}</h2>
                    </div>
                    
                    <div class="card-body">
                        <ul>
                            @foreach ($activities as $activity)
                                <li>
                                    <span class="text-secondary">({{ date('d-m-Y H:m:i', strtotime($activity->done_at)) }})</span> {{ $activity->message }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                        
                </div>
            @endif
        </div>
    </div>
</div>
    
@endsection
