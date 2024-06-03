<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/cadastrarfuncionario', function () {
    return view('admin.profissional.createProfissional');
})->name('cadastroprofissional.index');
