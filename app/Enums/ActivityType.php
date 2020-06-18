<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class ActivityType extends Enum
{
    const Empty = 'empty';
    const FollowUser = 'followUser';
    const UnfollowUser = 'unfollowUser';
    const EnrollCourse = 'enrollCourse';
    const StartLesson = 'startLesson';
    const FinishLesson = 'finishLesson';
    const LearnWord = 'learnWord';
}
