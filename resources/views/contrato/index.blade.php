@extends('template.app')

@section('title', 'Lista de Contratos de Trabalho')

@section('content')

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
                <h3 class="card-title">Lista de Contratos de Trabalho</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap" id="minha-tabela">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome da Empresa</th>
                            <th>Data do Contrato</th>
                            <th>Nome do Empregador</th>
                            <th>Nome do Funcionário</th>
                            <th>Cargo</th>
                            <th>Data de Assinatura Empregador</th>
                            <th>Data de Assinatura Funcionário</th>
                            <th>Data de Criação</th>
                            <th>Data de Alteração</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contratos as $contrato)
                            <tr>
                                <td>{{ $contrato->IDContrato }}</td>
                                <td>{{ $contrato->NomeEmpresa }}</td>
                                <td>{{ $contrato->DataContrato }}</td>
                                <td>{{ $contrato->NomeEmpregador }}</td>
                                <td>{{ $contrato->NomeFuncionario }}</td>
                                <td>{{ $contrato->Cargo }}</td>
                                <td>{{ $contrato->AssinaturaEmpregador }}</td>
                                <td>{{ $contrato->DataAssinaturaEmpregador }}</td>
                                <td>{{ $contrato->DataAssinaturaFuncionario }}</td>
                                <td>{{ $contrato->created_at }}</td>
                                <td>{{ $contrato->updated_at }}</td>
                                <!-- Dentro do loop de contratos -->
                                <td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('contratos.edit', ['id' => $contrato->IDContrato]) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                        <!-- Formulário para a exclusão -->
                                        <form action="{{ route('contratos.destroy', ['id' => $contrato->IDContrato]) }}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir este contrato?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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

@endsection
