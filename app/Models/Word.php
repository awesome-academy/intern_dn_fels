<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $fillable = [
        'value',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
