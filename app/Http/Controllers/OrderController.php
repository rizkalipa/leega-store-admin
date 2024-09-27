<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::select('id', 'user_id', 'total', 'status', 'created_at')
            ->with(['order_details', 'order_details.product'])
            ->orderBy('id');

        if ($request->input('status') && $request->input('status') == 'N') {
            $orders->whereIn('status', ['N', 'R']);
        } elseif ($request->input('status') && $request->input('status') == 'C') {
            $orders->where('status', 'C');
        }

        $orders = $orders->get();

        return view('order.index', compact('orders'));
    }

    public function update(Request $request)
    {
        $orderId = $request->input('order_id');
        $status = $request->input('status');

        Order::where('id', $orderId)->update(['status' => $status]);

        return response()->redirectToRoute('order_list');
    }
}
