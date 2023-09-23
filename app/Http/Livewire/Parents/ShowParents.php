<?php

namespace App\Http\Livewire\Parents;

use Livewire\Component;
use App\Models\Blood;
use App\Models\MyParent;
use App\Models\ParentAttachment;
use App\Models\Nationality;
use App\Models\Religion;
use Illuminate\Support\Facades\Hash;
use Flasher\Laravel\Facade\Flasher;
use Livewire\WithFileUploads;

class ShowParents extends Component
{
    use WithFileUploads;

    public $currentStep = 1,
    $showTable = true,

    $parent_id, $email , $password,
    $attachments = [], $delete_selected_id,

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
            'email' => 'required | email | unique:parents,email,' . $this->parent_id,
            'password' => 'required | min:8',
            'attachments.*' => 'max:1024',

            'father_name_ar' => 'required',
            'father_name_en' => 'required',
            'father_job_ar' => 'required',
            'father_job_en' => 'required',
            'father_national_id' => 'required | string | min:10 | max:10 | regex:/[0-9]{9}/ | unique:parents,father_national_id,' . $this->parent_id,
            'father_passport_id' => 'required | string | min:10 | max:10 | regex:/[0-9]{9}/ | unique:parents,father_passport_id,' . $this->parent_id,
            'father_phone' => 'required | string | regex:/^([0-9\s\-\+\(\)]*)$/ | min:10 | unique:parents,father_phone,' . $this->parent_id,
            'father_address' => 'required',
            'father_nationality' => 'required',
            'father_blood_type' => 'required',
            'father_religion' => 'required',

            'mother_name_ar' => 'required',
            'mother_name_en' => 'required',
            'mother_job_ar' => 'required',
            'mother_job_en' => 'required',
            'mother_national_id' => 'required | string | min:10 | max:10 | regex:/[0-9]{9}/ | unique:parents,mother_national_id,' . $this->parent_id,
            'mother_passport_id' => 'required | string | min:10 | max:10 | regex:/[0-9]{9}/ | unique:parents,mother_passport_id,' . $this->parent_id,
            'mother_phone' => 'required | string | regex:/^([0-9\s\-\+\(\)]*)$/ | min:10 | unique:parents,mother_phone,' . $this->parent_id,
            'mother_address' => 'required',
            'mother_nationality' => 'required',
            'mother_blood_type' => 'required',
            'mother_religion' => 'required',
        ]);
    }

    public function render()
    {
        return view('livewire.parents.parents.livewire', [
            'parents' => MyParent::all(),
            'nationalities' => Nationality::all(),
            'religions' => Religion::all(),
            'bloods' => Blood::all(),
        ]);
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'email' => 'required | email | unique:parents,email,' . $this->parent_id,
            'password' => 'required | min:8',

            'father_name_ar' => 'required',
            'father_name_en' => 'required',
            'father_job_ar' => 'required',
            'father_job_en' => 'required',
            'father_national_id' => 'required | string | min:10 | max:10 | regex:/[0-9]{9}/ | unique:parents,father_national_id,' . $this->parent_id,
            'father_passport_id' => 'required | string | min:10 | max:10 | regex:/[0-9]{9}/ | unique:parents,father_passport_id,' . $this->parent_id,
            'father_phone' => 'required | string | regex:/^([0-9\s\-\+\(\)]*)$/ | min:10 | unique:parents,father_phone,' . $this->parent_id,
            'father_address' => 'required',
            'father_nationality' => 'required',
            'father_blood_type' => 'required',
            'father_religion' => 'required',
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
            'mother_national_id' => 'required | string | min:10 | max:10 | regex:/[0-9]{9}/ | unique:parents,mother_national_id,' . $this->parent_id,
            'mother_passport_id' => 'required | string | min:10 | max:10 | regex:/[0-9]{9}/ | unique:parents,mother_passport_id,' . $this->parent_id,
            'mother_phone' => 'required | string | regex:/^([0-9\s\-\+\(\)]*)$/ | min:10 | unique:parents,mother_phone,' . $this->parent_id,
            'mother_address' => 'required',
            'mother_nationality' => 'required',
            'mother_blood_type' => 'required',
            'mother_religion' => 'required',
        ]);

        $this -> currentStep = 3;
    }

    public function back($step)
    {
        $this -> currentStep = $step;
    }

    public function edit($id)
    {
        $this -> showTable = false;
        $parent = MyParent::where('id' , $id)->first();

        $this -> parent_id = $id;
        $this -> email = $parent -> email;
        $this -> password = $parent -> password;
        $this -> father_name_ar = $parent -> getTranslation('father_name', 'ar');
        $this -> father_name_en = $parent -> getTranslation('father_name', 'en');
        $this -> father_national_id = $parent -> father_national_id;
        $this -> father_passport_id = $parent -> father_passport_id;
        $this -> father_phone = $parent -> father_phone;
        $this -> father_job_ar = $parent -> getTranslation('father_job', 'ar');;
        $this -> father_job_en = $parent -> getTranslation('father_job', 'en');
        $this -> father_nationality = $parent -> father_nationality;
        $this -> father_blood_type = $parent -> father_blood_type;
        $this -> father_religion = $parent -> father_religion;
        $this -> father_address = $parent -> father_address;

        $this -> mother_name_ar = $parent -> getTranslation('mother_name', 'ar');
        $this -> mother_name_en = $parent -> getTranslation('mother_name', 'en');
        $this -> mother_national_id = $parent -> mother_national_id;
        $this -> mother_passport_id = $parent -> mother_passport_id;
        $this -> mother_phone = $parent -> mother_phone;
        $this -> mother_job_ar = $parent -> getTranslation('mother_job', 'ar');;
        $this -> mother_job_en = $parent -> getTranslation('mother_job', 'en');
        $this -> mother_nationality = $parent -> mother_nationality;
        $this -> mother_blood_type = $parent -> mother_blood_type;
        $this -> mother_religion = $parent -> mother_religion;
        $this -> mother_address = $parent -> mother_address;
    }

    public function submitForm()
    {
        if ($this -> parent_id){
            $parent = MyParent::find($this -> parent_id);

            $parent->update([
                'email' => $this -> email,
                'password' => Hash::make($this -> password),

                'father_name' => ['en' => $this -> father_name_en, 'ar' => $this -> father_name_ar],
                'father_national_id' => $this -> father_national_id,
                'father_passport_id' => $this -> father_passport_id,
                'father_phone' => $this -> father_phone,
                'father_job' => ['en' => $this -> father_job_en, 'ar' => $this -> father_job_ar],
                'father_nationality' => $this -> father_nationality,
                'father_blood_type' => $this -> father_blood_type,
                'father_religion' => $this -> father_religion,
                'father_address' => $this -> father_address,

                'mother_name' => ['en' => $this -> mother_name_en, 'ar' => $this -> mother_name_ar],
                'mother_national_id' => $this -> mother_national_id,
                'mother_passport_id' => $this -> mother_passport_id,
                'mother_phone' => $this -> mother_phone,
                'mother_job' => ['en' => $this -> mother_job_en, 'ar' => $this -> mother_job_ar],
                'mother_nationality' => $this -> mother_nationality,
                'mother_blood_type' => $this -> mother_blood_type,
                'mother_religion' => $this -> mother_religion,
                'mother_address' => $this -> mother_address,
            ]);
        }

        Flasher::addSuccess(trans('parents/parents.edited'));

        $this -> showTable = true;
    }

    public function delete($id)
    {
        MyParent::findOrFail($id)->delete();

        Flasher::addSuccess(trans('parents/parents.deleted'));
    }
}
