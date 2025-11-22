@extends('layout')

@section('title', 'Cadastrar Livro')

@section('content')

<h1 class="mb-4">Novo Livro</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Existem erros no formulário:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('livros.store') }}" 
      method="POST" 
      enctype="multipart/form-data" 
      class="card p-4">
    @csrf

    <div class="mb-3">
        <label class="form-label">Título</label>
        <input name="titulo" 
               value="{{ old('titulo') }}" 
               class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Autor</label>
        <input name="autor" 
               value="{{ old('autor') }}" 
               class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Ano</label>
        <input name="ano" 
               value="{{ old('ano') }}" 
               class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Capa</label>
        <input type="file" name="capa" class="form-control">
    </div>

    <div style="margin-top: 10px;">
    <button type="submit">Salvar</button>
    <button type="reset" style="margin-left: 10px;">Limpar</button>
</div>


    <a href="{{ route('livros.index') }}" 
       class="btn btn-secondary ms-2">
        Voltar
    </a>
</form>

@endsection
