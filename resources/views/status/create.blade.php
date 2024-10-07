@extends('layouts.app')

@section('title', isset($status) ? 'Editar Status' : 'Cadastrar Status')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ isset($status) ? 'Editar Status' : 'Cadastrar Status' }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">{{ isset($status) ? 'Editar Status' : 'Cadastrar Status' }}</li>
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
    <div class="card-header">
        <h3 class="card-title">{{ isset($status) ? 'Editar Status' : 'Cadastrar Status' }}</h3>
    </div>

    <form action="{{ isset($status) ? route('status.update', $status->id) : route('status.store') }}" method="POST">
        @csrf

        @if(isset($status))
            @method('PUT') {{-- Utilize o método PUT para atualização --}}
        @endif

        <div class="card-body">
            <div class="row">
          
                <!-- Coluna 2 - Adicione mais campos conforme necessário -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="desc">Descrição</label>
                        <input type="text" class="form-control" id="desc" name="desc" value="{{ isset($status) ? $status->desc : old('desc') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info">{{ isset($status) ? 'Atualizar' : 'Salvar' }}</button>
            <a href="{{ route('status.index') }}" class="btn btn-default ml-2">Cancelar</a>
        </div>
    </form>
</div>

<script>
    // Adiciona um atraso de 5 segundos para esconder a mensagem de erro
    setTimeout(function () {
        document.getElementById('error-message').style.display = 'none';
    }, 5000);
</script>

@endsection
