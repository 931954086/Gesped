@extends('layouts.app')

@section('title', isset($province) ? 'Editar Província' : 'Cadastrar Províncias')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ isset($province) ? 'Editar Província' : 'Cadastrar Províncias' }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('provinces.index') }}">Listar</a></li>
                    <li class="breadcrumb-item active">Províncias</li>
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

    <form action="{{ isset($province) ? route('provinces.update', $province->id) : route('provinces.store') }}"
        method="POST">
        @csrf

        @if(isset($province))
        @method('PUT') {{-- Utilize o método PUT para atualização --}}
        @endif

        <div class="card-body">
            <div class="row">
                <!-- Coluna 1 -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ isset($province) ? $province->name : old('name') }}" required>
                    </div>
                </div>


                <div class="card-footer">
                    <button type="submit"
                        class="btn btn-info">{{ isset($province) ? 'Atualizar' : 'Salvar' }}</button>
                    <a href="{{ route('provinces.index') }}" class="btn btn-default ml-2">Cancelar</a>
                </div>
    </form>
</div>
@endsection