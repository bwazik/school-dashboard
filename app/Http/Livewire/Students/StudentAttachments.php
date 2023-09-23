<?php

namespace App\Http\Livewire\Students;

use Livewire\Component;
use App\Models\Student;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Flasher\Laravel\Facade\Flasher;
use Livewire\WithFileUploads;

class StudentAttachments extends Component
{
    use WithFileUploads;

    public $student_id, $student_email, $attachments = [];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'attachments.*' => 'image | mimes:jpg,jpeg,png | max:1024',
        ]);
    }

    public function mount($id)
    {
        $student = Student::findOrFail($id);

        $this -> student_id = $student -> id;
        $this -> student_email = $student -> email;
    }

    public function render()
    {
        return view('livewire.students.attachments.livewire', [
            'student' => Student::findOrFail($this -> student_id),
        ]);
    }

    public function submitForm()
    {
        $this->validate([
            'attachments.*' => 'image | mimes:jpg,jpeg,png | max:1024',
        ]);

        if (!empty($this -> attachments)){
            foreach ($this -> attachments as $attachment) {
                $name = $attachment -> getClientOriginalName();
                $attachment -> storeAs('attachments/students/'.$this -> student_email, $attachment -> getClientOriginalName(), 'upload_attachments');


                $images = new Image();
                $images -> file_name = $name;
                $images -> imageable_id = $this -> student_id;
                $images -> imageable_type = 'App\Models\Student';
                $images -> save();
            }

            Flasher::addSuccess(trans('students/students.added_attachment'));

        }
        else
        {
            Flasher::addError(trans('validation.required'));
        }
    }

    public function download($file_name)
    {
        return response()->download(public_path('attachments/students/'.$this -> student_email.'/'.$file_name));

        Flasher::addSuccess(trans('students/students.downloaded_attachment'));
    }

    public function delete($id, $file_name)
    {
        Storage::disk('upload_attachments')->delete('attachments/students/'.$this -> student_email.'/'.$file_name);

        Image::where('id', $id)->where('file_name', $file_name)->delete();

        Flasher::addSuccess(trans('students/students.deleted_attachment'));
    }
}
