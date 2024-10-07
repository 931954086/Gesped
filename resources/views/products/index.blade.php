@extends('layouts.app')

@section('title', 'Gesped | Lista de Produtos')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="text-dark">Lista de Produtos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('products.create')}}">Criar</a></li>
                    <li class="breadcrumb-item active">Produtos</li>
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
                            <th>Cod</th>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Data de Criação</th>
                            <th>Data de Alteração</th>
                        </tr>
                    </thead>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->qtd}}</td>
                        <td>{{ $product->created_at }}</td>
                        <td>{{ $product->updated_at }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <!-- Adicionar botão para exibir detalhes -->
                                <a href="{{route('products.edit', ['id' => $product->id]) }}" class="btn btn-primary"
                                    title="Detalhes">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="btn btn-info"
                                    title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form id="deleteForm_{{ $product->id }}" name="formModal"
                                    action="{{ route('products.destroy', ['id' => $product->id]) }}" method="post"
                                    onsubmit="">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#modal-secondary_{{ $product->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>


                    <div class="modal fade" id="modal-secondary_{{ $product->id }}">
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
                                        onclick="submitForm('deleteForm_{{ $product->id }}')">Salvar
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