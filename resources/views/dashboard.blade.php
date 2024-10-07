@extends('layouts.app')

@section('title', 'Gesped | Dashboard')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalOrders }}</h3>
                    <p>Total Pedidos</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalOpinions/100 }}<sup style="font-size: 20px">%</sup></h3>
                    <p>Total de Parecer</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3> {{ $totalUsers }}</h3>
                    <p>Total Usuários</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3> {{ $totalCustomers }}</h3>
                    <p>Total Clientes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->



    <!-- ===================================== CONFIGURAÇÃO DE USUÁRIOS ======================================  -->
    <div class="configurar_usuario">
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
                    <div class="table-responsive overflow-y-scroll" style="max-height: 300px;">
                        <table class="table table-hover text-nowrap" id="AllTable">
                            <thead class="">
                                <tr>
                                    <th>CÓDIGO</th>
                                    <th>USUÁRIO</th>
                                    <th>CADASTRADO EM</th>
                                    <!--<th>Data de Alteração</th>-->
                                    <th>PRIVILÉGIO</th>
                                    <th>ESTADO</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->id }}</td>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->created_at }}</td>
                                    <!--<td>{{ $usuario->updated_at }}</td>-->

                                    <td>
                                        <form class="permission-form"
                                            action="{{ route('users.updatePermission', ['id' => $usuario->id]) }}"
                                            method="post" data-user-id="{{ $usuario->id }}">
                                            @csrf
                                            @method('PUT')

                                            <select class="form-control permission-select small" name="permission_id"
                                                onchange="showConfirmationModal_permission('{{$usuario->id }}')"
                                                style="width: 150px;">
                                                <label for="permission_id">Permissão</label>
                                                @foreach($permissions as $permission)
                                                <option value="{{ $permission->id }}"
                                                    {{ $usuario->permissions && $usuario->permissions->contains($permission->id) ? 'selected' : '' }}>
                                                    {{ $permission->permission }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </td>

                                    <td>
                                        <form class="status-form"
                                            action="{{ route('users.updateStatus', ['id' => $usuario->id]) }}"
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
                                            <a href="{{route('users.edit', ['id' => $usuario->id]) }}"
                                                class="btn btn-primary" title="Detalhes">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('users.edit', ['id' => $usuario->id]) }}"
                                                class="btn btn-info" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form id="deleteForm_{{ $usuario->id }}" name="formModal"
                                                action="{{ route('users.destroy', ['id' => $usuario->id]) }}"
                                                method="post" onsubmit="">
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
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
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
        <!--  1 =========================================== Modal de confirmação Usuário ==========================================-->
        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog"
            aria-labelledby="confirmationModalLabel" aria-hidden="true">
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
        <!--  ============================================================================================================-->
        <!--  2 =========================================== Modal de confirmação Usuário ==========================================-->
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
                        <button type="button" class="btn btn-primary"
                            onclick="executeAction_status()">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!--  ============================================================================================================-->









<div class="container-fluid">
    <!-- ========================================== CONFIGURAÇÃO DE PEDIDOS =========================================-->
    <div class="configurar_pedidos">
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
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <div class="input-group input-group-sm mb-3" style="width: 250px;">
                                <input type="text" id="filterInput1" class="form-control float-right"
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
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        <select class="form-control status-select" data-order-id="{{ $order->id }}"
                                            style="width: 120px; background-color: 
                                    {{ $order->status == 'Aprovado' ? '#4CAF50' : ($order->status == 'Reprovado' ? '#EF5350' : '#FFC107') }};
                                    color: white;">
                                            <option value="Aprovado"
                                                {{ $order->status == 'Aprovado' ? 'selected' : '' }}>
                                                Aprovado</option>
                                            <option value="Reprovado"
                                                {{ $order->status == 'Reprovado' ? 'selected' : '' }}>
                                                Reprovado</option>
                                            <option value="Avaliação"
                                                {{ $order->status == 'Avaliação' ? 'selected' : '' }}>
                                                Avaliação</option>
                                        </select>

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
                                        <form id="updateStatusForm_{{ $order->id }}"
                                            action="{{ route('orders.updateStatus', ['id' => $order->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" id="statusInput_{{ $order->id }}">
                                        </form>
                                    </td>


                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <!-- Adicionar botão para exibir detalhes -->
                                            <a href="{{route('orders.show', ['id' => $order->id]) }}"
                                                class="btn btn-primary" title="Detalhes">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('orders.show', ['id' => $order->id]) }}"
                                                class="btn btn-info" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form id="deleteForm_{{ $order->id }}" name="formModal"
                                                action="{{ route('orders.destroy', ['id' => $order->id]) }}"
                                                method="post" onsubmit="">
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

                                <!--  1 =========================================== Modal de confirmação Pedido ==========================================-->
                                <div class="modal fade" id="confirmationModal_{{ $order->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="confirmationModalLabel_{{ $order->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmationModalLabel_{{ $order->id }}">
                                                    Atualizar Estado do Pedido</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Tem certeza que deseja atualizar o estado do pedido?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="submitUpdateStatusForm('{{ $order->id }}')">Confirmar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!--  1 =====================================================================================================================-->

        <!--  2 =============================================== Modal de confirmação Pedido ==========================================-->
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
                        <button type="button" class="btn btn-primary"
                            onclick="executeAction_status()">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  1 =====================================================================================================================-->





<!--  1 =============== SCRIPTS STATUS PEDIDOS ==============-->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selects = document.querySelectorAll('.status-select');

    selects.forEach(select => {
        select.addEventListener('change', function() {
            const orderId = this.dataset.orderId;
            const selectedStatus = this.value;
            document.getElementById('statusInput_' + orderId).value = selectedStatus;
            $('#confirmationModal_' + orderId).modal('show');
        });
    });
});

function submitUpdateStatusForm(orderId) {
    document.getElementById('updateStatusForm_' + orderId).submit();
}
</script>

@endsection