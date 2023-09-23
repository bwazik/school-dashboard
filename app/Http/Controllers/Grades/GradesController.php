<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Grades\GradesRequest;
use App\Repository\Grades\GradeRepositoryInterface;

class GradesController extends Controller
{
    protected $grade;

    public function __construct(GradeRepositoryInterface $grade)
    {
        $this -> grade = $grade;
    }

    public function index()
    {
        $grades = $this -> grade -> getAllGrades();

        return view('pages.grades.grades', compact('grades'));
    }

    public function add(GradesRequest $request)
    {
        return $this -> grade -> addGrade($request);
    }

    public function edit(GradesRequest $request)
    {
        return $this -> grade -> editGrade($request);
    }

    public function delete(Request $request)
    {
        return $this -> grade -> deleteGrade($request);
    }

    public function delete_selected(Request $request)
    {
        return $this -> grade -> deleteSelectedGrades($request);
    }

}
