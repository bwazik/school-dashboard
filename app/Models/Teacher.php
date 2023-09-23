<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Specialization;
use App\Models\Gender;
use App\Models\Section;

class Teacher extends Model
{
    use HasTranslations;

    protected $table = 'teachers';

    public $translatable = ['name'];

    protected $fillable = [
        'id',
        'email',
        'password',
        'name',
        'specialization_id',
        'gender_id',
        'joining_date',
        'address',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    # Relation Many to many with sections
    public function sections()
    {
        return $this->belongsToMany(Section::class, 'teacher_section');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
