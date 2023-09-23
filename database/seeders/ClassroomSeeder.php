<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Classroom;
use App\Models\Grade;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classrooms')->delete();

        $primary_classrooms = [
            ['en' => 'First Grade', 'ar' => 'الصف الأول'],
            ['en' => 'Second Grade', 'ar' => 'الصف الثاني'],
            ['en' => 'Third Grade', 'ar' => 'الصف الثالث'],
            ['en' => 'Fourth Grade', 'ar' => 'الصف الرابع'],
            ['en' => 'Fifth Grade', 'ar' => 'الصف الخامس'],
            ['en' => 'Sixth Grade', 'ar' => 'الصف السادس'],
        ];

        foreach ($primary_classrooms as $primary_classroom) {
            Classroom::create([
                'name' => $primary_classroom,
                'grade_id' => Grade::all()->where('name_en' , 'Primary Stage'),
            ]);
        }

        $secondary_classrooms = [
            ['en' => 'First Grade', 'ar' => 'الصف الأول'],
            ['en' => 'Second Grade', 'ar' => 'الصف الثاني'],
            ['en' => 'Third Grade', 'ar' => 'الصف الثالث'],
        ];

        foreach ($secondary_classrooms as $secondary_classroom) {
            Classroom::create([
                'name' => $secondary_classroom,
                'grade_id' => Grade::all()->where('name_en' , 'Secondary Stage'),
            ]);
        }

        $highschool_classrooms = [
            ['en' => 'First Grade', 'ar' => 'الصف الأول'],
            ['en' => 'Second Grade', 'ar' => 'الصف الثاني'],
            ['en' => 'Third Grade', 'ar' => 'الصف الثالث'],
        ];

        foreach ($highschool_classrooms as $highschool_classroom) {
            Classroom::create([
                'name' => $highschool_classroom,
                'grade_id' => Grade::all()->where('name_en' , 'High School'),
            ]);
        }
    }
}
