@extends('layouts.app')

@section('title', 'Gesped | Lista de Pedidos')


@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="text-dark">Lista de Pedidos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('orders.create') }}">Criar</a></li>
                    <li class="breadcrumb-item active">Pedidos</li>
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
                            <th>CÓDIGO</th>
                            <th>CLIENTE</th>
                            <th>USUÁRIO</th>
                            <th>DATA</th>
                            <th>ESTADO</th>
                            <!--<th>Produto</th>
                            <th>Marca</th>-->
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td> {{ $order->user->name }}</td>
                            <td>{{ $order->created_at}}</td>
                            <td>
                                <span
                                    class="badge @if($order->status == 'Aprovado') bg-success @elseif($order->status == 'Reprovado') bg-danger @elseif($order->status == 'Avaliação') bg-warning @endif">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <!--<td>
                                @foreach($order->orderItems as $item)
                                <p>{{ $item->product->name }}</p>
                                @endforeach
                            </td>
                            <td>
                                @foreach($order->orderItems as $item)
                                <p>{{ $item->product->brand }}</p>
                                @endforeach
                            </td>-->

                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('orders.show', ['id' => $order->id]) }}" class="btn btn-info"
                                        title="Editar">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form id="deleteForm_{{ $order->id }}" name="formModal"
                                        action="{{ route('orders.destroy', ['id' => $order->id]) }}" method="post"
                                        onsubmit="">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#modal-secondary_{{ $order->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal de confirmação -->
                        <div class="modal fade" id="modal-secondary_{{ $order->id }}">
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
                                            data-dismiss="modal">Close</button>
                                        <button type="button" name="save" class="btn btn-outline-light"
                                            data-dismiss="modal"
                                            onclick="submitForm('deleteForm_{{ $order->id }}')">Salvar
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