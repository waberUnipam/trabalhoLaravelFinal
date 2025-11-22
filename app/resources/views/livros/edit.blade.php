@extends('layout')

@section('title', 'Editar Livro')

@section('content')

<h1 class="mb-4">Editar Livro</h1>

<form action="{{ route('livros.update', $livro->id) }}" 
      method="POST" 
      enctype="multipart/form-data" 
      class="card p-4">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Título</label>
        <input name="titulo" 
               value="{{ $livro->titulo }}" 
               class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Autor</label>
        <input name="autor" 
               value="{{ $livro->autor }}" 
               class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Ano</label>
        <input name="ano" 
               value="{{ $livro->ano }}" 
               class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Capa</label>
        <input type="file" name="capa" class="form-control">
    </div>

    @if($livro->capa)
        <div class="mb-3">
            <small class="text-muted">Capa atual:</small><br>
            <img src="{{ asset('storage/' . $livro->capa) }}" 
                 class="mt-2 border"
                 width="120">
        </div>
    @endif

    <div class="mt-3">
        <button type="submit" class="btn btn-success">Salvar</button>

        <button type="reset" class="btn btn-warning ms-2">
            Limpar
        </button>

        <a href="{{ route('livros.index') }}" class="btn btn-secondary ms-2">
            Voltar
        </a>
    </div>
</form>

@endsection
