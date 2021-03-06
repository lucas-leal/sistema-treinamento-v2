<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';

    use HasFactory;
    use UuidTrait;

    public $incrementing = false;
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'registrations');
    }

    public function activities()
    {
        return $this->hasManyThrough(Activity::class, Unit::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function videos()
    {
        return $this->hasManyThrough(Video::class, Unit::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }
}
