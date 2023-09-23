<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Grades\GradesController;
use App\Http\Controllers\Sections\SectionsController;
use App\Http\livewire\Students\AddStudent;

Auth::routes();

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function(){

        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

        # Grades
        Route::controller(GradesController::class)->group(function() {
            Route::group(['prefix' => 'grades'], function () {
                Route::get('/', 'index')->name('grades');
                Route::post('add', 'add')->name('AddGrade');
                Route::post('edit', 'edit')->name('EditGrade');
                Route::post('delete', 'delete')->name('DeleteGrade');
                Route::post('delete-selected', 'delete_selected')->name('DeleteSelectedGrades');
            });
        });

        # Classrooms
        Route::controller(ClassroomController::class)->group(function() {
            Route::group(['prefix' => 'classrooms'], function () {
                Route::get('/', 'index')->name('classrooms');
                Route::post('add', 'add')->name('AddClassroom');
                Route::post('edit', 'edit')->name('EditClassroom');
                Route::post('delete', 'delete')->name('DeleteClassroom');
                Route::post('delete-selected', 'delete_selected')->name('DeleteSelectedClassrooms');
                Route::post('filter', 'filter')->name('FilterClassrooms');
            });
        });

        # Sections
        Route::controller(SectionsController::class)->group(function() {
            Route::group(['prefix' => 'sections'], function () {
                Route::get('/', 'index')->name('sections');
                Route::get('/{id}', 'GradewithSections')->name('GradewithSections');
                Route::post('add', 'add')->name('AddSection');
                Route::post('edit', 'edit')->name('EditSection');
                Route::post('delete', 'delete')->name('DeleteSection');
                Route::post('delete-selected', 'delete_selected')->name('DeleteSelectedSections');
            });
        });

        # Parents
        Route::group(['prefix' => 'parents'], function () {
            Route::view('/', 'livewire.parents.parents.index')->name('parents');
            Route::view('/add', 'livewire.parents.add.index')->name('AddParent');
            Route::view('/attachments/{id}', 'livewire.parents.attachments.index')->name('ParentAttachments');
        });

        # Teachers
        Route::group(['prefix' => 'teachers'], function () {
            Route::view('/', 'livewire.teachers.teachers.index')->name('teachers');
            Route::view('/add', 'livewire.teachers.add.index')->name('AddTeacher');
            Route::view('/attachments/{id}', 'livewire.teachers.attachments.index')->name('TeacherAttachments');
        });

        # Students
        Route::group(['prefix' => 'students'], function () {
            Route::view('/', 'livewire.students.students.index')->name('students');
            Route::view('/add', 'livewire.students.add.index')->name('AddStudent');
            Route::view('/attachments/{id}', 'livewire.students.attachments.index')->name('StudentAttachments');
            Route::get('/classrooms/{id}', [App\Http\livewire\Students\AddStudent::class, 'getClassrooms'])->name('getClassrooms');
            Route::get('/sections/{id}', [App\Http\livewire\Students\AddStudent::class, 'getSections'])->name('getSections');
            # Promotions
            Route::group(['prefix' => 'promotions'], function () {
                Route::view('/', 'livewire.students.promotions.promotions.index')->name('promotions');
                Route::view('/add', 'livewire.students.promotions.add.index')->name('AddPromotion');
            });
            # Graudations
            Route::group(['prefix' => 'graduations'], function () {
                Route::view('/', 'livewire.students.graduations.graduations.index')->name('graduations');
                Route::view('/add', 'livewire.students.graduations.add.index')->name('AddGraduation');
            });
            # Invoices
            Route::group(['prefix' => 'invoices'], function () {
                Route::view('/', 'livewire.students.invoices.invoices.index')->name('invoices');
                Route::view('/add/{id}', 'livewire.students.invoices.add.index')->name('AddInvoice');
            });
        });

        # Fees
        Route::group(['prefix' => 'fees'], function () {
            Route::view('/', 'livewire.fees.fees.index')->name('fees');
            Route::view('/add', 'livewire.fees.add.index')->name('AddFee');
        });
    });

