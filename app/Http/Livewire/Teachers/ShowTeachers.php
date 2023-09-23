<?php

namespace App\Http\Livewire\Teachers;

use Livewire\Component;
use App\Models\Teacher;
use App\Models\Specialization;
use App\Models\Gender;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Hash;

class ShowTeachers extends Component
{
    public $showTable = true, 
    
    $email , $password, $teacher_id, $delete_selected_id,

    $name_ar, $name_en, $specialization_id, $gender_id,
    $joining_date , $address;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'email' => 'required | email | unique:teachers,email,' . $this->teacher_id,
            'password' => 'required | min:8',
            'name_ar' => 'required',
            'name_en' => 'required',
            'specialization_id' => 'required',
            'gender_id' => 'required',
            'joining_date' => 'required | date',
            'address' => 'required',
        ]);
    }
    
    public function render()
    {
        return view('livewire.teachers.teachers.livewire', [
            'teachers' => Teacher::all(),
            'specializations' => Specialization::all(),
            'genders' => Gender::all(),
        ]);
    }

    public function edit($id)
    {
        $this -> showTable = false;
        $teacher = Teacher::where('id' , $id)->first();

        $this -> teacher_id = $id;
        $this -> email = $teacher -> email;
        $this -> password = $teacher -> password;
        $this -> name_ar = $teacher -> getTranslation('name', 'ar');
        $this -> name_en = $teacher -> getTranslation('name', 'en');
        $this -> specialization_id = $teacher -> specialization_id;
        $this -> gender_id = $teacher -> gender_id;
        $this -> joining_date = $teacher -> joining_date;
        $this -> address = $teacher -> address;
    }

    public function submitForm()
    {
        $this->validate([
            'email' => 'required | email | unique:teachers,email,' . $this->teacher_id,
            'password' => 'required | min:8',
            'name_ar' => 'required',
            'name_en' => 'required',
            'specialization_id' => 'required',
            'gender_id' => 'required',
            'joining_date' => 'required | date',
            'address' => 'required',
        ]);

        if ($this -> teacher_id){
            $teacher = Teacher::find($this -> teacher_id);
            
            $teacher->update([
                'email' => $this -> email,
                'password' => Hash::make($this -> password),
        
                'name' => ['en' => $this -> name_en, 'ar' => $this -> name_ar],
                'specialization_id' => $this -> specialization_id,
                'gender_id' => $this -> gender_id,
                'joining_date' => $this -> joining_date,
                'address' => $this -> address,
            ]);
        }

        Flasher::addSuccess(trans('teachers/teachers.edited'));

        $this -> showTable = true;
    }

    public function delete($id){
        Teacher::findOrFail($id)->delete();

        Flasher::addSuccess(trans('teachers/teachers.deleted'));
    }

    public function delete_selected()
    {
        $all = $this -> delete_selected_id;

        $delete_selected_id = explode("," , $all);

        Teacher::whereIn('id', $delete_selected_id)->delete();

        Flasher::addSuccess(trans('teachers/teachers.deleted'));
    }

}
