<?php 

namespace App\Repository\Sections;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Flasher\Laravel\Facade\Flasher;

class SectionRepository implements SectionRepositoryInterface
{ 
    public function getAllGrades()
    {
        return Grade::all();
    }

    public function getAllTeachers()
    {
        return Teacher::all();
    }

    public function countGradesWithSections()
    {
        return Grade::with(['section'])->count();
    }

    public function sectionsWithGrade($id)
    {
        return Section::with(['grade'])->where('grade_id', $id)->get();
    }

    public function classroomsWithGrade($id)
    {
        return Classroom::with(['grade'])->where('grade_id', $id)->get();
    }

    public function getGrade($id)
    {
        return Grade::findOrFail($id);
    }

    public function addSection($request)
    {
        $section = new Section();

        $section -> name = ['ar' => $request-> name_ar , 'en' => $request -> name_en];
        $section -> grade_id = $request -> grade_id;
        $section -> classroom_id = $request-> classroom_id;
        $section -> status = $request -> status;

        $section -> save();
        $section->teachers()->attach($request -> teachers);

        Flasher::addSuccess(trans('sections/sections.added'));

        return redirect()->back();
    }

    public function editSection($request)
    {
        $section = Section::findOrFail($request -> id);

        if (isset($request -> teachers)) {
            $section->teachers()->sync($request -> teachers);
        } else {
            $section->teachers()->sync(array());
        }

        $section -> update([
            $section -> name = ['en' => $request -> name_en, 'ar' => $request -> name_ar],
            $section -> grade_id = $request -> grade_id,
            $section -> classroom_id = $request -> classroom_id,
            $section -> status = $request -> status,
            ]);

        Flasher::addSuccess(trans('sections/sections.edited'));

        return redirect()->back();
    }

    public function deleteSection($request)
    {
        $section = Section::findOrFail($request -> id)->delete();

        Flasher::addSuccess(trans('sections/sections.deleted'));

        return redirect()->back();
    }

    public function deleteSelectedSections($request)
    {
        $delete_selected_id = explode("," , $request -> delete_selected_id);

        Section::whereIn('id', $delete_selected_id)->delete();

        Flasher::addSuccess(trans('sections/sections.deleted'));

        return redirect()->back();
    }
}