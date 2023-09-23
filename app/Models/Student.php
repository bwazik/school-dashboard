<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasTranslations, SoftDeletes;

    protected $table = 'students';

    public $translatable = ['name'];

    protected $fillable = [
        'id',
        'email',
        'password',
        'name',
        'grade_id',
        'classroom_id',
        'section_id',
        'gender_id',
        'parent_id',
        'nationality',
        'blood_type',
        'birthday',
        'academic_year',
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

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function myParent()
    {
        return $this->belongsTo(MyParent::class, 'parent_id');
    }

    public function Nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality');
    }

    public function blood()
    {
        return $this->belongsTo(Blood::class, 'blood_type');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
