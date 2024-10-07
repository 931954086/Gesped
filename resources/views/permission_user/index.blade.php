

@extends('layouts.app')

@section('title', 'Relação de Usuario e Permissões')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Relação de Usuario e Permissões</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Permissões</li>
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

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('user-permissions.create') }}" class="btn bg-gradient-secondary btn-sm ml-3">Criar</a>
                <h3 class="card-title">Relação de Usuario e Permissões</h3>

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
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Permission Name</th>
                            <th>Data de Criação</th>
                            <th>Data de Alteração</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userPermissions as $userPermission)
                        <tr>
                            <td>{{ $userPermission->user_id }}</td>
                            <td>{{ $userPermission->user_name }}</td>
                            <td>{{ $userPermission->permission_name }}</td>
                            <td>{{ $userPermission->created_at }}</td>
                            <td>{{ $userPermission->updated_at }}</td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('user-permissions.edit', ['id' => $userPermission->user_id]) }}"
                                        class="btn btn-info" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form id="deleteForm_{{ $userPermission->user_id }}" name="formModal"
                                        action="{{ route('user-permissions.destroy', ['id' => $userPermission->user_id]) }}"
                                        method="post" onsubmit="">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#modal-secondary_{{ $userPermission->user_id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>


                                </div>
                            </td>
                        </tr>



                        <div class="modal fade" id="modal-secondary_{{ $userPermission->user_id }}">
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
                                        <button type="button" name="save" class="btn btn-outline-light"
                                            data-dismiss="modal"
                                            onclick="submitForm('deleteForm_{{ $userPermission->user_id }}')">Salvar
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
@endsection