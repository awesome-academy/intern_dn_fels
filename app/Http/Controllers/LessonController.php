<?php

namespace App\Http\Controllers;

use App\Enums\ActivityType;
use App\Helpers\ActivityLog;
use App\Models\Lesson;
use App\Models\LessonResult;
use App\Repositories\LessonRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{

    /** @var \App\Repositories\LessonRepository $repository */
    protected $repository;

    public function __construct(LessonRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('auth');
    }

    /**
     * Show one lesson detail
     * 
     * @param int $id
     * 
     */
    public function show(Lesson $lesson)
    {
        if (!$lesson->isCompleted) {
            ActivityLog::add(ActivityType::StartLesson, $lesson->name);
        }

        return view('application.lesson.detail', [
            'lesson' => $lesson,
        ]);
    }

    /**
     * Show test page for lesson with given id
     */
    public function test(Lesson $lesson)
    {
        // if user has complete this test
        if ($lesson->isCompleted) {
            return redirect()->route('lessons.result', [
                'lesson' => $lesson,
            ]);
        }

        $questions = $this->repository->getTest($lesson->id);

        return view('application.lesson.test', [
            'questions' => $questions,
            'lessonID' => $lesson->id,
        ]);
    }

    /**
     * Handle test submission
     */
    public function handleTest(Request $request, Lesson $lesson)
    {
        $data = $request->except([
            '_token',
        ]);

        $this->repository->saveResult($lesson, $data);

        return redirect()->route('lessons.result', [
            'lesson' => $lesson,
        ]);
    }


    /**
     * Show result of the test for given lesson
     * that done by curretn authencicated user
     */
    public function result(Request $request, Lesson $lesson)
    {
        $user = Auth::user();

        $result = LessonResult::where('user_id', $user->id)
            ->where('lesson_id', $lesson->id)
            ->first();

        if (empty($result)) {
            abort(404);
        }

        $history = json_decode($result->answers, true);

        $questions = $this->repository->getTest($lesson->id);

        return view('application.lesson.result', [
            'questions' => $questions,
            'lesson' => $lesson,
            'history' => $history,
            'score' => $result->score,
            'total' => count($history),
        ]);
    }
}
