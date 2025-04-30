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

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
