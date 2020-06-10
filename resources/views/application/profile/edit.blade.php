@extends('layouts.application.master')

@section('content')

<div class="container">
    <div class="card profile-card mx-auto">

        <form action="{{ route('profile.update') }}" method="POST">
            {{ csrf_field() }}
            @method('PUT')

            <div class="card-header text-center">
                <div class="row">
                    <div class="col-4">
                        <img class="card-img-top" src="{{ asset($user->avatar_url) }}">
                    </div>

                    <div class="col-8">
                        <textarea name="introduction" class="form-control" rows="7">{{ $user->introduction }}</textarea>
                    </div>
                </div>

                <hr>

            </div>

            <div class="card-body">
                <ul class="list-group striped-list">
                    @include('common.errors')
                    
                    <li class="row">
                        <span class="col-4">{{ trans('labels.profilePage.username') }}</span>
                        <input type="text" name="name" class="col-8" value="{{ $user->name }}">
                    </li>
                    
                    <li class="row">
                        <span class="col-4">{{ trans('labels.profilePage.email') }}</span>
                        <input type="text" name="email" class="col-8" value="{{ $user->email }}">
                    </li>
                    
                    <li class="row">
                        <span class="col-4">{{ trans('labels.profilePage.birthday') }}</span>
                        <input type="date" name="date_of_birth" class="col-8" value="{{ $user->date_of_birth }}">
                    </li>
                    
                    <li class="row">
                        <span class="col-4">{{ trans('labels.profilePage.address') }}</span>
                        <input type="text" name="address" class="col-8" value="{{ $user->address }}">
                    </li>
                    
                    <li class="row">
                        <span class="col-4">{{ trans('labels.profilePage.gender') }}</span>
                        <select name="gender" id="gender">
                            <option value="1" {{ $user->gender == 1? 'selected' : '' }}>{{ trans('labels.profilePage.male') }}</option>
                            <option value="0" {{ $user->gender == 0? 'selected' : '' }}>{{ trans('labels.profilePage.female') }}</option>
                        </select>
                    </li>

                    <div class="text-center my-2">
                        <input type="submit" class="btn btn-outline-success mx-4" value="{{ trans('labels.save') }}">
                        <a href="{{ route('profile.show') }}" class="btn btn-outline-danger mx-4">{{ trans('labels.cancel') }}</a>
                    </div>
                </ul>
            </div>
        </form>
    </div>
</div>

@endsection
