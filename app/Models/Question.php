<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'value',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Question::class);
    }
}
