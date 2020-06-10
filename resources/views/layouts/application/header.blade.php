<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FELS</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('/css/layout.css') }}">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
</head>
<body>

<div class="page-header">
    <nav class="navbar navbar-expand-lg mb-4">

        <a class="navbar-brand text-white font-weight-bold" href="#">FELS</a>
    
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
            aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="basicExampleNav">
    
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">{{ trans('labels.home') }}</a>
                </li>

                @guest
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">{{ trans('labels.signIn') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="#">{{ trans('labels.signUp') }}</a>
                </li>
                @endguest


                @auth
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">{{ trans('labels.profile') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="#">{{ trans('labels.wordList') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="#">{{ trans('labels.startLesson') }}</a>
                </li>
                @endauth
            </ul>

        </div>
    </nav>
</div>
