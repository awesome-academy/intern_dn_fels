<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Repositories\CourseRepository;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    /** @param \App\Repositories\CourseRepository $repository */
    protected $repository;

    public function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
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

        $enrolledCourses = $this->repository->getEnrolledCourses($user);
        $allCourses = $this->repository->getAll($user);

        return view('application.course.index', [
            'enrolledCourses' => $enrolledCourses,
            'allCourses' => $allCourses,
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
        $course = $this->repository->getDetail($id);

        if (empty($course)) {
            abort(404);
        }

        return view('application.course.detail', [
            'course' => $course,
        ]);
    }
}
