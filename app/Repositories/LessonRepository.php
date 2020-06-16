<?php

namespace App\Repositories;

use App\Models\Lesson;

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
}
