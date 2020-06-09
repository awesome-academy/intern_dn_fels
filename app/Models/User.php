<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get all activities of current user
     */
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    /**
     * Get all courses that current user enrolled in
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'user_course', 'user_id', 'course_id');
    }

    /**
     * Get all enrollment information of current user
     */
    public function enrollments()
    {
        return $this->hasMany(UserCourse::class);
    }

    /**
     * Get all users that follow current user
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'follower_id');
    }

    /**
     * Get all users that are followed by current user
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'user_id');
    }

    /**
     * Get all words that relates to current user
     */
    public function words()
    {
        return $this->belongsToMany(Word::class, 'user_word', 'user_id', 'word_id');
    }

    public function wordHistories()
    {
        return $this->hasMany(UserWord::class);
    }

    /**
     * Get all lesson that current user has joined
     */
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_results', 'user_id', 'lesson_id');
    }

    /**
     * Get all result from lessons which problem has been solved by current user
     */
    public function lessonHistories()
    {
        return $this->hasMany(LessonResult::class);
    }

    /**
     * Get all answers chosen by current user
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
