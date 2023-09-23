<?php

namespace App\Http\Livewire\Students;

use Livewire\Component;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\Gender;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Blood;
use App\Models\Student;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Hash;

class AddStudent extends Component
{
    public $email , $password,

    $name_ar, $name_en, $grade_id, $classroom_id, $section_id,
    $gender_id, $parent_id,
    $nationality, $blood_type,
    $birthday, $academic_year;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'email' => 'required | email | unique:students,email',
            'password' => 'required | min:8',
            'name_ar' => 'required',
            'name_en' => 'required',
            'grade_id' => 'required | integer',
            'classroom_id' => 'required | integer',
            'section_id' => 'required | integer',
            'gender_id' => 'required | integer',
            'parent_id' => 'required | integer',
            'nationality' => 'required | integer',
            'blood_type' => 'required | integer',
            'birthday' => 'required | date | date_format:Y-m-d',
            'academic_year' => 'required | integer',
        ]);
    }

    public function render()
    {
        return view('livewire.students.add.livewire', [
            'grades' => Grade::all(),
            'classrooms' => Classroom::all(),
            'sections' => Section::all(),
            'genders' => Gender::all(),
            'parents' => MyParent::all(),
            'nationalities' => Nationality::all(),
            'blood_types' => Blood::all(),
        ]);
    }

    public function submitForm()
    {
        $this->validate([
            'email' => 'required | email | unique:students,email',
            'password' => 'required | min:8',
            'name_ar' => 'required',
            'name_en' => 'required',
            'grade_id' => 'required | integer',
            'classroom_id' => 'required | integer',
            'section_id' => 'required | integer',
            'gender_id' => 'required | integer',
            'parent_id' => 'required | integer',
            'nationality' => 'required | integer',
            'blood_type' => 'required | integer',
            'birthday' => 'required | date | date_format:Y-m-d',
            'academic_year' => 'required | integer',
        ]);

        $student = new Student();
        $student -> email = $this -> email;
        $student -> password =  Hash::make($this -> password);
        $student -> name = ['ar' => $this-> name_ar , 'en' => $this -> name_en];
        $student -> grade_id = $this -> grade_id;
        $student -> classroom_id = $this -> classroom_id;
        $student -> section_id = $this -> section_id;
        $student -> gender_id = $this -> gender_id;
        $student -> parent_id = $this -> parent_id;
        $student -> nationality = $this -> nationality;
        $student -> blood_type = $this -> blood_type;
        $student -> birthday = $this -> birthday;
        $student -> academic_year = $this -> academic_year;
        $student -> save();

        Flasher::addSuccess(trans('students/add.added'));
        $this -> clearForm();
    }

    public function clearForm()
    {
        $this -> attachments = '';
        $this -> email = '';
        $this -> password = '';
        $this -> name_ar = '';
        $this -> name_en = '';
        $this -> grade_id = '';
        $this -> classroom_id = '';
        $this -> section_id = '';
        $this -> gender_id = '';
        $this -> nationality = '';
        $this -> blood_type = '';
        $this -> birthday = '';
        $this -> academic_year = '';
    }

    public function getClassrooms($id)
    {
        $classrooms = Classroom::where("grade_id", $id)->pluck("name", "id");
        return $classrooms;
    }

    public function getSections($id)
    {
        $sections = Section::where("classroom_id", $id)->pluck("name", "id");
        return $sections;
    }
}
