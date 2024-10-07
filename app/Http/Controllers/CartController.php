<?php

// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use App\Mail\ParecerDisponivel;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
   


    public function index()
    {
        // Obter o carrinho da sessão
        $cart = session()->get('cart', []);
        $order_types = OrderType::all();
        $customers = Customer::all();

        // Verificar se o carrinho está vazio
        if (empty($cart)) {
            // Se o carrinho estiver vazio, redirecionar para uma rota de seleção de produtos ou mostrar uma mensagem
            return redirect()->route('shop.index')->with('error-message', 'Seu carrinho está vazio. Por favor, selecione produtos na loja.');
        }
        // Retornar a visualização do carrinho com os itens do carrinho
        return view('cart.index', compact('cart', 'customers', 'order_types'));
    }
    





    public function update(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $request->quantity;
        }
        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Quantidade do produto atualizada com sucesso.');
    }






    public function destroy($id)
    {
       // Obtém o carrinho da sessão ou inicializa um array vazio
        $cart = session()->get('cart', []);
       // Verifica se o produto está no carrinho
       if (isset($cart[$id])) {
        // Remove o produto do carrinho
        unset($cart[$id]);
        // Atualiza o carrinho na sessão
        session()->put('cart', $cart);
        // Redireciona com uma mensagem de sucesso
        return redirect()->route('cart.index')->with('success', 'Produto removido do carrinho com sucesso!');
      }
       // Redireciona com uma mensagem de erro se o produto não estiver no carrinho
       return redirect()->route('cart.index')->with('error', 'Produto não encontrado no carrinho!');
    }




/*
    public function checkout(Request $request)
    {
        // Validar os dados de entrada
       $request->validate([
            'customer_id'    => 'required|integer|exists:customers,id',
            'tipo_pedido'    => 'required|integer|exists:order_types,id',
        ]);
        
        // Iniciar uma transação de banco de dados
        DB::transaction(function () use ($request) {
            $cart = session()->get('cart', []);
    
            if (count($cart) > 0) {
                // Calcular o total do pedido
                $total = array_sum(array_map(function ($item) {
                    return $item['price'] * $item['quantity'];
                }, $cart));
                // Criar o pedido na tabela orders
                $order = Order::create([
                    'total'         => $total,
                    'status'        => 'Avaliação',
                    'user_id'       => Auth::id(),
                    'customer_id'   => $request->customer_id,
                    'order_type_id' => $request->tipo_pedido,
                    'company_id' => '1',
                ]);
                // Processar cada item no carrinho
                foreach ($cart as $id => $details) {
                    $product = Product::find($id);
                    if ($product) {
                        // Criar um item de pedido associado ao pedido
                        OrderItem::create([
                            'order_id'     => $order->id,
                            'product_id'   => $product->id,
                            'quantity'     => $details['quantity'],
                            'price'        => $details['price'],
                            'subtotal'     => $details['price'] * $details['quantity'],
                            'description'  => $product->name,
                        ]);
                        // Atualizar a quantidade do produto
                        $product->qtd -= $details['quantity'];
                        $product->save();
                    }
                }
                // Limpar o carrinho após o checkout
                session()->forget('cart');
                // Redirecionar para a lista de pedidos com uma mensagem de sucesso
            }
        });
        //exit("aquii");
        return redirect()->route('orders.index')->with('success', 'Pedido enviado com sucesso!');
    }
 */

 
public function checkout(Request $request)
{
    // Validar os dados de entrada
    $request->validate([
        'customer_id'    => 'required|integer|exists:customers,id',
        'tipo_pedido'    => 'required|integer|exists:order_types,id',
    ]);

    // Iniciar uma transação de banco de dados
    DB::transaction(function () use ($request) {
        $cart = session()->get('cart', []);

        if (count($cart) > 0) {
            // Calcular o total do pedido
            $total = array_sum(array_map(function ($item) {
                return $item['price'] * $item['quantity'];
            }, $cart));
            
            // Criar o pedido na tabela orders
            $order = Order::create([
                'total'         => $total,
                'status'        => 'Avaliação',
                'user_id'       => Auth::id(),
                'customer_id'   => $request->customer_id,
                'order_type_id' => $request->tipo_pedido,
                'company_id'    => '1',
            ]);

            // Processar cada item no carrinho
            foreach ($cart as $id => $details) {
                $product = Product::find($id);
                if ($product) {
                    // Criar um item de pedido associado ao pedido
                    OrderItem::create([
                        'order_id'     => $order->id,
                        'product_id'   => $product->id,
                        'quantity'     => $details['quantity'],
                        'price'        => $details['price'],
                        'subtotal'     => $details['price'] * $details['quantity'],
                        'description'  => $product->name,
                    ]);

                    // Atualizar a quantidade do produto
                    $product->qtd -= $details['quantity'];
                    $product->save();
                }
            }

            // Buscar todos os administradores
            $admins = User::whereHas('permissions', function ($query) {
                $query->where('permission', 'admin');
            })->get();

            // Enviar e-mail para cada administrador encontrado
            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new ParecerDisponivel());
            }

            // Limpar o carrinho após o checkout
            session()->forget('cart');
        }
    });

    return redirect()->route('orders.index')->with('success', 'Pedido enviado com sucesso!');
}













    




     // Método para adicionar um produto ao carrinho
     public function add(Request $request, Product $product)
     {// Obter o carrinho da sessão, ou um array vazio se não existir
         $cart = session()->get('cart', []);
         // Verificar se o produto já está no carrinho
         if (isset($cart[$product->id])) {
             // Se o produto já estiver no carrinho, aumentar a quantidade
             $cart[$product->id]['quantity']++;
         } else {
             // Se o produto não estiver no carrinho, adicionar ao carrinho
             $cart[$product->id] = [
                 'name'     => $product->name,
                 'price'    => $product->price,
                 'quantity' => 1,
                 'desce'    => $product->desce,
                 'image'    => $product->image // Assumindo que você tem uma coluna `image` no modelo Product
             ];
         }
         //Atualizar a sessão com o carrinho
         session()->put('cart', $cart);
         // Redirecionar de volta com uma mensagem de sucesso
         return redirect()->back()->with('success', 'Produto adicionado ao carrinho com sucesso!');
     }
    
}