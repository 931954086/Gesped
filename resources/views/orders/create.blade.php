@extends('layouts.app')

@section('title', isset($order) ? 'Editar Pedido' : 'Criar Pedido')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ isset($order) ? 'Editar Pedido' : 'Criar Pedido' }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Listar Pedidos</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Ver Carrinho</a></li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class="col-md-6"> <!-- Definindo largura 6 para o card -->
    <div class="card">
        <div class="col-6">
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

        <form action="{{ route('cart.checkout') }}" method="POST" id="orderForm">
            @csrf
            @if(isset($order))
            @method('PUT')
            @endif

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipo_pedido">Tipo de pedido</label>
                            <select class="form-control" id="tipo_pedido" name="tipo_pedido" required>
                                <option value="">Selecione</option>
                                @foreach($order_types as $order_type)
                                <option value="{{ $order_type->id }}">{{ $order_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <hr />
                <!-- Campos de formulário para Vendas -->
                <div id="camposVendas" style="display: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="search_customer" placeholder="Pesquisar cliente"
                                    style="display: none;">
                                <select name="customer_id" id="customer_id" class="form-control mt-2">
                                    <option value="">Selecione um cliente</option>
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" data-name="{{ $customer->name }}">
                                        {{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Campos de formulário para Serviços -->
                <div id="camposServicos" style="display: none;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descricao_servico">Descrição do Serviço</label>
                                <textarea class="form-control" id="descricao_servico" name="descricao_servico"
                                    rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-info">{{ isset($order) ? 'Atualizar Pedido' : 'Criar Pedido' }}</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Adicionar evento change no select
    document.getElementById('tipo_pedido').addEventListener('change', function() {
        var tipoPedido = this.value;

        // Mostrar/ocultar campos conforme o tipo de pedido selecionado
        if (tipoPedido === '2') { // ID para Pedido de Vendas
            document.getElementById('camposVendas').style.display = 'block';
            document.getElementById('camposServicos').style.display = 'none';
        } else if (tipoPedido === '1') { // ID para Pedido de Serviços
            document.getElementById('camposVendas').style.display = 'none';
            document.getElementById('camposServicos').style.display = 'block';
        } else {
            // Selecione a lógica para o caso em que nenhum tipo é selecionado (opcional)
            document.getElementById('camposVendas').style.display = 'none';
            document.getElementById('camposServicos').style.display = 'none';
        }
    });

    // Função para mostrar a caixa de pesquisa ao clicar na select
    document.getElementById('customer_id').addEventListener('click', function() {
        document.getElementById('search_customer').style.display = 'block';
        // Definir o foco no campo de pesquisa
        document.getElementById('search_customer').focus();
    });

    // Função para esconder a caixa de pesquisa ao clicar fora da select
    document.addEventListener('click', function(event) {
        var isClickInside = document.getElementById('customer_id').contains(event.target);
        var searchCustomer = document.getElementById('search_customer');

        if (!isClickInside && event.target !== searchCustomer) {
            searchCustomer.style.display = 'none';
        }
    });

    // Função para filtrar clientes e exibir nome sugerido
    function filterCustomers() {
        // Obter o valor digitado no campo de pesquisa
        var filter = document.getElementById('search_customer').value.toUpperCase();

        // Obter todas as opções dentro do elemento select
        var options = document.querySelectorAll('#customer_id option');

        // Iterar sobre as opções e mostrar/esconder com base no filtro
        var suggestedName = '';
        for (var i = 0; i < options.length; i++) {
            var textValue = options[i].textContent || options[i].innerText;
            if (textValue.toUpperCase().indexOf(filter) > -1) {
                options[i].style.display = "";
                if (filter.length >= 3 && suggestedName === '') {
                    suggestedName = textValue;
                    options[i].selected = true; // Seleciona automaticamente a opção sugerida
                }
            } else {
                options[i].style.display = "none";
            }
        }

        // Exibir o nome sugerido
        document.getElementById('suggested_name').textContent = suggestedName;
    }

    // Adicionar um evento de input para chamar a função filterCustomers()
    document.getElementById('search_customer').addEventListener('input', filterCustomers);
    // Chamar a função filterCustomers() inicialmente para garantir que a página esteja atualizada
    filterCustomers();
</script>

@endsection
