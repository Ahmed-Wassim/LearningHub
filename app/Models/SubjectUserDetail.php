<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectUserDetail extends Model
{
    protected $fillable = [
        'subject_user_id',
        'short_description',
        'long_description',
    ];

    public function subjectUser()
    {
        return $this->belongsTo(SubjectUser::class, 'subject_user_id');
    }
}
