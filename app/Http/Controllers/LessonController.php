<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Lesson;
use App\Repositories\LessonRepository;
use Illuminate\Http\Request;

class LessonController extends Controller
{

    /** @var \App\Repositories\LessonRepository $repository */
    protected $repository;

    public function __construct(LessonRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show one lesson detail
     * 
     * @param int $id
     * 
     */
    public function show(Lesson $lesson)
    {
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

        return redirect()->route('lessons.show', [
            'lesson' => $lesson,
        ]);
    }
}
