<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAccount extends Model
{
    protected $table = 'student_account';

    protected $fillable = [
        'id',
        'grade_id',
        'classroom_id',
        'student_id',
        'debit',
        'credit',
        'note',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
