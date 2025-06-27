<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'pdf',
        'word',
        'excel',
        'video'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
