<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use UuidTrait;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(): bool
    {
        return $this->admin;
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'registrations');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function resolutions()
    {
        return $this->hasMany(Resolution::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function alreadyRegistered(Course $course): bool
    {
        return !!$this->courses()->find($course->id);
    }

    public function findResolutionsByCourse(Course $course): array
    {
        $resolutions = [];
        $activities = $course->activities;

        foreach ($activities as $activity) {
            $resolutions[] = $this->findLastResolutionByActivity($activity);
        }
        
        return $resolutions;
    }

    public function findLastResolutionByActivity(Activity $activity): ResolutionInterface
    {
        $resolution = $this
            ->resolutions()
            ->whereHas('activity', function (Builder $query) use ($activity) {
                $query->where('id', $activity->id);
            })
            ->get()
            ->last()
        ;

        if (!$resolution) {
            return new NullResolution();
        }

        return $resolution;
    }

    public function isRegisteredOnCourse(Course $course): bool
    {
        return !!$this->courses()->find($course->id);
    }

    public function doesViewVideo(Video $video): bool
    {
        foreach ($this->views as $view) {
            if ($view->video->id == $video->id) {
                return true;
            }
        }

        return false;
    }

    public function countViewedVideosByCourse(Course $course): int
    {
        $viewed = 0;
        foreach ($course->videos as $video) {
            if ($this->doesViewVideo($video)) {
                $viewed++;
            }
        }

        return $viewed;
    }
}
