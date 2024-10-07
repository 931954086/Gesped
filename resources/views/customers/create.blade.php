@extends('layouts.app')

@section('title', isset($customer) ? 'Editar Clientes' : 'Cadastrar Cliente')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ isset($customer) ? 'Editar Cliente' : 'Cadastrar Clientes' }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Criar</a></li>
                    <li class="breadcrumb-item active">Clientes</li>
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

    <form action="{{ isset($customer) ? route('customers.update', $customer->id) : route('customers.store') }}"
        method="POST">
        @csrf

        @if(isset($customer))
        @method('PUT') {{-- Utilize o método PUT para atualização --}}
        @endif

        <div class="card-body">
            <div class="row">
                <!-- Coluna 1 -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ isset($customer) ? $customer->name : old('name') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ isset($customer) ? $customer->email : old('email') }}" maxlength="255" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nif">NIF</label>
                        <input type="text" class="form-control" id="nif" name="nif"
                            value="{{ isset($customer) ? $customer->nif : old('nif') }}" maxlength="14" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Gênero</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="gender_masculino" name="gender"
                                    value="Masculino"
                                    {{ isset($customer) && $customer->gender === 'Masculino' ? 'checked' : '' }}>
                                <label class="form-check-label" for="gender_masculino">Masculino</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="gender_feminino" name="gender"
                                    value="Feminino"
                                    {{ isset($customer) && $customer->gender === 'Feminino' ? 'checked' : '' }}>
                                <label class="form-check-label" for="gender_feminino">Feminino</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="house">Casa</label>
                        <input type="text" class="form-control" id="house" name="house"
                            value="{{ isset($customer) ? $customer->house : old('house') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="street">Rua</label>
                        <input type="text" class="form-control" id="street" name="street"
                            value="{{ isset($customer) ? $customer->street : old('street') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="town">Cidade</label>
                        <input type="text" class="form-control" id="town" name="town"
                            value="{{ isset($customer) ? $customer->town : old('town') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="state">Estado</label>
                        <input type="text" class="form-control" id="state" name="state"
                            value="{{ isset($customer) ? $customer->state : old('state') }}" required>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info">{{ isset($customer) ? 'Atualizar' : 'Salvar' }}</button>
                    <a href="{{ route('customers.index') }}" class="btn btn-default ml-2">Cancelar</a>
                </div>
            </div>

        </div>

    </form>
</div>

@endsection