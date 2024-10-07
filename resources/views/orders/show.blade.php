@extends('layouts.app')

@section('title', 'Detalhes do Pedido')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <br>
                @can('admin')
                <div class="card mb-3">
                    <div class="card-header">
                        Adicionar Parecer para o Pedido #{{ $order->id }}
                    </div>
                    <div class="card-body">
                        <button class="btn btn-sm btn-primary" id="addOpinionButton">Adicionar</button>

                        <form action="{{ route('opinion.store') }}" method="POST" id="opinionForm"
                            style="display: none;" class="mt-3">
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
                <!--<div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Note:</h5>
                    This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                </div>-->
                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> {{ $order->company->name }}
                                <small class="float-right">Date: {{ $order->created_at->format('d/m/Y') }}</small>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong>{{ $order->company->name }}</strong><br>
                                Kilamba QA<br>
                                <!--{{ $order->company->address }}--<br>
                                Luanda, Belas
                            <!--{{ $order->company->city }}, {{ $order->company->state }} <br>-->
                                Feito por: {{ $order->user->name }}<br>
                                Phone: {{ $order->company->phone }}<br>
                                Email: {{ $order->company->email }}<br>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong>{{ $order->customer->name }}</strong> <br>
                                <!-- {{ $order->customer->address }}--<br>
                                {{ $order->customer->city }}, {{ $order->customer->state }}
                                <br>
                            <!--Phone: {{ $order->customer->phone }}<br>-->
                                Email: {{ $order->customer->email }}<br>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b>Invoice #00{{ $order->id }}</b><br>
                            <br>
                            <b>Order ID:</b> {{ $order->order_id }}<br>
                            <b>Payment Due:</b> {{ $order->created_at->format('d/m/Y') }}<br>
                            <b>Account:</b>#00{{ auth()->user()->id }}
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Qty</th>
                                        <th>Product</th>
                                        <th>Serial #</th>
                                        <th>Description</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                    <tr>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>R$ {{ number_format($item->subtotal, 2, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-6">
                            <p class="lead">Payment Methods:</p>
                            <img src="{{ asset('dist/img/credit/visa.png') }}" alt="Visa">
                            <img src="{{ asset('dist/img/credit/mastercard.png') }}" alt="Mastercard">
                            <img src="{{ asset('dist/img/credit/american-express.png') }}" alt="American Express">
                            <img src="{{ asset('dist/img/credit/paypal2.png') }}" alt="Paypal">
                            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                {{ $order->cash}}
                            </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <p class="lead">Amount Due {{ $order->created_at->format('d/m/Y') }}</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>AOA {{ number_format($order->total, 2, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tax ({{ $order->tax_rate }}%)</th>
                                        <td>AOA {{ number_format($order->tax_amount, 2, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Shipping:</th>
                                        <td>AOA {{ number_format($order->shipping_cost, 2, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>AOA {{ number_format($order->total, 2, ',', '.') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-12">
                            <a href="javascript:void(0);" onclick="window.print();" class="btn btn-default"><i
                                    class="fas fa-print"></i> Print</a>
                            <!--<button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i>
                                Submit Payment
                            </button>-->
                            <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;"><i
                                    class="fas fa-download"></i> Generate PDF</button>
                        </div>
                    </div>
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

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
    <br>
</section>

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