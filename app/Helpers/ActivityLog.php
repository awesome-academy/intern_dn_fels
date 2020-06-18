<?php

namespace App\Helpers;

use App\Enums\ActivityType;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class ActivityLog
{
    /**
     * Insert a new activity to log
     * 
     */
    public static function add(string $type, string $target)
    {
        Auth::user()->activities()->create([
            'type' => $type,
            'target' => $target,
        ]);
    }

    /**
     * Get all activities done by given user
     * 
     * @param User $user
     * @return Collection
     */
    public static function get(User $user)
    {
        $activities = Activity::where('user_id', $user->id)
            ->orderBy('done_at', 'desc')
            ->get();

        return $activities;
    }
}
