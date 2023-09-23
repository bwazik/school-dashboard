<?php

namespace App\Http\Livewire\Students;

use Livewire\Component;
use App\Models\Student;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\DB;

class ShowGraduations extends Component
{
    public function render()
    {
        return view('livewire.students.graduations.graduations.livewire', [
            'students' => Student::onlyTrashed()->get(),
        ]);
    }

    public function return($id)
    {
        Student::onlyTrashed()->where('id', $id)->first()->restore();

        Flasher::addSuccess(trans('students/graduations.returned'));
    }

    public function delete($id)
    {
        Student::onlyTrashed()->where('id', $id)->first()->forceDelete();

        Flasher::addSuccess(trans('students/graduations.deleted'));
    }
}