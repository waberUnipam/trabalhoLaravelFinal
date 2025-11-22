<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;


class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $livros = \App\Models\Livro::all();
    return view('livros.index', compact('livros'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('livros.create');
}


    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $dados = $request->validate([
        'titulo' => 'required|min:2',
        'autor'  => 'required|min:2',
        'ano'    => 'nullable|integer|min:0|max:3000',
        'capa'   => 'nullable|image|mimes:jpg,png'
    ],
    [
    'titulo.required' => 'O campo "Título" é obrigatório.',
    'autor.required' => 'O campo "Autor" é obrigatório.',
    'capa.mimes' => 'A capa deve ser uma imagem PNG ou JPG.'
]
);

    if ($request->hasFile('capa')) {
        $dados['capa'] = $request->file('capa')->store('capas', 'public');
    }

    $livro = Livro::create($dados);

    cookie()->queue('ultimo_livro', $livro->titulo, 60);

    return redirect()
        ->route('livros.index')
        ->with('success', 'Livro cadastrado com sucesso!');
}




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $livro = Livro::findOrFail($id);
    return view('livros.edit', compact('livro'));
}


    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $livro = Livro::findOrFail($id);

    $dados = $request->validate(
    [
        'titulo' => 'required|min:2',
        'autor'  => 'required|min:2',
        'ano'    => 'nullable|integer|min:0|max:3000',
        'capa'   => 'nullable|image|mimes:jpg,png'
    ],
    [
        'titulo.required' => 'O campo "Título" é obrigatório.',
        'autor.required' => 'O campo "Autor" é obrigatório.',
        'capa.mimes' => 'A capa deve ser uma imagem PNG ou JPG.'
    ]
    );

    if ($request->hasFile('capa')) {
        $dados['capa'] = $request->file('capa')->store('capas', 'public');
    }

    $livro->update($dados);

    return redirect()
        ->route('livros.index')
        ->with('success', 'Livro atualizado com sucesso!');
}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $livro = Livro::findOrFail($id);
    $livro->delete();

    return redirect()->route('livros.index')
                     ->with('success', 'Livro excluído com sucesso!');
}

}
