<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view("permission.index", compact("permissions"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("permission.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'permission' => 'required|string|max:255',
        ]);
        Permission::create($request->all());
        return redirect()->route('permissions.index')->with('success', 'Permissão de usuário criada com sucesso.');
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
        $permission = Permission::find($id);
        if (!$permission) {
           return redirect()->route('permissions.index')->with('error', 'Permissão de usuário não encontrado.');
        }
        return view('permission.create', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'permission' => 'required|string|max:255',
        ]);
        $permission = Permission::find($id);
        if (!$permission) {
            return redirect()->route('permissions.index')->with('error', 'Permissão  de usuário não encontrado.');
        }
        $permission->update($request->all());
        return redirect()->route('permissions.index')->with('success', 'Permissão  de usuário atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::find($id);
        if ($permission) {
            $permission->delete();
            return redirect()->route('permissions.index')->with('success', 'Permissão  de usuário excluído com sucesso.');
        }
        return redirect()->route('permissions.index')->with('error', 'Permissão  de usuário não encontrado.');
    }
}
