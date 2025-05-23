<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Subject extends Model
{
    use Sluggable, HasImage;

    protected $fillable = [
        'name',
        'slug',
        'grade_id',
        'price',
        'is_free'
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'enrollments');
    }

}
