<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DigitalMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index(){
        $materials = DigitalMaterial::paginate();
        return view('materials.index', compact('materials'));
    }

    public function download(DigitalMaterial $material){
        
        return Storage::download($material->path);

    }
}
