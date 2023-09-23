<?php 

namespace App\Repository\Classrooms;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use Flasher\Laravel\Facade\Flasher;

class ClassroomRepository implements ClassroomRepositoryInterface
{ 
    public function getAllGrades()
    {
        return Grade::all();
    }

    public function getAllClassrooms()
    {
        return Classroom::all();
    }

    public function addClassroom($request)
    {
        $classrooms_list = $request -> classrooms_list;

        foreach($classrooms_list as $classroom_list)
        {
            $classroom = new Classroom();
            $classroom -> name = ['en' => $classroom_list['name_en'], 'ar' => $classroom_list['name_ar']];
            $classroom -> grade_id = $classroom_list['grade_id'];
    
            $classroom->save();
        }

        Flasher::addSuccess(trans('classrooms/classrooms.added'));

        return redirect()->route('classrooms');
    }

    public function editClassroom($request)
    {
        $classroom = Classroom::findOrFail($request -> id);
        $classrooms_list = $request -> classrooms_list;

        foreach($classrooms_list as $classroom_list)
        {
            $classroom -> update([
                $classroom -> name = ['en' => $classroom_list['name_en'], 'ar' => $classroom_list['name_ar']],
                $classroom -> grade_id = $classroom_list['grade_id'],
            ]);
        }

        Flasher::addSuccess(trans('classrooms/classrooms.edited'));

        return redirect()->route('classrooms');
    }

    public function deleteClassroom($request)
    {
        $section = Section::where('classroom_id',$request -> id)->pluck('classroom_id');

        if($section -> count() == 0)
        {
            $classroom = Classroom::findOrFail($request -> id)->delete();

            Flasher::addSuccess(trans('classrooms/classrooms.deleted'));

            return redirect()->route('classrooms');    
        }
        else
        {
            Flasher::addError(trans('classrooms/classrooms.if_sections_found'));

            return redirect()->route('classrooms');
        }
    }

    public function deleteSelectedClassrooms($request)
    {
        $delete_selected_id = explode("," , $request -> delete_selected_id);

        $section = Section::whereIn('classroom_id' , $delete_selected_id)->pluck('classroom_id');

        if($section -> count() == 0)
        {
            Classroom::whereIn('id', $delete_selected_id)->delete();

            Flasher::addSuccess(trans('classrooms/classrooms.deleted'));

            return redirect()->route('classrooms');    
        }
        else
        {
            Flasher::addError(trans('classrooms/classrooms.if_sections_found'));

            return redirect()->route('classrooms');
        }
    }

    public function filterByGrades($request)
    {
        $grades = $this -> getAllGrades();
        $classrooms = $this -> getAllClassrooms();

        $filter = Classroom::select('*')->where('grade_id' , '=' , $request -> grade_id)->get();

        return view('pages.classrooms.classrooms', compact('grades', 'classrooms'))->withDetails($filter);
    }
}