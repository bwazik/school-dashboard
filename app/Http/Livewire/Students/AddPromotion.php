<?php

namespace App\Http\Livewire\Students;

use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Flasher\Laravel\Facade\Flasher;

class AddPromotion extends Component
{
    public $grade_id, $classroom_id, $section_id, $academic_year,

    $grade_id_new, $classroom_id_new, $section_id_new, $academic_year_new;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'grade_id' => 'required | integer',
            'classroom_id' => 'required | integer',
            'section_id' => 'required | integer',
            'academic_year' => 'required | integer',
            'grade_id_new' => 'required | integer',
            'classroom_id_new' => 'required | integer',
            'section_id_new' => 'required | integer',
            'academic_year_new' => 'required | integer',
        ]);
    }

    public function render()
    {
        return view('livewire.students.promotions.add.livewire', [
            'grades' => Grade::all(),
        ]);
    }

    public function submitForm()
    {
        $this->validate([
            'grade_id' => 'required | integer',
            'classroom_id' => 'required | integer',
            'section_id' => 'required | integer',
            'academic_year' => 'required | integer',
            'grade_id_new' => 'required | integer',
            'classroom_id_new' => 'required | integer',
            'section_id_new' => 'required | integer',
            'academic_year_new' => 'required | integer',
        ]);

        DB::beginTransaction();

        $students = Student::where('grade_id', $this -> grade_id)->where('classroom_id',  $this -> classroom_id)->where('section_id', $this -> section_id)->where('academic_year', $this -> academic_year)->get();
    
        $error1 = $students -> count() < 1;
        $error2 = $this -> grade_id == $this -> grade_id_new && $this -> classroom_id == $this -> classroom_id_new && $this -> section_id == $this -> section_id_new;

        if($error1){
            Flasher::addError(trans('students/promotions.error1'));
        }
        else
        {
            if($error2)
            {
                Flasher::addError(trans('students/promotions.error2'));
            }
            else{
                foreach ($students as $student)
                {
                    $ids = explode(',' , $student -> id);
        
                    Student::whereIn('id' , $ids)->update([
                        'grade_id' => $this -> grade_id_new,
                        'classroom_id' => $this -> classroom_id_new,
                        'section_id' => $this -> section_id_new,
                        'academic_year' => $this -> academic_year_new,
                    ]);
        
                    Promotion::updateOrCreate([
                        'student_id' => $student -> id,
                        'from_grade' => $this -> grade_id,
                        'from_classroom' => $this -> classroom_id,
                        'from_section' => $this -> section_id,
                        'from_academic_year' => $this -> academic_year,
                        'to_grade' => $this -> grade_id_new,
                        'to_classroom' => $this -> classroom_id_new,
                        'to_section' => $this -> section_id_new,
                        'to_academic_year' => $this -> academic_year_new,
                    ]);
                }
        
                DB::commit();
        
                Flasher::addSuccess(trans('students/promotions.promoted'));
                $this -> clearForm();
        
                DB::rollback();        
            }
        }
    }

    public function clearForm()
    {
        $this -> grade_id = '';
        $this -> classroom_id = '';
        $this -> section_id = '';
        $this -> academic_year = '';
        $this -> grade_id_new = '';
        $this -> classroom_id_new = '';
        $this -> section_id_new = '';
        $this -> academic_year_new = '';
    }
}
