<?php

namespace App\Http\Livewire\Fees;

use Livewire\Component;
use App\Models\Grade;
use App\Models\Fee;
use Flasher\Laravel\Facade\Flasher;

class AddFee extends Component
{
    public $name_ar, $name_en, $amount,

    $grade_id, $classroom_id, $year, $note, $type;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'name_ar' => 'required',
            'name_en' => 'required',
            'amount' => 'required | numeric',
            'grade_id' => 'required | integer',
            'classroom_id' => 'required | integer',
            'year' => 'required | integer',
            'note' => 'max:255',
            'type' => 'required | integer',
        ]);
    }

    public function render()
    {
        return view('livewire.fees.add.livewire', [
            'grades' => Grade::all(),
        ]);
    }

    public function submitForm()
    {
        $this->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'amount' => 'required | numeric',
            'grade_id' => 'required | integer',
            'classroom_id' => 'required | integer',
            'year' => 'required | integer',
            'note' => 'max:255',
            'type' => 'required | integer',
        ]);

        $fee = new Fee();
        $fee -> name = ['ar' => $this -> name_ar , 'en' => $this -> name_en];
        $fee -> amount = $this -> amount;
        $fee -> grade_id = $this -> grade_id;
        $fee -> classroom_id = $this -> classroom_id;
        $fee -> year = $this -> year;
        $fee -> note = $this -> note;
        $fee -> type = $this -> type;

        $fee -> save();
        Flasher::addSuccess(trans('fees/add.added'));
        $this -> clearForm();
    }

    public function clearForm()
    {
        $this -> name_ar = '';
        $this -> name_en = '';
        $this -> amount = '';
        $this -> grade_id = '';
        $this -> classroom_id = '';
        $this -> year = '';
        $this -> note = '';
        $this -> type = '';
    }
}
