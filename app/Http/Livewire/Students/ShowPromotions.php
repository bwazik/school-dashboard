<?php

namespace App\Http\Livewire\Students;

use Livewire\Component;
use App\Models\Promotion;
use App\Models\Student;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\DB;

class ShowPromotions extends Component
{
    public function render()
    {
        return view('livewire.students.promotions.promotions.livewire', [
            'promotions' => Promotion::all(),
        ]);
    }

    public function reverse($id)
    {
        DB::beginTransaction();

        $promotion = Promotion::findorfail($id);

        Student::where('id', $promotion -> student_id)
            ->update([
                'grade_id' => $promotion -> from_grade,
                'classroom_id' => $promotion -> from_classroom,
                'section_id' => $promotion -> from_section,
                'academic_year' => $promotion -> from_academic_year,
            ]);

        Promotion::destroy($id);

        DB::commit();

        Flasher::addSuccess(trans('students/promotions.reversed'));
    
        DB::rollback();        
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
}