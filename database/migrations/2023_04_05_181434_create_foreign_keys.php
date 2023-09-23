<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classrooms', function (Blueprint $table) {
            $table->foreign('grade_id')->references('id')->on('grades')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('sections', function (Blueprint $table) {
            $table->foreign('grade_id')->references('id')->on('grades')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('classroom_id')->references('id')->on('classrooms')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('parents', function (Blueprint $table) {
            $table->foreign('father_nationality')->references('id')->on('nationalities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('father_blood_type')->references('id')->on('blood_type')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('father_religion')->references('id')->on('religions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('mother_nationality')->references('id')->on('nationalities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('mother_blood_type')->references('id')->on('blood_type')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('mother_religion')->references('id')->on('religions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('teachers', function (Blueprint $table) {
            $table->foreign('specialization_id')->references('id')->on('specializations')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('gender_id')->references('id')->on('genders')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('teacher_section', function (Blueprint $table) {
            $table->foreign('teacher_id')->references('id')->on('teachers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('section_id')->references('id')->on('sections')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('students', function (Blueprint $table) {
            $table->foreign('grade_id')->references('id')->on('grades')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('classroom_id')->references('id')->on('classrooms')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('section_id')->references('id')->on('sections')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('gender_id')->references('id')->on('genders')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('parent_id')->references('id')->on('parents')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('nationality')->references('id')->on('nationalities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('blood_type')->references('id')->on('blood_type')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('promotions', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('from_grade')->references('id')->on('grades')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('from_classroom')->references('id')->on('classrooms')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('from_section')->references('id')->on('sections')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('to_grade')->references('id')->on('grades')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('to_classroom')->references('id')->on('classrooms')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('to_section')->references('id')->on('sections')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('fees', function (Blueprint $table) {
            $table->foreign('grade_id')->references('id')->on('grades')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('classroom_id')->references('id')->on('classrooms')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->foreign('grade_id')->references('id')->on('grades')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('classroom_id')->references('id')->on('classrooms')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('student_id')->references('id')->on('students')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('fee_id')->references('id')->on('fees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('student_account', function (Blueprint $table) {
            $table->foreign('grade_id')->references('id')->on('grades')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('classroom_id')->references('id')->on('classrooms')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('student_id')->references('id')->on('students')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classrooms', function (Blueprint $table) {
            $table->dropForeign('classrooms_grade_id_foreign');
        });
        Schema::table('sections', function (Blueprint $table) {
            $table->dropForeign('sections_grade_id_foreign');
            $table->dropForeign('sections_classroom_id_foreign');
        });
        Schema::table('parents', function (Blueprint $table) {
            $table->dropForeign('parents_father_nationality_foreign');
            $table->dropForeign('parents_father_blood_type_foreign');
            $table->dropForeign('parents_father_religion_foreign');
            $table->dropForeign('parents_mother_nationality_foreign');
            $table->dropForeign('parents_mother_blood_type_foreign');
            $table->dropForeign('parents_mother_religion_foreign');
        });
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropForeign('teachers_specialization_id_foreign');
            $table->dropForeign('teachers_gender_id_foreign');
        });
        Schema::table('teacher_section', function (Blueprint $table) {
            $table->dropForeign('teacher_section_teacher_id_foreign');
            $table->dropForeign('teacher_section_section_id_foreign');
        });
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign('students_grade_id_foreign');
            $table->dropForeign('students_classroom_id_foreign');
            $table->dropForeign('students_section_id_foreign');
            $table->dropForeign('students_gender_id_foreign');
            $table->dropForeign('students_parent_id_foreign');
            $table->dropForeign('students_nationality_foreign');
            $table->dropForeign('students_blood_type_foreign');
        });
        Schema::table('promotions', function (Blueprint $table) {
            $table->dropForeign('promotions_student_id_foreign');
            $table->dropForeign('promotions_from_grade_foreign');
            $table->dropForeign('promotions_from_classroom_foreign');
            $table->dropForeign('promotions_from_section_foreign');
            $table->dropForeign('promotions_to_grade_foreign');
            $table->dropForeign('promotions_to_classroom_foreign');
            $table->dropForeign('promotions_to_section_foreign');
        });
        Schema::table('fees', function (Blueprint $table) {
            $table->dropForeign('fees_grade_id_foreign');
            $table->dropForeign('fees_classroom_id_foreign');
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign('invoices_grade_id_foreign');
            $table->dropForeign('invoices_classroom_id_foreign');
            $table->dropForeign('invoices_student_id_foreign');
            $table->dropForeign('invoices_fee_id_foreign');
        });
        Schema::table('student_account', function (Blueprint $table) {
            $table->dropForeign('student_account_grade_id_foreign');
            $table->dropForeign('student_account_classroom_id_foreign');
            $table->dropForeign('student_account_student_id_foreign');
        });
    }
};
