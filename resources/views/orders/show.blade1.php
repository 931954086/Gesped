@extends('layouts.app')

@section('title', 'Detalhes do Pedido')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <!--<h1 class="text-dark"></h1>-->
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Voltar para Pedidos</a></li>
                    <li class="breadcrumb-item active">Detalhes do Pedido</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Adicionar Parecer (visível apenas para administradores) -->
@can('admin')
<div class="card mb-3">
    <div class="card-header">
        Adicionar Parecer para o Pedido #{{ $order->id }}
    </div>
    <div class="card-body">
        <button class="btn btn-sm btn-primary" id="addOpinionButton">Adicionar</button>

        <form action="{{ route('opinions.store') }}" method="POST" id="opinionForm" style="display: none;" class="mt-3">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <div class="form-group">
                <label for="comment">Seu Parecer:</label>
                <textarea class="form-control" id="comment" name="comment" rows="2" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Parecer</button>
        </form>
    </div>
</div>
@endcan

<!-- Detalhes do Pedido -->
<div class="card">
    <div class="card-header">
        Detalhes do Pedido #{{ $order->id }}
    </div>
    <div class="card-body">
        <p><strong>ID do Pedido:</strong> {{ $order->id }}</p>
        <p><strong>Data do Pedido:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
        <p><strong>Status do Pedido:</strong> {{ $order->status }}</p>
        <p><strong>Cliente:</strong> {{ $order->customer->name }}</p>
        <p><strong>Criado por:</strong> {{ $order->user->name }}</p>

        {{-- Verifica se a empresa está definida --}}
        @if ($order->company)
        <p><strong>Empresa:</strong> {{ $order->company->name }}</p>
        <p><strong>NIF:</strong> {{ $order->company->nif }}</p>
        @else
        <p><strong>Empresa:</strong> Dados da empresa não disponíveis</p>
        @endif

        <h5>Itens do Pedido:</h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço Unitário</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderItems as $item)
                    <tr>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>R$ {{ number_format($item->price, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($item->subtotal, 2, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @can('admin')
        <h5 class="mt-4">Pareceres:</h5>
        @if($order->opinions->isEmpty())
        <p>Nenhum parecer disponível.</p>
        @else
        <ul class="list-group">
            @foreach($order->opinions as $opinion)
            <li class="list-group-item">
                <strong>{{ $opinion->user->name }}</strong> disse: "{{ $opinion->comment }}"
                <br><small class="text-muted">Enviado em: {{ $opinion->created_at->format('d/m/Y H:i') }}</small>
            </li>
            @endforeach
        </ul>
        @endif
        @endcan
    </div>
</div>

<script>
document.getElementById('addOpinionButton').addEventListener('click', function() {
    var opinionForm = document.getElementById('opinionForm');
    if (opinionForm.style.display === 'none' || opinionForm.style.display === '') {
        opinionForm.style.display = 'block';
    } else {
        opinionForm.style.display = 'none';
    }
});
</script>
@endsection
