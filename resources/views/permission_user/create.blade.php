@extends('layouts.app')

@section('title', 'Associar Permissões a Usuário')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Associar Permissões a Usuário</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Permissões de Usuário</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="card card-default">
        <div class="col-12">
            @if(session('success'))
                <div id="success-message" class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="col-12">
            @if(session('error'))
                <div id="error-message" class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <form action="{{ route('user-permissions.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_id">Usuário</label>
                            <select class="form-control" id="user_id" name="user_id" required>
                                <option value="">Selecione</option>
                                @foreach($users as $user)
                                    @php
                                        $selected = isset($user->permissions) && $user->permissions->contains('id', old('permission_id')) ? 'selected' : '';
                                    @endphp
                                    <option value="{{ $user->id }}" {{ $selected }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('user_id')" class="alert alert-danger mt-2" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="permission_id">Permissão</label>
                            <select class="form-control" id="permission_id" name="permission_id" required>
                                <option value="">Selecione</option>
                                @foreach($permissions as $permission)
                                    <option value="{{ $permission->id }}" {{ old('permission_id') == $permission->id ? 'selected' : '' }}>
                                        {{ $permission->permission }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('permission_id')" class="alert alert-danger mt-2" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info">Associar Permissão</button>
                <a href="{{ route('user-permissions.create') }}" class="btn btn-default ml-2">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
