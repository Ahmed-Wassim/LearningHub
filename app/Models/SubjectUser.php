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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

}
