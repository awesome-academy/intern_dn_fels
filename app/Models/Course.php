<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Course extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
    ];

    protected $appends = [
        'is_enrolled',
        'is_finished',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_course', 'course_id', 'user_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function enrollments()
    {
        return $this->hasMany(UserCourse::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getIsEnrolledAttribute()
    {
        $user = Auth::user();
        $enrollment = UserCourse::where('user_id', $user->id)
            ->where('course_id', $this->id)
            ->first();

        return !empty($enrollment);
    }

    public function getIsFinishedAttribute()
    {
        $user = Auth::user();
        $enrollment = UserCourse::where('user_id', $user->id)
            ->where('course_id', $this->id)
            ->first();

        if (empty($enrollment)) {
            return false;
        }

        return !is_null($enrollment->finished_at);
    }
}
