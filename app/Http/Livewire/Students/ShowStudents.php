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
use App\Models\Promotion;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ShowStudents extends Component
{
    public $showTable = true,

    $student_id, $email , $password,

    $name_ar, $name_en, $grade_id, $classroom_id, $section_id,
    $gender_id, $parent_id,
    $nationality, $blood_type,
    $birthday, $academic_year;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'email' => 'required | email | unique:students,email,' . $this->student_id,
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
        return view('livewire.students.students.livewire', [
            'grades' => Grade::all(),
            'classrooms' => Classroom::all(),
            'sections' => Section::all(),
            'genders' => Gender::all(),
            'parents' => MyParent::all(),
            'nationalities' => Nationality::all(),
            'blood_types' => Blood::all(),
            'students' => Student::all(),
        ]);
    }

    public function edit($id)
    {
        $this -> showTable = false;
        $student = Student::where('id' , $id)->first();

        $this -> student_id = $id;
        $this -> email = $student -> email;
        $this -> password = $student -> password;
        $this -> name_ar = $student -> getTranslation('name', 'ar');
        $this -> name_en = $student -> getTranslation('name', 'en');
        $this -> grade_id = $student -> grade_id;
        $this -> classroom_id = $student -> classroom_id;
        $this -> section_id = $student -> section_id;
        $this -> parent_id = $student -> parent_id;
        $this -> gender_id = $student -> gender_id;
        $this -> nationality = $student -> nationality;
        $this -> blood_type = $student -> blood_type;
        $this -> birthday = $student -> birthday;
        $this -> academic_year = $student -> academic_year;
    }

    public function submitForm()
    {
        $this->validate([
            'email' => 'required | email | unique:students,email,'.$this->student_id,
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

        if ($this -> student_id){
            $student = Student::find($this -> student_id);

            $student->update([
                'email' => $this -> email,
                'password' => Hash::make($this -> password),
                'grade_id' => $this -> grade_id,
                'classroom_id' => $this -> classroom_id,
                'section_id' => $this -> section_id,
                'gender_id' => $this -> gender_id,
                'parent_id' => $this -> parent_id,
                'nationality' => $this -> nationality,
                'blood_type' => $this -> blood_type,
                'birthday' => $this -> birthday,
                'academic_year' => $this -> academic_year,
            ]);
        }

        Flasher::addSuccess(trans('students/students.edited'));

        $this -> showTable = true;
    }

    public function delete($id)
    {
        Student::findOrFail($id)->forceDelete();

        Flasher::addSuccess(trans('students/students.deleted'));
    }

    public function graduate($id)
    {
        DB::beginTransaction();

        Promotion::where('student_id', $id)->delete();

        Student::findOrFail($id)->delete();

        DB::commit();

        Flasher::addSuccess(trans('students/graduations.graduated'));

        DB::rollback();        
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
