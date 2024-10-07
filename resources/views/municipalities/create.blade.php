@extends('layouts.app')

@section('title', isset($municipality) ? 'Editar Município' : 'Cadastrar Município')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ isset($municipality) ? 'Editar Município' : 'Cadastrar Município' }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('municipalities.index')}}">Listar</a></li>
                    <li class="breadcrumb-item active">Municípios</li>
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
    
    <form action="{{ isset($municipality) ? route('municipalities.update', $municipality->id) : route('municipalities.store') }}" method="POST">
        @csrf
        @if(isset($municipality))
        @method('PUT')
        @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ isset($municipality) ? $municipality->name : old('name') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="province_id">Província</label>
                        <select class="form-control" id="province_id" name="province_id" required>
                            <option value="">Selecione</option>
                            @foreach($provinces as $province)
                            <option value="{{ $province->id }}" {{ isset($municipality) && $municipality->province_id == $province->id ? 'selected' : '' }}>
                                {{ $province->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info">{{ isset($municipality) ? 'Atualizar' : 'Salvar' }}</button>
            <a href="{{ route('municipalities.index') }}" class="btn btn-default ml-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection
