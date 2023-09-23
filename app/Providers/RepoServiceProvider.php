<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this -> app -> bind (
            'App\Repository\Grades\GradeRepositoryInterface',
            'App\Repository\Grades\GradeRepository',
        );
        $this -> app -> bind (
            'App\Repository\Classrooms\ClassroomRepositoryInterface',
            'App\Repository\Classrooms\ClassroomRepository',
        );
        $this -> app -> bind (
            'App\Repository\Sections\SectionRepositoryInterface',
            'App\Repository\Sections\SectionRepository',
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
