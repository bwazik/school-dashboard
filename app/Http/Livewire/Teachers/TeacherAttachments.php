<?php

namespace App\Http\Livewire\Teachers;

use Livewire\Component;
use App\Models\Teacher;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Flasher\Laravel\Facade\Flasher;
use Livewire\WithFileUploads;

class TeacherAttachments extends Component
{
    use WithFileUploads;

    public $teacher_id, $teacher_email, $attachments = [];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'attachments.*' => 'image | mimes:jpg,jpeg,png | max:1024',
        ]);
    }

    public function mount($id)
    {
        $teacher = Teacher::findOrFail($id);

        $this -> teacher_id = $teacher -> id;
        $this -> teacher_email = $teacher -> email;
    }

    public function render()
    {
        return view('livewire.teachers.attachments.livewire', [
            'teacher' => Teacher::findOrFail($this -> teacher_id),
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
                $attachment -> storeAs('attachments/teachers/'.$this -> teacher_email, $attachment -> getClientOriginalName(), 'upload_attachments');


                $images = new Image();
                $images -> file_name = $name;
                $images -> imageable_id = $this -> teacher_id;
                $images -> imageable_type = 'App\Models\Teacher';
                $images -> save();
            }

            Flasher::addSuccess(trans('teachers/teachers.added_attachment'));
        }
        else
        {
            Flasher::addError(trans('validation.required'));
        }
    }

    public function download($file_name)
    {
        return response()->download(public_path('attachments/teachers/'.$this -> teacher_email.'/'.$file_name));

        Flasher::addSuccess(trans('teachers/teachers.downloaded_attachment'));
    }

    public function delete($id, $file_name)
    {
        Storage::disk('upload_attachments')->delete('attachments/teachers/'.$this -> teacher_email.'/'.$file_name);

        Image::where('id', $id)->where('file_name', $file_name)->delete();

        Flasher::addSuccess(trans('teachers/teachers.deleted_attachment'));
    }
}
