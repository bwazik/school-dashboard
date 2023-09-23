<?php 

namespace App\Repository\Grades;

interface GradeRepositoryInterface
{
    #1 Get All Grades
    public function getAllGrades();
    
    #2 Add Grade
    public function addGrade($request);

    #3 Edit Grade
    public function editGrade($request);

    #4 Delete Grade
    public function deleteGrade($request);

    #5 Delete Selected Grades
    public function deleteSelectedGrades($request);
}