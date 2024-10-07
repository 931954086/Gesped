@extends('layouts.app')

@section('title', 'Editar Usuário')

@section('content')
<!-- Content Header (Page header) -->


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Editar Usuário</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active"> Editar Usuário</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class="card card-default">
    <div class="col-md-3">
        <div class="float-start" style="margin-right: 20px;">
            <img id="preview"
                src="{{ isset($user) ? asset('storage/users/perfil/' . $user->id . '/' . $user->image) : '' }}"
                alt="Preview" style="max-width: 300px; max-height: 300px;">
        </div>
    </div>

    <div class="col-12">
        @if(session('error'))
        <div id="error-message" class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
    </div>

    <div class="col-12">
        @if(session('success'))
        <div id="success-message" class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
    </div>

    <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @if(isset($user))
        @method('PUT')
        @endif

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ isset($user) ? $user->name : old('name') }}" required>
                        <x-input-error :messages="$errors->get('name')" class="text-danger  mt-2" />
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ isset($user) ? $user->email : old('email') }}" required />
                        <x-input-error :messages="$errors->get('email')" class="text-danger  mt-2" />
                    </div>

                    <div class="form-group">
                        <label for="password">Nova Senha</label>
                        <input type="password" id="password" class="form-control " type="password" name="password"
                            autocomplete="new-password">
                        <x-input-error :messages="$errors->get('password')" class="text-danger  mt-2" />
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirme a Senha</label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" autocomplete="new-password">
                        <x-input-error :messages="$errors->get('password_confirmation')"
                            class="alert alert-danger mt-2" />
                    </div>
                </div>

                <div class="col-md-6">

                    <!-- Adicione o campo de upload de foto -->
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control-file" id="foto" name="image" accept="image/*"
                            onchange="previewImage(this)">
                        @if(isset($user) && $user->image)
                        <p>Imagem existente: {{ $user->image }}</p>
                        @endif
                    </div>



                    <div class="form-group">
                        <label for="status_id">Tipo de Estado</label>
                        <select class="form-control" id="status_id" name="status_id" required>
                            <option value="">Selecione</option>
                            @foreach($statuses as $status)
                            <option value="{{ $status->id }}"
                                {{ isset($user) && $user->status_id == $status->id ? 'selected' : '' }}>
                                {{ $status->desc }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>


        <div class="card-footer">
            <button type="submit" class="btn btn-info">{{ isset($user) ? 'Atualizar' : 'Salvar' }}</button>
            <a href="{{ route('users.index') }}" class="btn btn-default ml-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection