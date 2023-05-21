<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ThankController extends Controller
{
    public function index(Order $order){

        return view('thanks.index', compact('order'));

    }
}
