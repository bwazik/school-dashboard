<?php

namespace App\Http\Livewire\Students;

use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Flasher\Laravel\Facade\Flasher;

class AddGraduation extends Component
{
    public $grade_id, $classroom_id, $section_id, $academic_year;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'grade_id' => 'required | integer',
            'classroom_id' => 'required | integer',
            'section_id' => 'required | integer',
            'academic_year' => 'required | integer',
        ]);
    }

    public function render()
    {
        return view('livewire.students.graduations.add.livewire', [
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
        ]);

        DB::beginTransaction();

        $students = Student::where('grade_id', $this -> grade_id)->where('classroom_id',  $this -> classroom_id)->where('section_id', $this -> section_id)->where('academic_year', $this -> academic_year)->get();
    
        if($students -> count() < 1){
            Flasher::addError(trans('students/promotions.error1'));
        }
        else
        {
            foreach ($students as $student)
            {
                $ids = explode(',' , $student -> id);

                Student::whereIn('id', $ids)->delete();
            }
    
            DB::commit();
    
            Flasher::addSuccess(trans('students/graduations.graduated'));
            $this -> clearForm();
    
            DB::rollback();        
        }
    }

    public function clearForm()
    {
        $this -> grade_id = '';
        $this -> classroom_id = '';
        $this -> section_id = '';
        $this -> academic_year = '';
    }
}
