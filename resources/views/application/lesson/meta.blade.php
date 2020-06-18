<div class="lesson-meta card mb-3 shadow-sm">
    <div class="card-body">
        <div class="row">
            <div class="info col-9">
                <h5 class="lesson-name">
                    {{ $lesson->name }}
                </h5>
            </div>
    
            <div class="action col-3 text-center">
                @if ($lesson->isCompleted)
                    <a href="{{ route('lessons.show', ['lesson' => $lesson]) }}" class="btn btn-outline-success">{{ trans('lesson.labels.completed') }}</a>
                @else
                    <a href="{{ route('lessons.show', ['lesson' => $lesson]) }}" class="btn btn-outline-danger">{{ trans('course.labels.start') }}</a>
                @endif
            </div>
        </div>
    </div>
</div>
