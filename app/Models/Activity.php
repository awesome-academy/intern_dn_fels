<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'target',
    ];

    protected $appends = [
        'message',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getMessageAttribute()
    {
        return trans("activity.$this->type", [
            'user' => $this->user->name,
            'target' => $this->target,
        ]);
    }
}
