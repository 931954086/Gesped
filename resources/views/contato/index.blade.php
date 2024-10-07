@extends('layouts.app')

@section('title', 'Editar Usuário')
<style>
/* Adicione estilos para a linha de contato desativado */
.contato-desativado {
    text-decoration: line-through;
    /* Adiciona uma linha através do texto */
    color: red;
    /* Altera a cor para indicar que está desativado */
}
</style>
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="text-dark">Lista Contatos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Contatos</li>
                </ol>
            </div>
        </div>
    </div>

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
                    <h3 class="card-title">Lista de Contatos</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right"
                                placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Estado</th>
                                <th>Data de Criaçao</th>
                                <th>Data de Alteracao</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contatos as $contato)
                            <tr class="{{ $contato->estado == 0 ? 'contato-desativado' : '' }}">
                                <td>{{ $contato->id }}</td>
                                <td>{{ $contato->nome}}</td>
                                <td>{{ $contato->email}}</td>
                                <td>{{ $contato->telefone}}</td>

                                <td>
                                    <form id="estadoForm"
                                        action="{{ route('alterar_estado.update', ['id' =>  $contato->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="input-group">
                                            <select class="form-control" name="estado" id="estado"
                                                onchange="submitForm('estadoForm{{ $contato->id }}')">
                                                <option value="1" {{ $contato->estado == 1 ? 'selected' : '' }}>Ativado
                                                </option>
                                                <option value="0" {{ $contato->estado == 0 ? 'selected' : '' }}>
                                                    Desativado</option>
                                            </select>
                                        </div>
                                    </form>
                                </td>
                                <td>{{ $contato->created_at }}</td>
                                <td>{{ $contato->updated_at }}</td>
                                <!-- Dentro do loop de categorias -->
                                <td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{route('contacts.edit', ['id' => $contato->id]) }}"
                                            class="btn btn-info"><i class="fas fa-eye"></i></a>

                                        <!-- Formulário para a exclusão -->
                                        <form action="{{route('contacts.destroy', ['id' => $contato->id]) }}"
                                            method="post"
                                            onsubmit="return confirm('Tem certeza que deseja excluir esta contato?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>



    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza de que deseja alterar o estado?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="submitForm()">Sim</button>
                </div>
            </div>
        </div>
    </div>


    <script>
    // Adiciona um atraso de 5 segundos para esconder a mensagem de sucesso
    setTimeout(function() {
        document.getElementById('success-message').style.display = 'none';
    }, 5000);


    // Adiciona um atraso de 5 segundos para esconder a mensagem de erro
    setTimeout(function() {
        document.getElementById('error-message').style.display = 'none';
    }, 5000);
    </script>


    <script>
    function showConfirmationModal() {
        $('#confirmModal').modal('show');
    }

    function submitForm() {
        document.getElementById('estadoForm').submit();
    }
    </script>

    @endsection