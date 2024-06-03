<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/cadastrarfuncionario', function () {
    return view('admin.profissional.createProfissional');
})->name('cadastroprofissional.index');

Route::get('/login', function () {
    return view('auth.login');
})->name('login.index');


Route::get('/cadastrarpaciente', function () {
    return view('admin.paciente.createPaciente');
})->name('cadastrarpaciente.index');
