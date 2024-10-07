<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opinion;
use App\Models\Order;

class OpinionController extends Controller
{
    public function create($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('opinions.create', compact('order'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'comment' => 'required|string|max:1000',
        ]);

        $opinion = new Opinion();
        $opinion->user_id = auth()->id();
        $opinion->order_id = $request->order_id;
        $opinion->comment = $request->comment;
        $opinion->save();
        return redirect()->route('orders.show', $request->order_id)->with('success', 'Parecer adicionado com sucesso.');
    }
}
