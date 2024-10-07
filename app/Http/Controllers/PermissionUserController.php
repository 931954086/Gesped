<?php

// Exemplo de PermissionUserController.php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionUserController extends Controller
{
    public function attachPermission(Request $request, $userId, $permissionId)
    {
        $user = User::findOrFail($userId);
        $permission = Permission::findOrFail($permissionId);

        $user->permissions()->attach($permission);

        return response()->json(['message' => 'Permission attached successfully']);
    }

    // Outros métodos para manipular a relação permission_user...
}
