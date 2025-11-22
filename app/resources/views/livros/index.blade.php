@extends('layout')

@section('title', 'Livros')

@section('content')

<h1 class="mb-4">Lista de Livros</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('livros.create') }}" class="btn btn-primary mb-3">
    Cadastrar Novo Livro
</a>
@if (Cookie::get('ultimo_livro'))
    <div class="alert alert-info">
        Último livro adicionado: 
        <strong>{{ Cookie::get('ultimo_livro') }}</strong>
    </div>
@endif

<table class="table table-bordered table-striped">
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Autor</th>
        <th>Ano</th>
        <th>Capa</th>
        <th width="150">Ações</th>
    </tr>

    @foreach($livros as $livro)
    <tr>
        <td>{{ $livro->id }}</td>
        <td>{{ $livro->titulo }}</td>
        <td>{{ $livro->autor }}</td>
        <td>{{ $livro->ano }}</td>
        <td>
            @if($livro->capa)
                <img src="{{ asset('storage/' . $livro->capa) }}" width="60">
            @endif
        </td>
        <td>
            <a href="{{ route('livros.edit', $livro->id) }}" 
               class="btn btn-sm btn-warning">
                Editar
            </a>

            <form action="{{ route('livros.destroy', $livro->id) }}" 
                  method="POST" 
                  style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" type="submit">
                    Excluir
                </button>
            </form>
        </td>
    </tr>
    @endforeach

</table>

@endsection
