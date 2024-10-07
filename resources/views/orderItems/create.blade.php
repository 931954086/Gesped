@extends('layouts.app')

@section('title', isset($order) ? 'Editar Pedido' : 'ITENS DO PEDIDO')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ isset($order) ? 'Editar Pedido' : 'Criar Pedido' }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('orderItems.index') }}">Listar Pedidos</a></li>
                    <li class="breadcrumb-item active">{{ isset($order) ? 'Editar Pedido' : 'Criar Pedido' }}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class="card card-default">
    <div class="col-12">
        @if(session('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>

    <div class="col-12">
        @if(session('error'))
        <div id="error-message" class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
    </div>

    <form action="{{ isset($order) ? route('orderItems.update', $order->id) : route('orderItems.store') }}" method="POST">
        @csrf
        @if(isset($order))
        @method('PUT')
        @endif

        <div class="card-body">
            <div class="row">
            <input type="hidden" name="order_id" value="{{ isset($id) ? $id : null }}">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="product_id">Produto</label>
                        <select class="form-control" id="product_id" name="product_id" required>
                            <option value="">Selecione</option>
                            @foreach($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                {{ $product->name }}
                            </option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="quantity">Quantidade</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="" required>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="unit_price">Preço Unitário</label>
                        <input type="text" class="form-control" id="unit_price" name="unit_price" value="" readonly required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info">{{ isset($order) ? 'Atualizar Pedido' : 'INSERIR' }}</button>
            <a href="{{ route('orderItems.index') }}" class="btn btn-default ml-2">Cancelar</a>
        </div>
    </form>

    <div class="col-12 ">
        <div class="card">
            <div class="card-header ">
                <div class="card-tools">
                    <div class="input-group input-group-sm mb-3" style="width: 250px;">
                        <!-- Corrigido o ID para corresponder ao utilizado no script -->
                        <input type="text" id="filterInput" class="form-control float-right" placeholder="Pesquisar por Nome ou ID">

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
                    <thead class="dark-mode">
                        <!-- table-dark -->
                        <tr>
                            <th>ITEM</th>
                            <th>ID</th>
                            <th>PRODUTO</th>
                            <th>PREÇO</th>
                            <th>QUANTIDADE</th>
                            <th>SUBTOTAL</th>
                            <th>EXCLUIR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderItem as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->product->id }}</td> 
                            <td>{{ $item->product->name }}</td> 
                            <td>{{ $item->product->price}}</td> 
                            <td>{{ $item->quantity}}</td> 
                            <td>{{ $item->subtotal}}</td> 
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('orderItems.edit', ['id' => $item->id]) }}" class="btn btn-info" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form id="deleteForm_{{ $item->id }}" name="formModal" action="{{ route('orderItems.destroy', ['id' => $item->id]) }}" method="post" onsubmit="">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-secondary_{{ $item->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="modal-secondary_{{ $item->id }}">
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
                                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Fechar</button>
                                        <button type="button" name="save" class="btn btn-outline-light" data-dismiss="modal" onclick="submitForm('deleteForm_{{ $item->id }}')">Salvar
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
<div class="modal fade" id="confirmationModal-status" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel-status" aria-hidden="true">
    <div class="modal-dialog dark-mode" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel-status">Alteração de Estado de Usuário</h5>
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

<script>
    document.getElementById('product_id').addEventListener('change', function() {
        var productId = this.value;
        var productPrice = this.options[this.selectedIndex].getAttribute('data-price');
        document.getElementById('unit_price').value = productPrice;
    });
</script>

@endsection
