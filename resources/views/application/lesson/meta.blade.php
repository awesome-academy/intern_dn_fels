<div class="lesson-meta card mb-3 shadow-sm">
    <div class="card-body">
        <div class="row">
            <div class="info col-10">
                <h5 class="lesson-name">
                    {{ $lesson->name }}
                </h5>
            </div>
    
            <div class="action col-2 text-center">
                <a href="{{ route('lessons.show', ['lesson' => $lesson]) }}" class="btn btn-outline-success">{{ trans('course.labels.start') }}</a>
            </div>
        </div>
    </div>
</div>
