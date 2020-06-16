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

    <div class="container">

        <div class="title my-4">
            <h2>{{ trans('lesson.labels.test') }}</h2>
        </div>

        <div class="questions my-2">
            <form action="{{ route('lessons.submit', [ 'lesson' => $lessonID]) }}" method="POST">
                
                @csrf
    
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
                                        <input class="form-check-input" type="radio" name="{{ $question->id }}" value="{{ $answer->id }}">
                                        <label class="form-check-label" for="question-{{ $question->id }}">{{ $answer->word->value }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
    
                <input type="submit" value="{{ trans('lesson.labels.submit') }}" class="btn btn-outline-danger">
    
            </form>
        </div>


    </div>

</body>
