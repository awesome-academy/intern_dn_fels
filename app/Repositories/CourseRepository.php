<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\UserCourse;

class CourseRepository
{
    /**
     * Get all courses that given user has enrolled
     * 
     * @param \App\Models\User $user
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getEnrolledCourses($user)
    {
        $courses = Course::all()
            ->where('is_enrolled', true);

        return $courses;
    }

    /**
     * Get all courses with enrollment status of given users
     * 
     * @param \App\Models\User $user
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll($user)
    {
        $courses = Course::simplePaginate(config('constants.pagination.courses_per_page'));

        return $courses;
    }
}
