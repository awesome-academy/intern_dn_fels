<?php

namespace App\Http\Controllers;

use App\Enums\ActivityType;
use App\Helpers\ActivityLog;
use App\Models\Answer;
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
        ActivityLog::add(ActivityType::StartLesson, $lesson->name);

        return view('application.lesson.detail', [
            'lesson' => $lesson,
        ]);
    }

    /**
     * Show test page for lesson with given id
     */
    public function test(int $id)
    {
        $questions = $this->repository->getTest($id);

        return view('application.lesson.test', [
            'questions' => $questions,
            'lessonID' => $id,
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

        $score = 0;

        foreach ($data as $questionID => $answerID) {
            $answer = Answer::find($answerID);

            if (!empty($answer) && $answer->is_correct) {
                $score += 1;
            }
        }

        LessonResult::create([
            'user_id' => Auth::user()->id,
            'lesson_id' => $lesson->id,
            'score' => $score,
            'answers' => json_encode($data),
        ]);

        ActivityLog::add(ActivityType::FinishLesson, $lesson->name);

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
