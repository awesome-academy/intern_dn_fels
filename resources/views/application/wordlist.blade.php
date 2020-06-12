@extends('layouts.application.master')

@section('content')

<link rel="stylesheet" href="{{ url('/css/wordlist.css') }}">

<div class="container">
    <table class="table text-center">
        <thead class="thead-dark">
            <tr>
                <th>
                    <a href="{{ Request::fullUrlWithQuery(['sort' => 'value']) }}" class="text-white">
                        {{ trans('wordlist.label.word') }}
                    </a>
                </th>
                
                <th>
                    <a href="{{ Request::fullUrlWithQuery(['sort' => 'category']) }}" class="text-white">
                        {{ trans('wordlist.label.category') }}
                    </a>
                </th>
                
                <th>
                    <a href="{{ Request::fullUrlWithQuery(['sort' => 'status']) }}" class="text-white">
                        {{ trans('wordlist.label.status') }}
                    </a>
                </th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <form action="{{ route('wordlist.index') }}">
                    <td>
                        <input type="text" name="word-filter" id="word-filter" value="{{ Request::input('word-filter') }}">
                    </td>
                    <td>
                        <input type="text" name="category-filter" id="category-filter" value="{{ Request::input('category-filter') }}">
                    </td>
                    <td>
                        <select name="status-filter[]" class="horizontal-select" size="1" multiple>
                            <option value="unlearned" class="word-status-outline-unlearned"
                                {{ (is_array(Request::input('status-filter')) && in_array('unlearned', Request::input('status-filter'))) ? 'selected' : '' }}
                            >
                                {{ trans('wordlist.status.unlearned') }}
                            </option>

                            <option value="learned" class="word-status-outline-learned"
                                {{ (is_array(Request::input('status-filter')) && in_array('learned', Request::input('status-filter'))) ? 'selected' : '' }}
                            >
                                {{ trans('wordlist.status.learned') }}
                            </option>
                            
                            <option value="shortlisted" class="word-status-outline-shortlisted"
                                {{ (is_array(Request::input('status-filter')) && in_array('shortlisted', Request::input('status-filter'))) ? 'selected' : '' }}
                            >
                                {{ trans('wordlist.status.shortlisted') }}
                            </option>
                        </select>
                    </td>
                    <td>
                        <input type="submit" value="Filter" class="btn btn-success">
                    </td>
                </form>
            </tr>

            @foreach ($histories as $wordHistory)
                <tr>
                    <td>{{ $wordHistory->word->value }}</td>
                    <td>{{ $wordHistory->word->category->name }}</td>
                    <td><span class="word-status-{{ $wordHistory->status }}">{{ trans('wordlist.status.' . $wordHistory->status) }}</span></td>
                </tr>
            @endforeach
        </tbody>

    </table>

    <span class="mx-auto">
        {{ $histories->appends(Request::query())->render() }}
    </span>
</div>

@endsection
