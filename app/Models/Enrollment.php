<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'student_id',
        'subject_user_id',
        'payment_id',
        'status',
        'payment_method',
        'amount'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Get the course for this enrollment
     */
    public function course()
    {
        return $this->belongsTo(SubjectUser::class, 'subject_user_id');
    }
}
