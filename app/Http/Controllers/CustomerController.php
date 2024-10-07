<?php

namespace App\Http\Controllers;

use App\Models\AddressCustomer;
use App\Models\Customer;
use App\Models\Neighborhood;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Carrega todos os clientes com seus respectivos endereços
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $neighborhoods = Neighborhood::all();
        return view('customers.create', compact('neighborhoods'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar os campos do cliente
       $request->validate([       
           'name'   => 'required|string|max:255',
           'email'  => 'required|email|max:255|unique:customers',
           'nif'    => 'required|string|max:255|unique:customers',
           'gender' => 'required|in:Masculino,Feminino',
           'house'  => 'required|string|max:255',
           'street' => 'required|string|max:255',
           'town'   => 'required|string|max:255',
           'state'  => 'required|string|max:255',
       ]);
       

        try {
            $customer = Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'nif' => $request->nif,
                'gender' => $request->gender,
                // Aqui você pode adicionar os campos de endereço conforme necessário
                'house' => $request->house,
                'street' => $request->street,
                'town' => $request->town,
                'state' => $request->state,
            ]);
            return redirect()->route('customers.index')->with('success', 'Cliente cadastrados com sucesso.');
        } catch (\Exception $e) {
            // Se houver algum erro, desfazer a transação
            DB::rollback();
            // Redirecionar de volta com uma mensagem de erro
            return redirect()->route('customers.index')->with('error', 'Ocorreu um erro ao cadastrar o cliente e endereço.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Obter o cliente que está sendo editado
        $customer = Customer::find($id);
        // Retornar a view com os dados necessários
        return view('customers.create', compact('customer'));
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar os campos do cliente
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customers,email,' . $id,
            'nif' => 'required|string|max:255|unique:customers,nif,' . $id,
            'gender' => 'required|in:Masculino,Feminino',
        ]);

        try {
            // Encontrar o cliente pelo ID
            $customer = Customer::findOrFail($id);
    
            // Atualizar os campos do cliente
            $customer->update([
                'name' => $request->name,
                'email' => $request->email,
                'nif' => $request->nif,
                'gender' => $request->gender,
            ]);
    
            return redirect()->route('customers.index')->with('success', 'Cliente atualizado com sucesso.');
        } catch (\Exception $e) {
            // Se houver algum erro, desfazer a transação
            DB::rollback();
            // Redirecionar de volta com uma mensagem de erro
            return redirect()->route('customers.index')->with('error', 'Ocorreu um erro ao atualizar o cliente e endereço.');
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->delete();
            return redirect()->route('customers.index')->with('success', 'Cliente excluída com sucesso.');
        }
        return redirect()->route('customers.index')->with('error', 'Cliente não encontrada.');
    }
}