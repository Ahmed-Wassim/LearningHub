<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'min_age',
        'max_age',
        'image',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
