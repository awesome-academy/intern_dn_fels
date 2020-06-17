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

    /**
     * Get one course by given id with all detail information
     * @param int $id
     * @return Course
     */
    public function getDetail($id)
    {
        $course = Course::with('lessons')
            ->get()
            ->find($id);

        return $course;
    }

    /**
     * Get all courses belong to category with given id
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByCategory($categoryID)
    {
        $courses = Course::with('category')
            ->get()
            ->where('category.id', $categoryID);

        return $courses;
    }
}
