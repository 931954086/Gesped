@extends('layouts.app')

@section('title', 'Lista de Bairros')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Lista de Bairros</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('neighborhoods.create')}}">Criar</a></li>
                    <li class="breadcrumb-item active">Bairros</li>
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
                <div class="card-tools">
                    <div class="input-group input-group-sm mb-3" style="width: 250px;">
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
                            <th>ID</th>
                            <th>Bairro</th>
                            <th>Município</th>
                            <th>Data de Criação</th>
                            <th>Data de Alteração</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($neighborhoods as $neighborhood)
                        <tr>
                            <td>{{ $neighborhood->id }}</td>
                            <td>{{ $neighborhood->name}}</td>
                            <td>{{ $neighborhood->municipality->name }}</td>
                            <td>{{ $neighborhood->created_at }}</td>
                            <td>{{ $neighborhood->updated_at }}</td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('neighborhoods.edit', ['id' => $neighborhood->id]) }}"
                                        class="btn btn-info" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form id="deleteForm_{{ $neighborhood->id }}" name="formModal"
                                        action="{{ route('neighborhoods.destroy', ['id' => $neighborhood->id]) }}"
                                        method="post" onsubmit="">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#modal-secondary_{{ $neighborhood->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>


                                </div>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="modal-secondary_{{ $neighborhood->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content bg-secondary">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Exclusão de Registro</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Janela de Exclusão de Registros&hellip;</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-outline-light"
                                            data-dismiss="modal">Fechar</button>
                                        <button type="button" name="save" class="btn btn-outline-light"
                                            data-dismiss="modal"
                                            onclick="submitForm('deleteForm_{{ $neighborhood->id }}')">Salvar
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
