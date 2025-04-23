<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Subject extends Model
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
