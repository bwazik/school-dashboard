<?php 

namespace App\Repository\Sections;

interface SectionRepositoryInterface
{
    #1 Get All Grades
    public function getAllGrades();
    
    #2 Get All Teachers
    public function getAllTeachers();

    #3 Get Count of grades with sections
    public function countGradesWithSections();

    #4 Get Setions with grades
    public function sectionsWithGrade($id);

    #5 Get Classrooms with grades
    public function classroomsWithGrade($id);

    #6 Get Grade
    public function getGrade($id);

    #7 Add Section
    public function addSection($request);

    #8 Edit Section
    public function editSection($request);

    #9 Delete Section
    public function deleteSection($request);

    #10 Delete Selected Sections
    public function deleteSelectedSections($request);
}