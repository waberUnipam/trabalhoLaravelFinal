<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('livros.index');
});


use App\Http\Controllers\LivroController;

Route::resource('livros', LivroController::class);

Route::get('/theme/toggle', function () {

    $current = session('theme', 'light');

    // alterna entre claro e escuro
    $new = $current === 'light' ? 'dark' : 'light';

    session(['theme' => $new]);

    return back();

})->name('theme.toggle');