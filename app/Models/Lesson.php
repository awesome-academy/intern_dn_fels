<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Lesson extends Model
{
    protected $fillable = [
        'name',
        'value',
    ];

    protected $appends = [
        'is_completed',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Check if user has complete this lesson
     * @return bool
     */
    public function getIsCompletedAttribute()
    {
        $user = Auth::user();

        return LessonResult::where('user_id', $user->id)
            ->where('lesson_id', $this->id)
            ->exists();
    }
}
