@extends('layouts.app')

@section('title', 'Gesped | Lista de Usuários')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="text-dark">Lista de Usuários</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('users.create')}}">Criar</a></li>
                    <li class="breadcrumb-item active">Usuários</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

</section>

<div class="row">
    <div class="col-12">
        @if(session('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div id="error-message" class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
    </div>

    <div class="col-12 ">
        <div class="card">
            <div class="card-header ">
                <div class="card-tools">
                    <div class="input-group input-group-sm mb-3" style="width: 250px;">
                        <!-- Corrigido o ID para corresponder ao utilizado no script -->
                        <input type="text" id="filterInput" class="form-control float-right"
                            placeholder="Pesquisar por Nome ou ID">

                        <div class="input-group-append">
                            <button type="button" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap" id="AllTable">
                    <thead class="">
                        <!-- table-dark -->
                        <tr>
                            <th>CÓDIGO</th>
                            <th>USUÁRIO</th>
                            <th>CADASTRADO</th>
                        <!--<th>Data de Alteração</th-->
                            <th>PRIVILÉGIOS</th>
                            <th>ESTADOS</th>
                            <th></th>
                        </tr>
                    </thead>
                    @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->created_at }}</td>
                    <!--<td>{{ $usuario->updated_at }}</td>-->
                        <td>
                            <form class="permission-form"
                                action="{{ route('users.updatePermission', ['id' => $usuario->id]) }}" method="post"
                                data-user-id="{{ $usuario->id }}">
                                @csrf
                                @method('PUT')

                                <!-- Restante do formulário -->
                                <select class="form-control permission-select small" name="permission_id"
                                    onchange="showConfirmationModal_permission('{{$usuario->id }}')"
                                    style="width: 150px;">
                                    <label for="permission_id">Permissão</label>
                                    @foreach($permissions as $permission)
                                    <option value="{{ $permission->id }}"
                                        {{ $usuario->permissions->contains($permission->id) ? 'selected' : '' }}>
                                        {{ $permission->permission }}
                                    </option>
                                    @endforeach
                                </select>
                            </form>
                        </td>

                        <td>
                            <form class="status-form" action="{{ route('users.updateStatus', ['id' => $usuario->id]) }}"
                                method="post" data-user-id="{{ $usuario->id }}">
                                @csrf
                                @method('PUT')
                                <select class="form-control user-type-select small" name="status_id"
                                    onchange="showConfirmationModal_status('{{$usuario->id }}')"
                                    style="width: 120px; background-color: {{ $usuario->status_id == 1 ? '#4CAF50' : '#EF5350' }}; color: white;">
                                    @foreach($statuses as $status)
                                    <option value="{{ $status->id }}"
                                        {{ $usuario->status_id == $status->id ? 'selected' : '' }}>
                                        {{ $status->desc }}
                                    </option>
                                    @endforeach
                                </select>
                            </form>
                        </td>



                        <td>
                            <div class="btn-group btn-group-sm">
                                <!-- Adicionar botão para exibir detalhes -->
                                <a href="{{route('users.edit', ['id' => $usuario->id]) }}" class="btn btn-primary"
                                    title="Detalhes">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('users.edit', ['id' => $usuario->id]) }}" class="btn btn-info"
                                    title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form id="deleteForm_{{ $usuario->id }}" name="formModal"
                                    action="{{ route('users.destroy', ['id' => $usuario->id]) }}" method="post"
                                    onsubmit="">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#modal-secondary_{{ $usuario->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>


                    <div class="modal fade" id="modal-secondary_{{ $usuario->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content bg-secondary">
                                <div class="modal-header">
                                    <h4 class="modal-title">Exclusão de Registo</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Janela de Exclusão de Registos&hellip;</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-light"
                                        data-dismiss="modal">Close</button>
                                    <button type="button" name="save" class="btn btn-outline-light" data-dismiss="modal"
                                        onclick="submitForm('deleteForm_{{ $usuario->id }}')">Salvar
                                        Alterações</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    @endforeach
                    </tbody>
                </table>


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<!-- Modal de confirmação -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog dark-mode" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Alterção de Privilégio de Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="modal"
                    data-target="#modal-secondary">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja realizar esta ação?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="executeAction()">Confirmar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal de confirmação -->
<div class="modal fade" id="confirmationModal-status" tabindex="-1" role="dialog"
    aria-labelledby="confirmationModalLabel-status" aria-hidden="true">
    <div class="modal-dialog dark-mode" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel-status">Alterção de Estado de Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja realizar esta ação?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="executeAction_status()">Confirmar</button>
            </div>
        </div>
    </div>
</div>
@endsection