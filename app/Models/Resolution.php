<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resolution extends Model implements ResolutionInterface
{
    use HasFactory, UuidTrait;

    public $incrementing = false;

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function calculateScore(): float
    {
        $numberOfAnswers = $this->answers->count();
        $numberOfCorrectAnswers = $this->answers->reduce(
            fn(int $sum, $answer) => $sum + $answer->option->correct,
            0
        );

        $score = ($numberOfCorrectAnswers / $numberOfAnswers) * 100;

        return round($score, 2);
    }
}
