<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class WordStatus extends Enum
{
    const Unlearned = 'unlearned';
    const Learned = 'learned';
    const Shortlisted = 'shortlisted';
}
