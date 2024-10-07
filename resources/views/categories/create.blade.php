@extends('layouts.app')

@section('title', isset($category) ? 'Editar Categoria' : 'Cadastrar Categoria')

@section('content')

<div class="card card-default">
   <div class="col-12">
        @if(session('error'))
            <div id="error-message" class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
    <div class="card-header">
        <h3 class="card-title">{{ isset($categories) ? 'Editar Categoria' : 'Cadastrar Categoria' }}</h3>
    </div>

    <form action="{{ isset($category->id) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
        @csrf

        @if(isset($category))
            @method('PUT') {{-- Utilize o método PUT para atualização --}}
        @endif

        <div class="card-body">
            <div class="row">
                <!-- Coluna 1 -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <input type="text" class="form-control" id="description" name="description" value="{{ isset($category) ? $category->description : old('description') }}">
                    </div>
                </div>

                <!-- Coluna 2 - Adicione mais campos conforme necessário -->

            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info">{{ isset($category) ? 'Atualizar' : 'Salvar' }}</button>
            <a href="{{ route('categories.index') }}" class="btn btn-default ml-2">Cancelar</a>
        </div>
    </form>
</div>

@endsection
