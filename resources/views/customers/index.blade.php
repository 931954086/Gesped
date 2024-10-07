@extends('layouts.app')

@section('title', 'Lista de Clientes')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Lista de clientes</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('customers.create') }}">Criar</a></li>
                    <li class="breadcrumb-item active">Clientes</li>
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
                            <th>Nome Completo</th>
                            <th>Email</th>
                            <th>NIF</th>
                            <th>Gênero</th>
                            <th>Casa</th>
                            <th>Rua</th>
                            <th>Cidade</th>
                            <th>Estado</th>
                            <th>Data de Cadastro</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->nif }}</td>
                            <td>{{ $customer->gender }}</td>
                            <td>{{ $customer->house }}</td>
                            <td>{{ $customer->street }}</td>
                            <td>{{ $customer->town }}</td>
                            <td>{{ $customer->state }}</td>
                            <td>{{ $customer->created_at->format('d/m/Y H:i:s') }}</td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('customers.edit', ['id' => $customer->id]) }}"
                                        class="btn btn-info" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#modal-secondary_{{ $customer->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal de Confirmação de Exclusão -->
                        <div class="modal fade" id="modal-secondary_{{ $customer->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content bg-secondary">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Exclusão de Cliente</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Deseja realmente excluir o cliente "{{ $customer->name }}"?</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-outline-light"
                                            data-dismiss="modal">Cancelar</button>
                                        <form id="deleteForm_{{ $customer->id }}"
                                            action="{{ route('customers.destroy', ['id' => $customer->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-light">Confirmar Exclusão</button>
                                        </form>
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
