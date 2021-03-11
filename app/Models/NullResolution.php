<?php

namespace App\Models;

class NullResolution implements ResolutionInterface
{
    public function calculateScore(): float
    {
        return 0;
    }
}
