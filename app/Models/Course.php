<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    use UuidTrait;

    public $incrementing = false;
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
