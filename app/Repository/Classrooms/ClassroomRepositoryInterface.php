<?php 

namespace App\Repository\Classrooms;

interface ClassroomRepositoryInterface
{
    #1 Get All Grades
    public function getAllGrades();

    #2 Get All Classrooms
    public function getAllClassrooms();

    #3 Add Classroom
    public function addClassroom($request);

    #4 Edit Classroom
    public function editClassroom($request);

    #5 Delete Classroom
    public function deleteClassroom($request);

    #6 Delete Selected Classrooms
    public function deleteSelectedClassrooms($request);

    #7 Filter by Classrooms
    public function filterByGrades($request);
}