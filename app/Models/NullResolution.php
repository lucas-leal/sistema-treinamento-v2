<?php

namespace App\Models;

class NullResolution implements ResolutionInterface
{
    public function calculateScore(): float
    {
        return 0;
    }

    public function isPassed(): bool
    {
        return false;
    }
    
    public function isValid(): bool
    {
        return false;
    }
}
