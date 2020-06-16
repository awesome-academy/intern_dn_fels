<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonResult extends Model
{
    protected $fillable = [
        'score',
        'answers',
        'user_id',
        'lesson_id',
    ];

    const CREATED_AT = null;
    const UPDATED_AT = 'learned_at';

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
