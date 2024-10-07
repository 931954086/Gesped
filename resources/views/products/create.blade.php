@extends('layouts.app')

@section('title', isset($product) ? 'Editar Produto' : 'Cadastrar Produto')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="text-dark">{{ isset($product) ? 'Editar Produto' : 'Cadastrar Produto' }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Listar</a></li>
                    <li class="breadcrumb-item active">{{ isset($product) ? 'Editar Produto' : 'Cadastrar Produto' }}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class="card card-default">
    <div class="col-12">
        @if(session('error'))
        <div id="error-message" class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
    </div>
    <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($product))
        @method('PUT') {{-- Utilize o método PUT para atualização --}}
        @endif

        <div class="card-body">
            <div class="row">
                <!-- Coluna 1 -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nome do Produto</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                            value="{{ isset($product) ? $product->name : old('name') }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">Preço do Produto</label>
                        <div class="input-group mb-3">
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price"
                                value="{{ isset($product) ? $product->price : old('price') }}" required>
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Foto do Produto</label>
                        <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image"
                            name="image" accept="image/*" required >
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Coluna 2 -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="qtd">Quantidade</label>
                        <input type="number" class="form-control @error('qtd') is-invalid @enderror" id="qtd" name="qtd"
                            value="{{ isset($product) ? $product->qtd : old('qtd') }}" required>
                        @error('qtd')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="qtd_min">Quantidade Mínima</label>
                        <input type="number" class="form-control @error('qtd_min') is-invalid @enderror" id="qtd_min" name="qtd_min"
                            value="{{ isset($product) ? $product->qtd_min : old('qtd_min') }}" required>
                        @error('qtd_min')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category_id">Categoria</label>
                        <select class="form-control select2bs4 @error('category_id') is-invalid @enderror" name="category_id" style="width: 100%;" required>
                            <option value="" disabled selected>Selecionar Categoria</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ isset($product) && $product->category_id == $category->id ? 'selected' : (old('category_id') == $category->id ? 'selected' : '') }}>
                                {{ $category->description }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info">{{ isset($product) ? 'Atualizar' : 'Salvar' }}</button>
            <a href="{{ route('products.index') }}" class="btn btn-default ml-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection
