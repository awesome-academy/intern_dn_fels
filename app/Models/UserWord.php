<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWord extends Model
{
    protected $table = 'user_word';

    protected $fillable = [
        'user_id',
        'word_id',
        'status',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function word()
    {
        return $this->belongsTo(Word::class);
    }
}
