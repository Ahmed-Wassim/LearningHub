<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Lesson extends Model
{
    use Sluggable;

    protected $fillable = [
        'title',
        'video',
        'thumbnail',
        'duration',
        'description',
        'pdf',
        'slug',
        'subject_id'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
