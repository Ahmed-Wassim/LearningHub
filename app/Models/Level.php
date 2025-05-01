<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Level extends Model
{
    use Sluggable, HasImage;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'min_age',
        'max_age',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }


}
