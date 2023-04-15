<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke(Request $request)
    {

        $orders = Order::where('user_id', auth()->id())
                    ->get();

        return view('welcome', compact('orders'));
    }
}
