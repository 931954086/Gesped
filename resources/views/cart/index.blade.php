@extends('layouts.app')

@section('title', 'Carrinho de Compras')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Seu Carrinho</h2>
    <div class="row mb-3">
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">Voltar à Loja</a></li>
                <li class="breadcrumb-item active">Carrinho</li>
            </ol>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('orders.create') }}" class="btn btn-primary btn-sm">Criar Pedido</a></li>
            </ol>
        </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @php
    $cart = session('cart', []);
    @endphp

    @if(count($cart) > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $id => $details)
            <tr>
                <td>{{ $details['name'] }}</td>
                <td>R$ {{ number_format($details['price'], 2, ',', '.') }}</td>
                <td>
                    <form action="{{ route('cart.update', $id) }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $id }}">
                        <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1"
                            class="form-control d-inline w-auto quantity-input" data-id="{{ $id }}"
                            data-price="{{ $details['price'] }}" style="display: inline-block; width: 70px;">
                        <button type="submit" class="btn btn-primary btn-sm">Atualizar</button>
                    </form>
                </td>
                <td class="subtotal">R$ {{ number_format($details['price'] * $details['quantity'], 2, ',', '.') }}</td>
                <td>
                    <a href="{{ route('cart.destroy', $id) }}" class="btn btn-danger btn-sm">Remover</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-right">
        <h4>Total: R$ <span
                id="total">{{ number_format(array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, $cart)), 2, ',', '.') }}</span>
        </h4>
    </div>
    @else
    <p class="text-center">Seu carrinho está vazio.</p>
    @endif
</div>

<script>
document.querySelectorAll('.quantity-input').forEach(function(input) {
    input.addEventListener('change', function() {
        var id = this.dataset.id;
        var price = parseFloat(this.dataset.price);
        var quantity = parseInt(this.value);
        var subtotalElement = this.closest('tr').querySelector('.subtotal');
        var subtotal = price * quantity;

        subtotalElement.textContent = 'R$ ' + subtotal.toFixed(2).replace('.', ',');

        // Atualiza o total
        var total = 0;
        document.querySelectorAll('.quantity-input').forEach(function(input) {
            var price = parseFloat(input.dataset.price);
            var quantity = parseInt(input.value);
            total += price * quantity;
        });

        document.getElementById('total').textContent = total.toFixed(2).replace('.', ',');
    });
});
</script>
@endsection
