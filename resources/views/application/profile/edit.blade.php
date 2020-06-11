@extends('layouts.application.master')

@section('content')
<link rel="stylesheet" href="{{ url('/css/image-upload.css') }}">

<div class="container">
    <div class="card profile-card mx-auto">

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PUT')

            <div class="card-header text-center">
                <div class="row">
                    <div class="col-4 drop-image">
                        <label for="imageInput">
                            <img id="imagePreview" class="card-img-top" src="{{ asset($user->avatar_url) }}">
                        </label>
                        <input type="file" name="avatar" id="imageInput"/>
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

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="crossorigin="anonymous"></script>
<script src="{{ url('/js/image-upload.js') }}"></script>

@endsection
