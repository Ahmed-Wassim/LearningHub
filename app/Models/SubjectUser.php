<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SubjectUser extends Model
{
    use HasImage;
    protected $table = "subject_user";

    public $with = ['image'];

    protected $fillable = [
        'subject_id',
        'user_id',
        'bio',
        'price',
        'status',
        'active',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function subjectUserDetail()
    {
        return $this->hasOne(SubjectUserDetail::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function freeLessons()
    {
        return $this->hasMany(Lesson::class)
            ->where('is_free', true)
            ->orderBy('created_at', 'desc');
    }

    public function premiumLessons()
    {
        return $this->hasMany(Lesson::class)
            ->where('is_free', false)
            ->orderBy('created_at', 'desc');
    }
}
