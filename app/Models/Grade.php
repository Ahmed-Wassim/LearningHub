<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'level_id'
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
