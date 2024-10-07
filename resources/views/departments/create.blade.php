@extends('layouts.app')

@section('title', isset($department) ? 'Editar Departamento' : 'Cadastrar Departamento')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ isset($department) ? 'Editar Departamento' : 'Cadastrar Departamento' }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('departments.index') }}">Listar</a></li>
                    <li class="breadcrumb-item active">Departamentos</li>
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

    <form action="{{ isset($department) ? route('departments.update', $department->id) : route('departments.store') }}"
        method="POST">
        @csrf

        @if(isset($department))
        @method('PUT') {{-- Utilize o método PUT para atualização --}}
        @endif
        <div class="card-body">
            <div class="row">
                <!-- Coluna 1 -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ isset($department) ? $department->name : old('name') }}">
                    </div>
                </div>

                <!-- Coluna 2 -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <input type="text" class="form-control" id="description" name="description"
                            value="{{ isset($department) ? $department->description : old('description') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="company_id">Empresa</label>
                        <select class="form-control" id="company_id" name="company_id">
                            <option > Selecione a empresa</option>
                            @foreach($companies as $company)
                            <option value="{{ $company->id }}"
                                {{ isset($department) && $department->company_id == $company->id ? 'selected' : '' }}>
                                {{ $company->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Adicione mais campos conforme necessário -->

            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info">{{ isset($department) ? 'Atualizar' : 'Salvar' }}</button>
            <a href="{{ route('departments.index') }}" class="btn btn-default ml-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection
