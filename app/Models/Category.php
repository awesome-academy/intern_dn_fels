<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    public function words()
    {
        return $this->hasMany(Word::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
