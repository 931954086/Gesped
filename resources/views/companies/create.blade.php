@extends('layouts.app')

@section('title', isset($companie) ? 'Editar Empresa' : 'Cadastrar Empresas')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ isset($companie) ? 'Editar Empresa' : 'Cadastrar Empresas' }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('companies.index')}}">Listar</a></li>
                    <li class="breadcrumb-item active">Empresas</li>
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


    <form action="{{ isset($companie) ? route('companies.update', $companie->id) : route('companies.store') }}"
        method="POST">
        @csrf

        @if(isset($companie))
        @method('PUT') {{-- Utilize o método PUT para atualização --}}
        @endif

        <div class="card-body">
            <div class="row">
                <!-- Coluna 1 -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ isset($companie) ? $companie->name : old('name') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <input type="text" class="form-control" id="description" name="description"
                            value="{{ isset($companie) ? $companie->description : old('description') }}" maxlength="100" required>
                    </div>
                </div>

                <!-- Coluna 2 -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="site">Site</label>
                        <input type="text" class="form-control" id="site" name="site"
                            value="{{ isset($companie) ? $companie->site : old('site') }}" maxlength="30" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ isset($companie) ? $companie->email : old('email') }}" maxlength="30" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nif">NIF</label>
                        <input type="text" class="form-control" id="nif" name="nif"
                            value="{{ isset($companie) ? $companie->nif : old('nif') }}" maxlength="14" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info">{{ isset($companie) ? 'Atualizar' : 'Salvar' }}</button>
            <a href="{{ route('companies.index') }}" class="btn btn-default ml-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection