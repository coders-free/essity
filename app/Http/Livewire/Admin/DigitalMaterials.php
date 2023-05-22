<?php

namespace App\Http\Livewire\Admin;

use App\Models\DigitalMaterial;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

use Livewire\WithFileUploads;

class DigitalMaterials extends Component
{

    use WithFileUploads;

    public $name;
    public $file;

    public $file_id = '123';


    public $digital_materials;

    public function mount(){
        $this->getDigitalMaterials();
    }

    public function getDigitalMaterials(){
        $this->digital_materials = DigitalMaterial::all();
    }

    public function save(){
        $this->validate([
            'name' => 'required',
            'file' => 'required'
        ]);

        DigitalMaterial::create([
            'name' => $this->name,
            'path' => $this->file->store('digital-materials', 'public')
        ]);

        $this->reset('name', 'file');
        $this->file_id = rand();

        $this->getDigitalMaterials();
    }

    public function download(DigitalMaterial $digitalMaterial){
        
        return Storage::download($digitalMaterial->path);

    }

    public function destroy(DigitalMaterial $digitalMaterial){
        $digitalMaterial->delete();
        $this->getDigitalMaterials();
    }

    public function render()
    {
        return view('livewire.admin.digital-materials');
    }
}
