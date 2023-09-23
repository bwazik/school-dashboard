<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fee extends Model
{
    use HasTranslations;

    protected $table = 'fees';

    public $translatable = ['name'];

    protected $fillable = [
        'id',
        'name',
        'amount',
        'grade_id',
        'classroom_id',
        'note',
        'year',
        'type',
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

}
