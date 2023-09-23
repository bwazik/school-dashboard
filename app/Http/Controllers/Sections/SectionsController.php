<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\Sections\SectionRepositoryInterface;
use App\Http\Requests\Sections\SectionsRequest;

class SectionsController extends Controller
{
    protected $section;

    public function __construct(SectionRepositoryInterface $section)
    {
        $this -> section = $section;
    }

    public function index()
    {
        $grades = $this -> section -> getAllGrades();
        $count = $this -> section -> countGradesWithSections();

        return view('pages.sections.sections', compact('grades', 'count'));
    }

    public function GradewithSections($id)
    {
        $sections = $this -> section -> sectionsWithGrade($id);
        $classrooms = $this -> section -> classroomsWithGrade($id);
        $grades = $this -> section -> getAllGrades();
        $grade = $this -> section -> getGrade($id);
        $teachers = $this -> section -> getAllTeachers();

        return view('pages.sections.show', compact('sections', 'grades', 'grade', 'classrooms', 'teachers'));
    }

    public function add(SectionsRequest $request)
    {
        return $this -> section -> addSection($request);
    }

    public function edit(SectionsRequest $request)
    {
        return $this -> section -> editSection($request);
    }

    public function delete(Request $request)
    {
        return $this -> section -> deleteSection($request);
    }

    public function delete_selected(Request $request)
    {
        return $this -> section -> deleteSelectedSections($request);
    }
}
