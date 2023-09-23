<?php 

namespace App\Repository\Grades;

use App\Models\Grade;
use App\Models\Classroom;
use Flasher\Laravel\Facade\Flasher;

class GradeRepository implements GradeRepositoryInterface
{ 
    public function getAllGrades()
    {
        return Grade::all();
    }

    public function addGrade($request)
    {
        if (Grade::where('name->ar', $request -> name_ar)->orWhere('name->en',$request -> name_en)->exists())             {
            
            Flasher::addError(trans('grades/grades.exists'));

            return redirect()->route('grades');
    
        }

        $grade = new Grade();
        $grade -> name = ['en' => $request -> name_en, 'ar' => $request -> name_ar];
        $grade -> note = $request -> note;

        $grade->save();

        Flasher::addSuccess(trans('grades/grades.added'));

        return redirect()->route('grades');
    }

    public function editGrade($request)
    {
        $grade = Grade::findOrFail($request -> id);

        $grade -> update([
            $grade -> name = ['en' => $request -> name_en, 'ar' => $request -> name_ar],
            $grade -> note = $request -> note,
        ]);

        Flasher::addSuccess(trans('grades/grades.edited'));

        return redirect()->route('grades');
    }

    public function deleteGrade($request)
    {
        $classroom = Classroom::where('grade_id',$request -> id)->pluck('grade_id');

        if($classroom -> count() == 0){
            $grade = Grade::findOrFail($request -> id)->delete();

            Flasher::addSuccess(trans('grades/grades.deleted'));

            return redirect()->route('grades');
        }
        else
        {
            Flasher::addError(trans('grades/grades.if_classrooms_found'));

            return redirect()->route('grades');
        }    
    }

    public function deleteSelectedGrades($request)
    {
        $delete_selected_id = explode("," , $request -> delete_selected_id);

        $classroom = Classroom::whereIn('grade_id' , $delete_selected_id)->pluck('grade_id');

        if($classroom -> count() == 0){
            $delete_selected_id = explode("," , $request -> delete_selected_id);

            Grade::whereIn('id', $delete_selected_id)->delete();
    
            Flasher::addSuccess(trans('grades/grades.deleted'));

            return redirect()->route('grades');
            }
        else
        {
            Flasher::addError(trans('grades/grades.if_classrooms_found'));

            return redirect()->route('grades');
        }    
    }
}