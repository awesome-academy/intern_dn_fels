<?php

namespace App\Repositories;

use App\Enums\ActivityType;
use App\Enums\WordStatus;
use App\Helpers\ActivityLog;
use App\Models\Lesson;
use App\Models\LessonResult;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LessonRepository
{

    /**
     * Get all questions belong the lesson with given id
     * 
     */
    public function getTest(int $lessonID)
    {
        $lesson = Lesson::with([
            'questions',
            'questions.answers',
            'questions.answers.word',
        ])
            ->get()
            ->find($lessonID);

        return $lesson->questions;
    }

    /**
     * Save result of the test
     */
    public function saveResult(Lesson $lesson, $data)
    {
        $user = Auth::user();

        $score = 0;

        foreach ($data as $questionID => $answerID) {

            $answer = Answer::find($answerID);

            if (!empty($answer)) {
                if ($answer->is_correct) {
                    $score++;

                    $inserted = DB::table('user_word')->updateOrInsert(
                        [
                            'user_id' => $user->id,
                            'word_id' => $answer->word_id,
                        ],
                        [
                            'status' => WordStatus::Learned,
                        ],
                    );

                    // only track activity for the first time
                    if ($inserted) {
                        ActivityLog::add(ActivityType::LearnWord, $answer->word->value);
                    }
                } else {
                    DB::table('user_word')->insertOrIgnore([
                        'user_id' => $user->id,
                        'word_id' => $answer->word_id,
                        'status' => WordStatus::Unlearned,
                    ]);
                }
            }
        }

        $result = LessonResult::firstOrNew(
            [
                'user_id' => $user->id,
                'lesson_id' => $lesson->id,
            ],
            [
                'score' => $score,
                'answers' => json_encode($data),
            ],
        );

        // Only track activity for the first time
        if (!$result->exists) {
            ActivityLog::add(ActivityType::FinishLesson, $lesson->name);
        }

        $result->save();
    }

    /**
     * Get all correct answers that belong to given lesson
     */
    public function getAllCorrectAnswers($lessonID)
    {
        $answers = Answer::with('word')
            ->with('question')
            ->where('is_correct', true)
            ->get()
            ->where('question.lesson_id', $lessonID);

        return $answers;
    }
}
