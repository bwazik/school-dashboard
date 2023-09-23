<?php

namespace App\Http\Livewire\Parents;

use Livewire\Component;
use App\Models\Blood;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Religion;
use App\Models\Image;
use Illuminate\Support\Facades\Hash;
use Flasher\Laravel\Facade\Flasher;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class AddParent extends Component
{
    use WithFileUploads;

    public $currentStep = 1,

    $email , $password,
    $attachments = [],

    # Father Informations
    $father_name_ar, $father_name_en,
    $father_job_ar, $father_job_en,
    $father_national_id, $father_passport_id,
    $father_phone, $father_address,
    $father_nationality, $father_blood_type, $father_religion,

    # Mother Informations
    $mother_name_ar, $mother_name_en,
    $mother_job_ar, $mother_job_en,
    $mother_national_id, $mother_passport_id,
    $mother_phone, $mother_address,
    $mother_nationality, $mother_blood_type, $mother_religion;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'email' => 'required | email | unique:parents,email,' . $this->id,
            'password' => 'required | min:8',
            'attachments.*' => 'image | mimes:jpg,jpeg,png | max:1024',

            'father_name_ar' => 'required',
            'father_name_en' => 'required',
            'father_job_ar' => 'required',
            'father_job_en' => 'required',
            'father_national_id' => 'required | string | min:10 | max:10 | regex:/[0-9]{9}/ | unique:parents,father_national_id,' . $this->id,
            'father_passport_id' => 'required | string | min:10 | max:10 | regex:/[0-9]{9}/ | unique:parents,father_passport_id,' . $this->id,
            'father_phone' => 'required | string | regex:/^([0-9\s\-\+\(\)]*)$/ | min:10 | unique:parents,father_phone,' . $this->id,
            'father_address' => 'required',
            'father_nationality' => 'required | integer',
            'father_blood_type' => 'required | integer',
            'father_religion' => 'required | integer',

            'mother_name_ar' => 'required',
            'mother_name_en' => 'required',
            'mother_job_ar' => 'required',
            'mother_job_en' => 'required',
            'mother_national_id' => 'required | string | min:10 | max:10 | regex:/[0-9]{9}/ | unique:parents,mother_national_id,' . $this->id,
            'mother_passport_id' => 'required | string | min:10 | max:10 | regex:/[0-9]{9}/ | unique:parents,mother_passport_id,' . $this->id,
            'mother_phone' => 'required | string | regex:/^([0-9\s\-\+\(\)]*)$/ | min:10 | unique:parents,mother_phone,' . $this->id,
            'mother_address' => 'required',
            'mother_nationality' => 'required | integer',
            'mother_blood_type' => 'required | integer',
            'mother_religion' => 'required | integer',
        ]);
    }

    public function render()
    {
        return view('livewire.parents.add.livewire', [
            'nationalities' => Nationality::all(),
            'religions' => Religion::all(),
            'bloods' => Blood::all(),
        ]);
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'email' => 'required | email | unique:parents,email,' . $this->id,
            'password' => 'required | min:8',

            'father_name_ar' => 'required',
            'father_name_en' => 'required',
            'father_job_ar' => 'required',
            'father_job_en' => 'required',
            'father_national_id' => 'required | string | min:10 | max:10 | regex:/[0-9]{9}/ | unique:parents,father_national_id,' . $this->id,
            'father_passport_id' => 'required | string | min:10 | max:10 | regex:/[0-9]{9}/ | unique:parents,father_passport_id,' . $this->id,
            'father_phone' => 'required | string | regex:/^([0-9\s\-\+\(\)]*)$/ | min:10 | unique:parents,father_phone,' . $this->id,
            'father_address' => 'required',
            'father_nationality' => 'required | integer',
            'father_blood_type' => 'required | integer',
            'father_religion' => 'required | integer',
        ]);

        $this -> currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $this->validate([
            'mother_name_ar' => 'required',
            'mother_name_en' => 'required',
            'mother_job_ar' => 'required',
            'mother_job_en' => 'required',
            'mother_national_id' => 'required | string | min:10 | max:10 | regex:/[0-9]{9}/ | unique:parents,mother_national_id,' . $this->id,
            'mother_passport_id' => 'required | string | min:10 | max:10 | regex:/[0-9]{9}/ | unique:parents,mother_passport_id,' . $this->id,
            'mother_phone' => 'required | string | regex:/^([0-9\s\-\+\(\)]*)$/ | min:10 | unique:parents,mother_phone,' . $this->id,
            'mother_address' => 'required',
            'mother_nationality' => 'required | integer',
            'mother_blood_type' => 'required | integer',
            'mother_religion' => 'required | integer',
        ]);

        $this -> currentStep = 3;
    }

    public function back($step)
    {
        $this -> currentStep = $step;
    }

    public function submitForm()
    {
        $this->validate([
            'attachments.*' => 'image | mimes:jpg,jpeg,png | max:1024',
        ]);

        DB::beginTransaction();

        $parent = new MyParent();

        $parent -> email = $this -> email;
        $parent -> password = Hash::make($this -> password);

        $parent -> father_name = ['en' => $this -> father_name_en, 'ar' => $this -> father_name_ar];
        $parent -> father_national_id = $this -> father_national_id;
        $parent -> father_passport_id = $this -> father_passport_id;
        $parent -> father_phone = $this -> father_phone;
        $parent -> father_job = ['en' => $this -> father_job_en, 'ar' => $this -> father_job_ar];
        $parent -> father_nationality = $this -> father_nationality;
        $parent -> father_blood_type = $this -> father_blood_type;
        $parent -> father_religion = $this -> father_religion;
        $parent -> father_address = $this -> father_address;

        $parent -> mother_name = ['en' => $this -> mother_name_en, 'ar' => $this -> mother_name_ar];
        $parent -> mother_national_id = $this -> mother_national_id;
        $parent -> mother_passport_id = $this -> mother_passport_id;
        $parent -> mother_phone = $this -> mother_phone;
        $parent -> mother_job = ['en' => $this -> mother_job_en, 'ar' => $this -> mother_job_ar];
        $parent -> mother_nationality = $this -> mother_nationality;
        $parent -> mother_blood_type = $this -> mother_blood_type;
        $parent -> mother_religion = $this -> mother_religion;
        $parent -> mother_address = $this -> mother_address;
        $parent -> save();

        if (!empty($this -> attachments)){
            foreach ($this -> attachments as $attachment) {
                $name = $attachment -> getClientOriginalName();
                $attachment -> storeAs('attachments/parents/'.$this -> email, $attachment -> getClientOriginalName(), 'upload_attachments');

                $images = new Image();
                $images -> file_name = $name;
                $images -> imageable_id = $parent -> id;
                $images -> imageable_type = 'App\Models\MyParent';
                $images -> save();
            }
        }

        DB::commit();

        Flasher::addSuccess(trans('parents/add.added'));
        $this -> clearForm();
        $this -> currentStep = 1;

        DB::rollback();
    }

    public function clearForm()
    {
        $this -> email = '';
        $this -> password = '';
        $this -> attachments = '';

        $this -> father_name_ar = '';
        $this -> father_name_en = '';
        $this -> father_national_id = '';
        $this -> father_passport_id = '';
        $this -> father_phone = '';
        $this -> father_job_ar = '';
        $this -> father_job_en = '';
        $this -> father_nationality = '';
        $this -> father_blood_type = '';
        $this -> father_religion = '';
        $this -> father_address = '';

        $this -> mother_name_ar = '';
        $this -> mother_name_en = '';
        $this -> mother_national_id = '';
        $this -> mother_passport_id = '';
        $this -> mother_phone = '';
        $this -> mother_job_ar = '';
        $this -> mother_job_en = '';
        $this -> mother_nationality = '';
        $this -> mother_blood_type = '';
        $this -> mother_religion = '';
        $this -> mother_address = '';
    }
}
