<?php

namespace App\Http\Livewire\Fees;

use Livewire\Component;
use App\Models\Grade;
use App\Models\Fee;
use Flasher\Laravel\Facade\Flasher;

class ShowFees extends Component
{
    public $showTable = true,

    $fee_id, $name_ar, $name_en, $amount,

    $grade_id, $classroom_id, $year, $note;

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
        ]);

    }

    public function render()
    {
        return view('livewire.fees.fees.livewire', [
            'fees' => Fee::all(),
            'grades' => Grade::all(),
        ]);
    }

    public function edit($id)
    {
        $this -> showTable = false;
        $fee = Fee::where('id' , $id)->first();

        $this -> fee_id = $id;
        $this -> name_ar = $fee -> getTranslation('name', 'ar');
        $this -> name_en = $fee -> getTranslation('name', 'en');
        $this -> amount = $fee -> amount;
        $this -> grade_id = $fee -> grade_id;
        $this -> classroom_id = $fee -> classroom_id;
        $this -> year = $fee -> year;
        $this -> note = $fee -> note;
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
        ]);

        if ($this -> fee_id)
        {
            $fee = Fee::find($this -> fee_id);

            $fee->update([
                'name' => ['en' => $this -> name_en, 'ar' => $this -> name_ar],
                'amount' => $this -> amount,
                'grade_id' => $this -> grade_id,
                'classroom_id' => $this -> classroom_id,
                'year' => $this -> year,
                'note' => $this -> note,
            ]);
        }

        Flasher::addSuccess(trans('fees/fees.edited'));

        $this -> showTable = true;
    }

    public function delete($id)
    {
        Fee::findOrFail($id)->delete();

        Flasher::addSuccess(trans('fees/fees.deleted'));
    }
}
