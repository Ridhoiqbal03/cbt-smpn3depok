<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentAnswer extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [
        'id',
    ];

    public function question(){
        return $this->belongsTo(CourseQuestion::class,'course_question_id');
    }

    public function selectedAnswer()
    {
        return $this->belongsTo(\App\Models\CourseAnswer::class, 'course_answer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
