<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
                    ->filter([
                        'order_id' => request('order_id'),
                        'status' => request('status'),
                        'from_date' => request('from_date'),
                        'to_date' => request('to_date'),
                    ])
                    ->get();

        return view('history.index', compact('orders'));
    }
}
