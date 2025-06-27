<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'subject_user_id',
        'title',
        'description',
        'duration',
        'is_free'
    ];

    public function course()
    {
        return $this->belongsTo(SubjectUser::class, 'subject_user_id');
    }

    public function resource()
    {
        return $this->HasOne(Resource::class);
    }
}
