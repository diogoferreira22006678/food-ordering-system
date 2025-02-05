<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Table;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function showMenu($tableId)
    {
        $table = Table::findOrFail($tableId);
        $menu = MenuItem::all();
        return view('orders.menu', compact('table', 'menu'));
    }

    public function placeOrder(Request $request, $tableId)
    {
        $table = Table::findOrFail($tableId);

        $order = Order::create([
            'table_id' => $tableId,
            'status' => 'pending',
        ]);

        foreach ($request->items as $itemId => $quantity) {
            if ($quantity > 0) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $itemId,
                    'quantity' => $quantity,
                ]);
            }
        }

        return redirect()->route('order.success', $tableId);
    }
}

