<?php

namespace App\Http\Livewire\Teachers;

use Livewire\Component;
use App\Models\Teacher;
use App\Models\Specialization;
use App\Models\Gender;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Hash;
class AddTeacher extends Component
{
    public $email , $password,

    $name_ar, $name_en, $specialization_id, $gender_id,
    $joining_date , $address;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'email' => 'required | email | unique:teachers,email',
            'password' => 'required | min:8',
            'name_ar' => 'required',
            'name_en' => 'required',
            'specialization_id' => 'required | integer',
            'gender_id' => 'required | integer',
            'joining_date' => 'required | date | date_format:Y-m-d',
            'address' => 'required',
        ]);
    }

    public function render()
    {
        return view('livewire.teachers.add.livewire', [
            'specializations' => Specialization::all(),
            'genders' => Gender::all(),
        ]);
    }

    public function submitForm()
    {
        $this->validate([
            'email' => 'required | email | unique:teachers,email',
            'password' => 'required | min:8',
            'name_ar' => 'required',
            'name_en' => 'required',
            'specialization_id' => 'required | integer',
            'gender_id' => 'required | integer',
            'joining_date' => 'required | date | date_format:Y-m-d',
            'address' => 'required',
        ]);

        $teacher = new Teacher();
        $teacher -> email = $this -> email;
        $teacher -> password =  Hash::make($this -> password);
        $teacher -> name = ['ar' => $this-> name_ar , 'en' => $this -> name_en];
        $teacher -> specialization_id = $this -> specialization_id;
        $teacher -> gender_id = $this -> gender_id;
        $teacher -> joining_date = $this -> joining_date;
        $teacher -> address = $this -> address;

        $teacher -> save();
        Flasher::addSuccess(trans('teachers/add.added'));
        $this -> clearForm();
    }

    public function clearForm()
    {
        $this -> email = '';
        $this -> password = '';
        $this -> name_ar = '';
        $this -> name_en = '';
        $this -> specialization_id = '';
        $this -> gender_id = '';
        $this -> joining_date = '';
        $this -> address = '';
    }
}
