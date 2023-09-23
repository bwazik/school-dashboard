<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MyParent extends Model
{
    use HasTranslations;

    protected $table = 'parents';

    public $translatable = [
        'father_name',
        'father_job',
        'mother_name',
        'mother_job',
    ];

    protected $fillable = [
        'id',
        'email',
        'password',
        'father_name',
        'father_national_id',
        'father_passport_id',
        'father_phone',
        'father_job',
        'father_nationality',
        'father_blood_type',
        'father_religion',
        'father_address',
        'mother_name',
        'mother_national_id',
        'mother_passport_id',
        'mother_phone',
        'mother_job',
        'mother_nationality',
        'mother_blood_type',
        'mother_religion',
        'mother_address',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function nationality_f()
    {
        return $this->belongsTo(Nationality::class, 'father_nationality');
    }

    public function nationality_m()
    {
        return $this->belongsTo(Nationality::class, 'mother_nationality');
    }

    public function blood_f()
    {
        return $this->belongsTo(Blood::class, 'father_blood_type');
    }

    public function blood_m()
    {
        return $this->belongsTo(Blood::class, 'mother_blood_type');
    }

    public function religion_f()
    {
        return $this->belongsTo(Religion::class, 'father_religion');
    }

    public function religion_m()
    {
        return $this->belongsTo(Religion::class, 'mother_religion');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
