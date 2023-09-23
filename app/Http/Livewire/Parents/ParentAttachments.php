<?php

namespace App\Http\Livewire\Parents;

use Livewire\Component;
use App\Models\MyParent;
use App\Models\Image;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Storage;
use Flasher\Laravel\Facade\Flasher;
use Livewire\WithFileUploads;

class ParentAttachments extends Component
{
    use WithFileUploads;

    public $parent_id, $parent_email, $attachments = [];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'attachments.*' => 'image | mimes:jpg,jpeg,png | max:1024',
        ]);
    }

    public function mount($id)
    {
        $parent = MyParent::findOrFail($id);

        $this -> parent_id = $parent -> id;
        $this -> parent_email = $parent -> email;
    }

    public function render()
    {
        return view('livewire.parents.attachments.livewire', [
            'parent' => MyParent::findOrFail($this -> parent_id),
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
                $attachment -> storeAs('attachments/parents/'.$this -> parent_email, $attachment -> getClientOriginalName(), 'upload_attachments');


                $images = new Image();
                $images -> file_name = $name;
                $images -> imageable_id = $this -> parent_id;
                $images -> imageable_type = 'App\Models\MyParent';
                $images -> save();
            }

            Flasher::addSuccess(trans('parents/parents.added_attachment'));
        }
        else
        {
            Flasher::addError(trans('validation.required'));
        }
    }

    public function download($file_name)
    {
        return response()->download(public_path('attachments/parents/'.$this -> parent_email.'/'.$file_name));

        Flasher::addSuccess(trans('parents/parents.downloaded_attachment'));
    }

    public function delete($id, $file_name)
    {
        Storage::disk('upload_attachments')->delete('attachments/parents/'.$this -> parent_email.'/'.$file_name);

        Image::where('id', $id)->where('file_name', $file_name)->delete();

        Flasher::addSuccess(trans('parents/parents.deleted_attachment'));
    }
}
