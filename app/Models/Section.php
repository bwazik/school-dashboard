<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Grade;

class Section extends Model
{
    use HasTranslations;

    protected $table = 'sections';

    public $translatable = ['name'];

    protected $fillable = [
        'id',
        'name',
        'status',
        'grade_id',
        'classroom_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function grade(){
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function classroom(){
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    # Relation Many to many with teachers
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_section');
    }
}
