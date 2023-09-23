<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Grade;

class Classroom extends Model
{
    use HasTranslations;

    protected $table = 'classrooms';

    public $translatable = ['name'];

    protected $fillable = [
        'id',
        'name',
        'grade_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function grade(){

        return $this->belongsTo(Grade::class, 'grade_id');

    }

}
