@extends('layouts.app')

@section('title', 'Gesped | Lista de Status')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Lista de Status</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                 <!--   <li class="breadcrumb-item"><a href="#">Home</a></li>-->
                    <li class="breadcrumb-item active">Status</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class="row">
    <div class="col-12">
        @if(session('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div id="error-message" class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Status</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm mb-3" style="width: 250px;">
                        <input type="text" id="searchInput" class="form-control float-right"
                            placeholder="Pesquisar por Nome ou ID">

                        <div class="input-group-append">
                            <button type="button" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Cod</th>
                            <th>Descrição</th>
                            <th>Data de Criação</th>
                            <th>Data de Alteração</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($statuses as $status)
                        <tr>
                            <td>{{ $status->id }}</td>
                            <td>{{ $status->desc }}</td>
                            <td>{{ $status->created_at }}</td>
                            <td>{{ $status->updated_at }}</td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('status.edit', ['id' => $status->id]) }}"
                                        class="btn btn-info" title="Detalhes">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Formulário para a exclusão -->
                                    <form action="{{ route('status.destroy', ['id' => $status->id]) }}"
                                        method="post"
                                        onsubmit="return confirm('Tem certeza que deseja excluir este status?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Excluir">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<script>
// Adiciona um atraso de 5 segundos para esconder as mensagens
setTimeout(function() {
    document.getElementById('success-message')?.style.display = 'none';
    document.getElementById('error-message')?.style.display = 'none';
}, 5000);
</script>

@endsection
