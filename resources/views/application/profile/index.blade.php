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
                    <p>{{ $user->introduction }}</p>
                </div>
            </div>

            <hr>

            <a href="{{ route('profile.edit') }}" class="btn btn-outline-success">{{ trans('labels.profilePage.edit') }}</a>
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

@endsection
