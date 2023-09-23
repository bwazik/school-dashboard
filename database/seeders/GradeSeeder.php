<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->delete();

        $grades = [
            ['en' => 'Primary Stage', 'ar' => 'المرحلة الابتدائية'],
            ['en' => 'Secondary Stage', 'ar' => 'المرحلة الاعدادية'],
            ['en' => 'High School', 'ar' => 'المرحلة الثانوية'],
        ];

        foreach ($grades as $grade) {
            Grade::create(['name' => $grade]);
        }
    }
}
