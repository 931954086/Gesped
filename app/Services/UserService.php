<?php

// app/Services/UserService.php

namespace App\Services;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class UserService
{
    public static function createUser($request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'name'         => 'required|string|max:255',
                'email'        => 'required|email|max:255|unique:users,email',
                'password'     => 'nullable|string|min:8|confirmed',
                'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'user_type_id' => 'required|string|max:255',
                'status_id'    => 'required|string|max:255',
            ]);

            $user = new User([
                'name'         => $request->input('name'),
                'email'        => $request->input('email'),
                'password'     => bcrypt($request->input('password')),
                'user_type_id' => $request->input('user_type_id'),
                'status_id'    => $request->input('status_id'),
            ]);

            self::handleUserImage($user, $request);

            $user->save();

            $permission = Permission::where('permission', 'user')->value('permission');

            if (!$permission) {
                $user->givePermissionTo('user');
            }

            $user->givePermissionTo($permission);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    private static function handleUserImage($user, $request)
    {
        // Coloque o código de manipulação de imagem aqui
        // Exemplo: UserImageHandler::handleImage($user, $request);
    }
}
