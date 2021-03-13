<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    public const AVERAGE_SCORE_TO_PASS = 70;

    use HasFactory, UuidTrait;

    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function isConcluded(): bool
    {
        if ($this->calculateScore() < self::AVERAGE_SCORE_TO_PASS) {
            return false;
        }

        return $this->isAllVideosWatched();
    }

    public function isInProgress(): bool
    {
        return !$this->isConcluded();
    }

    public function calculateScore(): float
    {
        $resolutions = $this->user->findResolutionsByCourse($this->course);
        $score = 0;

        foreach ($resolutions as $resolution) {
            $score += $resolution->calculateScore();
        }

        return round($score / (count($resolutions) ?: 1), 2);
    }

    public function isAllVideosWatched(): bool
    {
        $videos = $this->course->videos;

        foreach ($videos as $video) {
            if ($this->user->doesViewVideo($video)) {
                continue;
            }

            return false;
        }

        return true;
    }
}
