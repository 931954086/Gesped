<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Opinion;
use App\Models\Order;
use App\Models\Permission;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:edit-articles');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
   {
     $user = Auth::user();
     $userPermission = DB::table('permission_user')
        ->join('permissions', 'permission_user.permission_id', '=', 'permissions.id')
        ->where('permission_user.user_id', $user->id)
        ->select('permissions.permission')
        ->first();

    // Armazena a permissão na sessão
    if ($userPermission) {
        Session::put('user_permission', $userPermission->permission);
    }

    if (Gate::allows('admin')) {
        // Exemplo de dados para o dashboard
        $totalOrders    = Order::count();
        $totalCustomers = Customer::count();
        $totalUsers     = User::count();
        $permissions    = Permission::all();
        $usuarios       = User::all();
        $statuses       = Status::all();
        $orders         = Order::with('customer', 'orderItems.product')->get();
        $totalOpinions  = Opinion::count();

        // Passando os dados para a view do dashboard
        return view('dashboard', [
            'totalOrders'     => $totalOrders,
            'totalCustomers'  => $totalCustomers,
            'totalUsers'      => $totalUsers,
            'usuarios'        => $usuarios,
            'statuses'        => $statuses,
            'permissions'     => $permissions,
            'orders'          => $orders,
            'totalOpinions'   => $totalOpinions,
            'userPermission'  => $userPermission->permission // Passando a permissão do usuário para a view
        ]);
    } else if (Gate::allows('user') || Gate::allows('manage-user')) {
        return view('dashboard1');
    } else {
        abort(403, 'NÃO TENS PERMISSÃO PARA ACEDER ESTE CONTEÚDO!');
    }
}
    
    /*public function index()
    {
        $usuarios = User::with('permissions', 'status')->get();
        $permissions = Permission::all();
        $statuses = Status::all();
    
        // Você pode adicionar outras variáveis que precisam ser passadas para a view
        $totalOrders = Order::count();
        $totalUsers = User::count();
        $totalCustomers = Customer::count();
    
        return view('dashboard', compact('usuarios', 'permissions', 'statuses', 'totalOrders', 'totalUsers', 'totalCustomers'));
    }*/
    





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
    public function destroy($id)
    {
        
    }
}