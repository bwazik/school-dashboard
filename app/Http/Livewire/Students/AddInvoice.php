<?php

namespace App\Http\Livewire\Students;

use App\Models\Student;
use App\Models\Fee;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Flasher\Laravel\Facade\Flasher;

class AddInvoice extends Component
{
    public $student_id, $fees;

    public function mount($id)
    {
        $student = Student::findOrFail($id);
        $fees = Fee::where('classroom_id' , $student -> classroom_id)->get();

        $this -> student_id = $student -> id;
        $this -> fees = $fees;
    }

    public function render()
    {
        return view('livewire.students.invoices.add.livewire', [
            'student' => Student::findOrFail($this -> student_id),
            'fees' => $this -> fees,
        ]);
    }
}
