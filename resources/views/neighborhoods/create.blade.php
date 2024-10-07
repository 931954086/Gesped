@extends('layouts.app')

@section('title', isset($neighborhood) ? 'Edit Bairro' : 'Criar Bairros')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ isset($neighborhood) ? 'Edit Bairro' : 'Create Bairros' }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('neighborhoods.index')}}">Listar</a></li>
                    <li class="breadcrumb-item active">{{ isset($neighborhood) ? 'Edit Bairro' : 'Create Bairros' }}</li>
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

    <form action="{{ isset($neighborhood) ? route('neighborhoods.update', $neighborhood->id) : route('neighborhoods.store') }}" method="POST">
        @csrf
        @if(isset($neighborhood))
        @method('PUT')
        @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ isset($neighborhood) ? $neighborhood->name : old('name') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="municipality_id">Municipality</label>
                        <select class="form-control" id="municipality_id" name="municipality_id" required>
                            <option value="">Select</option>
                            @foreach($municipalities as $municipality)
                            <option value="{{ $municipality->id }}" {{ isset($neighborhood) && $neighborhood->municipality_id == $municipality->id ? 'selected' : '' }}>
                                {{ $municipality->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info">{{ isset($neighborhood) ? 'Update' : 'Save' }}</button>
            <a href="{{ route('neighborhoods.index') }}" class="btn btn-default ml-2">Cancel</a>
        </div>
    </form>
</div>
@endsection
