<?php

use App\Http\Controllers\ParturientesController;
use App\Http\Controllers\ProfissionalController;
use App\Models\Profissional;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

// Route::get('/cadastrarfuncionario', function () {
//     return view('admin.profissional.createProfissional');
// })->name('cadastroprofissional.index');

Route::get('/login', function () {
    return view('auth.login');
})->name('login.index');


Route::get('/cadastrarpaciente', function () {
    return view('admin.paciente.createPaciente');
})->name('cadastrarpaciente.index');


Route::controller(ParturientesController::class)->group(function (){
//    Route::get('/incluirAnamnese','index')->name('incluirAnamenese.index');
    Route::get('/incluirAnamnese','index')->name('incluirAnamenese.index');
    Route::post('/incluirAnamnese','store')->name('incluirAnamenese.store');
    Route::get('/iniciarAtendimento','indexAtendimento')->name('iniciarAtendimento.index');
});

Route::controller((ProfissionalController::class))->group(function (){
    Route::get('/cadastrarfuncionario','index')->name('cadastroprofissional.index');
    Route::post('/cadastrarfuncionario','store')->name('cadastroprofissional.store');
    Route::get('/listarfuncionarios','index')->name('listarfuncionarios.index');
    Route::get('/editarfuncionario','index')->name('editarfuncionario.index');
    Route::get('/excluirfuncionario','index')->name('excluirfuncionario.index');
});