<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderItem = OrderItem::all();
        $orders = Order::all();
        return view('orderItems.index', compact('orders','orderItem'));
    }


    /**
     * Show the form for creating a new resource.
     */
    // Certifique-se de importar o modelo Customer se ainda não estiver importado
    public function create()
    {
        $customers = Customer::all();
        $products  = Product::all();
        $orders = Order::all();
        return view('orderItems.create', compact('customers', 'products', 'orders'));
    }
    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        // Validação dos dados do item do pedido
       

        $request->validate([
            'order_id' => 'required',
            'product_id' => 'required',
            'quantity'  => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:1',
        ]);
  
        $product = Product::find($request->product_id);

        if ($product) {
            $unitPrice = $product->price;
            // Calcula o subtotal
            $subTotal = $request->quantity * $unitPrice;
        
            // Cria o OrderItem com o preço unitário e o subtotal
            $orderItem = OrderItem::create([
                'order_id'   => $request->order_id,
                'product_id' => $request->product_id,
                'quantity'   => $request->quantity,
                'unit_price' => $unitPrice, // Usa o preço do produto
                'subtotal'   => $subTotal,
            ]);

            // Item do pedido criado com sucesso
            //exit("Sucesso");
            $customers = Customer::all();
            $products  = Product::all();
            $orders = Order::all();
            $orderItem = OrderItem::all();
            return view('orderItems.create', compact('customers', 'products', 'orders','orderItem'));
        } else {
            exit("else");
            // Falha ao criar o item do pedido
            return redirect()->back()->with('error', 'Não foi possível criar o item do pedido. Por favor, tente novamente.');
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
