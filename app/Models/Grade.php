<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Section;

class Grade extends Model
{
    use HasTranslations;

    protected $table = 'grades';

    public $translatable = ['name'];

    protected $fillable = [
        'id',
        'name',
        'note',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function section(){

        return $this->hasMany(Section::class, 'grade_id');

    }
}
