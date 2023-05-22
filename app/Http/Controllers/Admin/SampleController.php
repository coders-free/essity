<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderSample;
use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function index()
    {
        return view('admin.samples.index');
    }

    public function show(OrderSample $orderSample)
    {
        return view('admin.samples.show', compact('orderSample'));
    }
}
