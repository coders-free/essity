<?php

namespace App\Http\Controllers;

use App\Models\Webinar;
use Illuminate\Http\Request;

class WebinarController extends Controller
{
    public function index()
    {
        $webinars = Webinar::paginate(5);

        return view('webinars.index', compact('webinars'));
    }
}
