<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderType;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('admin')) {
            $orders = Order::with('customer', 'orderItems.product')->get();
            return view('orders.index', compact('orders'));
        } else {
            // Obtenha o ID do usuário autenticado
         $userId = auth()->id();
         // Consulta para buscar apenas os pedidos do usuário atual
          $orders = Order::where('user_id', $userId)
                    ->with('customer', 'orderItems.product')
                    ->get();
           return view('orders.index', compact('orders'));
        }
    }
    


    /**
     * Show the form for creating a new resource.
     */
    // Certifique-se de importar o modelo Customer se ainda não estiver importado
    public function create()
    {
        $customers   = Customer::all();
        $products    = Product::all();
        $order_types = OrderType::all();
        return view('orders.create', compact('customers', 'products', 'order_types'));
    }





    /**
     * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        //
    }
    

    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Buscar o pedido pelo ID
        $order = Order::with('user', 'customer')->findOrFail($id);
        // Buscar todos os OrderItems relacionados a esse pedido
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        // Retornar a view com os dados do pedido e os OrderItems
        return view('orders.show', compact('order', 'orderItems'));
    }
    





    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, $id)
    {
       $order = Order::findOrFail($id);
       $order->status = $request->input('status');
       $order->save();

       return redirect()->route('dashboard')->with('success', 'Estado do pedido atualizado com sucesso!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
