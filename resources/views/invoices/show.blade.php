


@extends('layouts.app')

@section('title', 'Fatura')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Fatura #{{ $invoice->id }}</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Código de Fatura</th>
                    <th>Quantidade</th>
                    <th>Produto</th>
                    <th>Número de Série</th>
                    <th>Preço</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->items as $item)
                    <tr>
                         <td>{{ $item->invoice_id }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->product_id ? $item->product->name : 'N/A' }}</td>
                        <td>{{ $item->id ?: 'N/A' }}</td>
                        <td>R$ {{ number_format($item->price, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-right">
            <h4>Total: R$ {{ number_format($invoice->total, 2, ',', '.') }}</h4>
        </div>
    </div>
@endsection








