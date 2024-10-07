@extends('layouts.app')

@section('title', 'Editar Usuário')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="text-dark">Cadastrar Contatos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Contatos</li>
                </ol>
            </div>
        </div>
    </div>

<div class="card card-default">
    <div class="col-12">
        @if(session('error'))
            <div id="error-message" class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
    <div class="card-header">
        <h3 class="card-title">{{ isset($contato) ? 'Editar Contato' : 'Cadastrar Contato' }}</h3>
    </div>

    <form action="{{ isset($contato) ? route('contacts.update', $contato->id) : route('contacts.store') }}" method="POST">
        @csrf
        @if(isset($contato))
            @method('PUT') {{-- Utilize o método PUT para atualização --}}
        @endif

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="{{ isset($contato) ? $contato->nome : old('nome') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ isset($contato) ? $contato->email : old('email') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" value="{{ isset($contato) ? $contato->telefone : old('telefone') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <input type="number" class="form-control" min="0" max="1" id="estado" name="estado" value="{{ isset($contato) ? $contato->estado : old('estado') }}">
                    </div>
                </div>
                <!-- Adicione mais campos conforme necessário -->
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info">{{ isset($contato) ? 'Atualizar' : 'Salvar' }}</button>
            <a href="{{ route('contacts.index') }}" class="btn btn-default ml-2">Cancelar</a>
        </div>
    </form>
</div>

<script>
    setTimeout(function () {
        var errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            errorMessage.style.display = 'none';
        }
    }, 5000);
</script>
@endsection
