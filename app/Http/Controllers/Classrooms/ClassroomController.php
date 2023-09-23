<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Classrooms\ClassroomsRequest;
use App\Repository\Classrooms\ClassroomRepositoryInterface;

class ClassroomController extends Controller
{
    protected $classroom;

    public function __construct(ClassroomRepositoryInterface $classroom)
    {
        $this -> classroom = $classroom;
    }

    public function index()
    {
        $classrooms = $this -> classroom -> getAllClassrooms();
        $grades = $this -> classroom -> getAllGrades();

        return view('pages.classrooms.classrooms', compact('classrooms', 'grades'));
    }

    public function add(ClassroomsRequest $request)
    {
        return $this -> classroom -> addClassroom($request);
    }

    public function edit(ClassroomsRequest $request)
    {
        return $this -> classroom -> editClassroom($request);;
    }

    public function delete(Request $request)
    {
        return $this -> classroom -> deleteClassroom($request);;
    }

    public function delete_selected(Request $request)
    {
        return $this -> classroom -> deleteSelectedClassrooms($request);;
    }

    public function filter(Request $request)
    {
        return $this -> classroom -> filterByGrades($request);;
    }
}
