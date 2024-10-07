@extends('layouts.app')

@section('title', isset($permission) ? 'Editar Permissões' : 'Cadastrar Permissões')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ isset($permission) ? 'Editar Permissões' : 'Cadastrar Permissões' }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('permissions.index')}}">Listar</a></li>
                    <li class="breadcrumb-item active">Usuários</li>
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

    <form action="{{ isset($permission) ? route('permissions.update', $permission->id) : route('permissions.store') }}" method="POST">
        @csrf

        @if(isset($permission))
            @method('PUT') {{-- Utilize o método PUT para atualização --}}
        @endif

        <div class="card-body">
            <div class="row">
                <!-- Coluna 1 -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Permissão</label>
                        <input type="text" class="form-control" id="permission" name="permission" value="{{ isset($permission) ? $permission->permission : old('permission') }}">
                    </div>
                </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info">{{ isset($permission) ? 'Atualizar' : 'Salvar' }}</button>
            <a href="{{ route('permissions.index') }}" class="btn btn-default ml-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection
