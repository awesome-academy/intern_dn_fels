<div class="card mb-4 shadow">
    <div class="card-body">
        <div class="row">
            <div class="info col-12 col-md-10">
                <h4 class="course-name">
                    {{ $course->name }}
                </h4>
                
                <p>
                    {{ trans('course.labels.code') }}:
                    <span class="badge badge-secondary">
                        {{ $course->code }}
                    </span>
                </p>
                <p>
                    @if ($course->isEnrolled)
                    <span class="badge badge-danger">
                        {{ trans('course.status.enrolled') }}
                    </span>
                    
                    <span class="badge badge-{{ $course->isFinished ? 'success' : 'warning' }}">
                        {{ $course->isFinished ? trans('course.status.finished') : trans('course.status.progress') }}
                    </span>
                    @endif
                </p>
            </div>

            <div class="action col-12 col-md-2">
                <a href="#" class="btn btn-outline-primary">{{ trans('course.labels.view') }}</a>
            </div>
        </div>
    </div>
</div>
