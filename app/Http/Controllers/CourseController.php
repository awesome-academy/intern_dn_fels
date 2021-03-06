<?php

namespace App\Http\Controllers;

use App\Enums\ActivityType;
use App\Helpers\ActivityLog;
use App\Models\Course;
use App\Repositories\CourseRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    /** @var CourseRepository $courseRepo */
    protected $courseRepo;

    /** @var CategoryRepository $categoryRepo */
    protected $categoryRepo;

    public function __construct(CourseRepository $courseRepo, CategoryRepository $categoryRepo)
    {
        $this->courseRepo = $courseRepo;
        $this->categoryRepo = $categoryRepo;
        $this->middleware('auth');
    }

    /**
     * Show list of courses
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $enrolledCourses = $this->courseRepo->getEnrolledCourses($user);

        $categories = $this->categoryRepo->all();

        if ($request->has('category')) {
            $courses = $this->courseRepo->getByCategory($request->input('category'));
        } else {
            $courses = [];
        }

        return view('application.course.index', [
            'enrolledCourses' => $enrolledCourses,
            'allCourses' => $courses,
            'categories' => $categories,
        ]);
    }

    /**
     * Show course detail
     * 
     * @param Request $request
     * @param int $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        $course = $this->courseRepo->getDetail($id);

        if (empty($course)) {
            abort(404);
        }

        return view('application.course.detail', [
            'course' => $course,
        ]);
    }

    /**
     * Enroll current user to given course
     */
    public function enroll(Request $request, Course $course)
    {
        $course->users()->attach($request->user()->id);

        ActivityLog::add(ActivityType::EnrollCourse, $course->name);

        return redirect()->route('courses.show', [
            'course' => $course,
        ]);
    }

    /**
     * Remove current user from given course
     */
    public function leave(Request $request, Course $course)
    {
        $course->users()->detach($request->user()->id);

        ActivityLog::add(ActivityType::LeaveCourse, $course->name);

        return redirect()->route('courses.show', [
            'course' => $course,
        ]);
    }
}
