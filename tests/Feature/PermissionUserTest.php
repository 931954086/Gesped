<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Cache;

class PermissionUserTest extends TestCase
{

    public function it_should_be_able_to_give_a_permission_user(): void
    {

        $user = User::factory()->createOne();
        $user->givePermissionTo('edit-articles');
        $user->givePermissionTo('admin');
        $user->givePermissionTo('manage-user');
        $user->givePermissionTo('user');

        // Verifica se o usuário possui as permissões corretas
        $this->assertTrue($user->hasPermissionTo('edit-articles'));
        $this->assertTrue($user->hasPermissionTo('admin'));
        $this->assertTrue($user->hasPermissionTo('manage-user'));
        $this->assertTrue($user->hasPermissionTo('user'));

        // Verifica se as permissões estão no banco de dados
        $this->assertDatabaseHas('permissions', ['permission' => 'edit-articles']);
        $this->assertDatabaseHas('permissions', ['permission' => 'admin']);
        $this->assertDatabaseHas('permissions', ['permission' => 'manage-user']);
        $this->assertDatabaseHas('permissions', ['permission' => 'user']);
    }


    public function it_should_be_able_to_authorize_access_to_a_route_based_on_the_permission(): void
    {
        Route::get('test-something-weird', function () {
            return 'test';
        })->middleware('permission:edit-articles');


        // Rota para 'admin'
        Route::get('test-admin', function () {
            return 'Admin Test';
        })->middleware('permission:admin');

        // Rota para 'manage-user'
        Route::get('test-manage-user', function () {
            return 'Manage User Test';
        })->middleware('permission:manage-user');

        // Rota para 'user'
        Route::get('test-user', function () {
            return 'User Test';
        })->middleware('permission:user');

        $user = User::factory()->createOne();

        $this->actingAs($user)
            ->get('test-something-weird')
            ->assertForbidden();

        $user->givePermissionTo('edit-articles');
        $user->givePermissionTo('admin');
        $user->givePermissionTo('manage-user');
        $user->givePermissionTo('user');
        $this->actingAs($user)
            ->get('test-something-weird')
            ->assertSuccessful();
    }



    public function it_should_be_able_to_use_polices_with_my_permissions(): void
    {
        $user = User::factory()->createOne();
        $post = $user->posts()->save(Post::factory()->make());

        $user2 = User::factory()->createOne();
        $this->actingAs($user2)->delete(route('posts.destroy', $post))
            ->assertForbidden();
    }

    public function the_list_of_permission_should_be_cached(): void
    {
       Permission::query()->insert(['permission' => 'edit-articles']);
       $fromCache = Cache::get('permission');
       $this->assertCount(1, $fromCache);
    }
}
