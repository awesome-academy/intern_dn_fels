@extends('layouts.application.master')

@section('content')

<div class="container">
    <div class="card profile-card mx-auto">

        <div class="card-header text-center">
            <div class="row">
                <div class="col-4">
                    <img class="card-img-top" src="{{ asset($user->avatar_url) }}">
                </div>

                <div class="col-8">
                    <p class="text-justify">{{ $user->introduction }}</p>
                </div>
            </div>

            <hr>

            @if (Auth::user()->id === $user->id)
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-success">{{ trans('labels.profilePage.edit') }}</a>
            @else
                <span href="" id="follow-btn" class="btn btn-outline-primary" data-id={{ $user->id }}>
                    @if (Auth::user()->isFollowing($user->id))
                        {{ trans('labels.profilePage.unfollow') }}
                    @else
                        {{ trans('labels.profilePage.follow') }}
                    @endif
                </span>
            @endif
        </div>

        <div class="card-body">
            <ul class="list-group striped-list">
                <li class="row">
                    <span class="col-4">{{ trans('labels.profilePage.username') }}</span>
                    <span class="col-8">{{ $user->name }}</span>
                </li>
                
                <li class="row">
                    <span class="col-4">{{ trans('labels.profilePage.email') }}</span>
                    <span class="col-8">{{ $user->email }}</span>
                </li>
                
                <li class="row">
                    <span class="col-4">{{ trans('labels.profilePage.birthday') }}</span>
                    <span class="col-8">{{ $user->date_of_birth }}</span>
                </li>
                
                <li class="row">
                    <span class="col-4">{{ trans('labels.profilePage.address') }}</span>
                    <span class="col-8">{{ $user->address }}</span>
                </li>
                
                <li class="row">
                    <span class="col-4">{{ trans('labels.profilePage.gender') }}</span>
                    <span class="col-8">{{ $user->gender ? trans('labels.profilePage.male') : trans('labels.profilePage.female') }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ URL::asset('/js/follow.js') }}"></script>

@endsection
