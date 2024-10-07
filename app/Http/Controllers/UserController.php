<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\UserImageHandler;
use App\Models\Department;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Status;
use App\Models\Permission;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Função responsável pela lógica de listagem do usuário
     *
     * @return void
     */
    public function index()
    {
        if (Gate::allows('admin') || Gate::allows('manage-user')) {
            $permissions = Permission::all();
            $usuarios  = User::all();
            $statuses  = Status::all();
            return view('users.index', compact('usuarios', 'statuses', 'permissions'));
        } else {
            abort(403, 'NÃO TENS PERMISSÃO PARA ACEDER ESTE CONTEÚDO!');
        }
    }

    public function index1()
    {
        if (Gate::allows('admin') || Gate::allows('manage-user')) {
            $permissions = Permission::all();
            $usuarios  = User::all();
            $statuses  = Status::all();
            return view('users.index1', compact('usuarios', 'statuses', 'permissions'));
        } else {
            abort(403, 'NÃO TENS PERMISSÃO PARA ACEDER ESTE CONTEÚDO!');
        }
    }


    /**
     * Função responsável por processar o form de crição do usuário
     *
     * @return void
     */
    public function create()
     {
        if (Gate::allows('admin') || Gate::allows('manage-user')){
         $statuses = Status::all();
         $departments = Department::all();
         //dd($departments);
         return view('users.create', compact('statuses', 'departments'));
      } else {
         abort(403, 'NÃO TENS PERMISSÃO PARA ACEDER ESTE CONTEÚDO!');
     }
   }



    /**
     * Função responsável pela lógica de crição do usuário
     *
     * @param   Request           $request  [$request description]
     *
     * @return  RedirectResponse            [return description]
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users,email',
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status_id'     => 'required|exists:statuses,id',
            'department_id' => 'required|exists:departments,id',
        ]);
    
        // Criação do usuário
        $user = new User([
            'name'          => $request->input('name'),
            'email'         => $request->input('email'),
            'password'      => bcrypt($request->input('password')),
            'status_id'     => $request->input('status_id'),
            'department_id' => $request->input('department_id'),
        ]);

        // Manipule a imagem do usuário se estiver presente
        UserImageHandler::handleImage($user, $request);
        // Salve o usuário no banco de dados
        $user->save();
        //Obtenha a permissão padrao existente pelo nome
        $permission = Permission::where('permission', 'user')->value('permission');
        // Verifique se a permissão existe antes de atribuí-la
        if (!$permission) {
            // Se a permissão 'user' não existir, crie-a
            $user->givePermissionTo('user');
        }
        // Atribua a permissão ao usuário
        $user->givePermissionTo($permission);
        // Redirecione ou retorne a resposta conforme necessário
        //event(new Registered($user));
        //Auth::login($user);
        //return redirect(RouteServiceProvider::HOME);
        return redirect()->route('users.index')->with('success', 'Usuário cadastrado com sucesso.');
        //===========return redirect()->back()->with('verified', true);
        //Você pode adicionar logs ou mensagens de erro aqui
        //return redirect()->route('users.create')->with('error', 'Erro ao cadastrar o usuário.');
    }


    /**
     * Função responsável pela lógica de exibição do usuário
     *
     * @param [type] $id
     * @return void
     */
    public function show($id)
    {
        if (Gate::allows('admin') || Gate::allows('manage-user')) {
            $user = User::find($id);
            return view('users.show', compact('user'));
        } else {
            abort(403, 'NÃO TENS PERMISSÃO PARA ACEDER ESTE CONTEÚDO!');
        }
    }




    /**
     * Função responsável pela lógica de edição do usuário
     *
     * @param [type] $id
     * @return void
     */
    public function edit($id)
    {
        if (Gate::allows('admin') || Gate::allows('manage-user')) {
            $user = User::find($id);
            $statuses = Status::all();
            $departments = Department::all();
            return view('users.create', compact('user', 'statuses','departments'));
        } else {
            abort(403, 'NÃO TENS PERMISSÃO PARA ACEDER ESTE CONTEÚDO!');
        }
    }





    /**
     * Função Responsável pela lógica de atualizaçao
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        if (Gate::allows('admin') || Gate::allows('manage-user')) {
            $request->validate([
                'name'         => 'required|string|max:255',
                'email'        => 'required|email|max:255|unique:users,email,' . $id,
                'password'     => 'nullable|string|min:8|confirmed',
                'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status_id'    => 'required|string|max:255',
            ]);
            $user = User::findOrFail($id);
            UserImageHandler::handleImageEdit($user, $request);
            //abort(403, 'ES Administrador');
            return redirect()->route('dashboard')->with('success', 'Usuário atualizado com sucesso.');
        } else {
            abort(403, 'NÃO TENS PERMISSÃO PARA ACEDER ESTE CONTEÚDO!');
        }
    }





    /**
     * Função resnponsável pela exclusão do usuário
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id)
    {
        if (Gate::allows('admin') || Gate::allows('manage-user')) {
            // Encontrar o usuário com base no ID
            $user = User::find($id);
            // Verificar se o usuário foi encontrado
            if (!$user) {
                // Usuário não encontrado, redirecionar ou retornar uma resposta adequada
                return redirect()->route('users.index')->with('error', 'Usuário não encontrado.');
            }
            // Excluir a imagem do diretório, se existir
            Storage::delete("public/users/perfil/{$user->id}/{$user->image}");
            // Excluir o usuário do banco de dados
            $user->delete();
            // Redirecionar com uma mensagem de sucesso
            return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso.');
        } else {
            abort(403, 'NÃO TENS PERMISSÃO PARA ACEDER ESTE CONTEÚDO!');
        }
    }




    /**
     * Função resnponsável por atualizar a permissão do usuário
     *
     * @param Request $request
     * @param [type] $userId
     * @return void
     */
    public function updatePermission(Request $request, $userId)
    {
        $request->validate([
            'permission_id' => 'required|integer',
        ]);
        // Encontrar o usuário
        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('dashboard')->with('error', 'Usuário não encontrado.');
        }
        // Obter o ID da permissão selecionada
        $permissionId = $request->input('permission_id');
        // Atualizar a permissão associada ao usuário na tabela pivot
        $user->permissions()->sync([$permissionId]);
        return redirect()->route('dashboard')->with('success', 'Permissão do usuário atualizada com sucesso.');
    }



    /**
     * Função resnponsável por atualizar a estado do usuário
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function updateStatus(Request $request, $id)
    {
        if (Gate::allows('admin') || Gate::allows('manage-user')) {
            $request->validate([
                'status_id' => 'required|integer',
            ]);
            $user = User::find($id);
            if (!$user) {
                return redirect()->route('dashboard')->with('error', 'Usuário não encontrado.');
            }
            $user->status_id = $request->status_id;
            $user->save();
            return redirect()->route('dashboard')->with('success', 'Estado atualizado com sucesso.');
        } else {
            abort(403, 'NÃO TENS PERMISSÃO PARA ACEDER ESTE CONTEÚDO!');
        }
    }
}