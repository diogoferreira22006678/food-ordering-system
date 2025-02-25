<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TableLayout;
use App\Models\Order;

class AdminController extends Controller
{
    public function dashboard()
    {
        $tables = TableLayout::all();

        return view('admin.dashboard', compact('tables'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required']);
        $order->update(['status' => $request->status]);
    
        broadcast(new OrderUpdated($order))->toOthers();
    
        return back()->with('success', 'Order status updated.');
    }
    
    public function manageUsers()
    {
        return view('admin.users');
    }
}
