<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonResult extends Model
{
    protected $fillable = [
        'score',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
