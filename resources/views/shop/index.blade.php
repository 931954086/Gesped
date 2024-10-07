@extends('layouts.app')

@section('title', 'Gesped | Loja')

@section('content')

<style>
.product-card {
    margin-bottom: 30px;
}

.card-text {
    text-align: justify;
}

.custom-title {
    font-size: 2rem; /* Reduz o tamanho do título do produto */
}

.custom-brand {
    font-size: 1.5rem; /* Reduz o tamanho da marca do produto */
}

.custom-price {
    font-size: 1.75rem; /* Reduz o tamanho do preço do produto */
}

/* Estilos para o ícone de carrinho */
.cart-icon {
    position: relative;
    cursor: pointer;
}

.cart-count {
    position: absolute;
    top: -8px;
    right: -8px;
    background-color: #007bff;
    color: white;
    border-radius: 50%;
    padding: 5px 8px;
    font-size: 12px;
}

/* Ajustes para evitar sobreposição do ícone e do contador */
.navbar-brand {
    margin-right: 40px; /* Espaçamento à direita da marca */
}
</style>

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('cart.index') }}">
        Loja Online
        <span class="cart-icon" id="cart-icon">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-count" id="cart-count">{{ $totalItemsInCart }}</span>
        </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Filtro de Pesquisa -->
<div class="card-tools">
    <div class="input-group input-group-sm mb-3" style="width: 250px;">
        <input type="text" id="filterInput" class="form-control float-right" placeholder="Pesquisar por Nome ou ID">
        <div class="input-group-append">
            <button type="button" class="btn btn-default" onclick="filterProducts()">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</div>


    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
               <!-- <a class="nav-link" href="{{ route('cart.index') }}">Ver Carrinho</a>-->
            </li>
        </ul>
    </div>
</nav>

<!-- Mensagem de sucesso -->
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<!-- Produtos Section -->
<section id="produtos" class="container mt-5">
    <h2 class="text-center mb-4">Nossos Produtos</h2>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4">
            <div class="card product-card">
                @php
                $directory = public_path("storage/products/perfil/{$product->id}/");
                $imageUrl = '';
                if (File::exists($directory)) {
                $images = File::files($directory);
                if (count($images) > 0) {
                $imageUrl = asset("storage/products/perfil/{$product->id}/" . $images[0]->getFilename());
                }
                }
                @endphp
                <img src="{{ $imageUrl ?: 'https://via.placeholder.com/300x200' }}" class="card-img-top"
                    alt="{{ $product->name }}">
                <div class="card-body text-center">
                    <h5 class="card-title custom-title">{{ $product->name }}</h5>
                    <p class="card-text custom-brand">{{ $product->brand }}</p>
                    <p class="card-text custom-price">Preço: AOA {{ number_format($product->price, 2, ',', '.') }}</p>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" id="add-to-cart-form-{{ $product->id }}">
                        @csrf
                        <button type="submit" class="btn btn-primary add-to-cart-btn" data-product-id="{{ $product->id }}">Adicionar ao Carrinho</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Font Awesome CDN para os ícones -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<script>
$(document).ready(function() {
    // Função para adicionar um produto ao carrinho
    $('.add-to-cart-btn').click(function(e) {
        e.preventDefault();
        var productId = $(this).data('product-id');

        // Simular adição ao carrinho (exemplo: incrementando o contador)
        var cartCount = parseInt($('#cart-count').text());
        $('#cart-count').text(cartCount + 1);

        // Aqui você pode adicionar lógica para enviar o formulário via AJAX, se necessário
        $('#add-to-cart-form-' + productId).submit();
    });
});
</script>


<script>
function filterProducts() {
    // Pegar o valor digitado no campo de pesquisa
    var filterValue = $('#filterInput').val().toLowerCase().trim();

    // Iterar sobre cada card de produto
    $('.product-card').each(function() {
        var productName = $(this).find('.card-title').text().toLowerCase();
        var productId = $(this).find('.card-text.custom-id').text().toLowerCase();

        // Verificar se o nome do produto ou o ID correspondem ao filtro
        if (productName.includes(filterValue) || productId.includes(filterValue)) {
            $(this).show(); // Mostrar o card se corresponder
        } else {
            $(this).hide(); // Ocultar o card se não corresponder
        }
    });
}
</script>

@endsection
