@extends('template.app')

@section('title', isset($contrato) ? 'Editar Contrato' : 'Cadastrar Contrato')

@section('content')

<div class="card card-default">
    <div class="col-12">
        @if(session('error'))
            <div id="error-message" class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
    <div class="card-header">
        <h3 class="card-title">{{ isset($contrato) ? 'Editar Contrato' : 'Cadastrar Contrato' }}</h3>
    </div>

    <form action="{{ isset($contrato) ? route('contratos.update', $contrato->id) : route('contratos.store') }}" method="POST">
        @csrf
        @if(isset($contrato))
            @method('PUT') {{-- Utilize o método PUT para atualização --}}
        @endif

        <div class="card-body">
            <div class="row">
                <!-- Outros campos do contrato -->

                <div class="col-md-6">
    <div class="form-group">
        <label for="numero">Número do Contrato</label>
        <input type="text" class="form-control" id="numero" name="numero" value="{{ isset($contrato) ? $contrato->numero : old('numero') }}" required>
    </div>

    <div class="form-group">
        <label for="data">Data do Contrato</label>
        <input type="date" class="form-control" id="data" name="data" value="{{ isset($contrato) ? $contrato->data : old('data') }}" required>
    </div>

    <div class="form-group">
        <label for="valor">Valor do Contrato</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">R$</span>
            </div>
            <input type="number" class="form-control" id="valor" name="valor" value="{{ isset($contrato) ? $contrato->valor : old('valor') }}" required>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="tipo_contrato_id">Tipo de Contrato</label>
        <select class="form-control select2bs4" name="tipo_contrato_id" style="width: 100%;" required>
            @foreach($tiposContrato as $tipoContrato)
                <option value="{{ $tipoContrato->id }}" {{ isset($contrato) && $contrato->tipo_contrato_id == $tipoContrato->id ? 'selected' : '' }}>
                    {{ $tipoContrato->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="descricao">Descrição do Contrato</label>
        <textarea class="form-control" id="descricao" name="descricao" rows="3">{{ isset($contrato) ? $contrato->descricao : old('descricao') }}</textarea>
    </div>
</div>


        <div class="card-footer">
            <button type="submit" class="btn btn-info">{{ isset($contrato) ? 'Atualizar' : 'Salvar' }}</button>
            <a href="{{ route('contratos.index') }}" class="btn btn-default ml-2">Cancelar</a>
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
