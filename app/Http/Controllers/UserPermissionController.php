<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Permission;

class UserPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userPermissions = DB::table('permission_user')
            ->join('users', 'permission_user.user_id', '=', 'users.id')
            ->join('permissions', 'permission_user.permission_id', '=', 'permissions.id')
            ->select('permission_user.*', 'users.name as user_name', 'permissions.permission as permission_name')
            ->get();

        return view('permission_user.index', compact('userPermissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Carregue os usuários e as permissões necessárias
        $users = User::all(); 
        $permissions = Permission::all(); 
        return view('permission_user.create', compact('users', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);
    
        // Verifica se já existe uma associação entre o usuário e a permissão
        $existingAssociation = DB::table('permission_user')
            ->where('user_id', $request->user_id)
            ->where('permission_id', $request->permission_id)
            ->exists();
    
        if ($existingAssociation) {
            return redirect()->route('user-permissions.create')
                ->with('error', 'Esta associação já existe.');
        }
    
        // Cria uma nova associação entre usuário e permissão
        DB::table('permission_user')->insert([
            'user_id' => $request->user_id,
            'permission_id' => $request->permission_id,
        ]);
    
        return redirect()->route('user-permissions.create')
            ->with('success', 'Associação criada com sucesso.');
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
