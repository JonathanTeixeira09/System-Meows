<?php

use App\Http\Controllers\ParturientesController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\PacienteController;
use App\Models\Profissional;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/login', function () {
    return view('auth.login');
})->name('login.index');


Route::controller(PacienteController::class)->group(function (){
    Route::get('/cadastrarpaciente','index')->name('cadastrarpaciente.index');
    Route::post('/cadastrarpaciente','store')->name('cadastrarpaciente.store');
    Route::get('/listarpaciente','listarpaciente')->name('listarpaciente.index');
    Route::get('/editarpaciente','index')->name('editarpaciente.index');
    Route::get('/excluirpaciente','index')->name('excluirpaciente.index');
});

Route::controller(ParturientesController::class)->group(function (){
    Route::get('/incluirAnamnese','index')->name('incluirAnamenese.index');
    Route::post('/incluirAnamnese','store')->name('incluirAnamenese.store');
    Route::get('/iniciarAtendimento','indexAtendimento')->name('iniciarAtendimento.index');
});

Route::controller((ProfissionalController::class))->group(function (){
    Route::get('/cadastrarprofissional','index')->name('cadastroprofissional.index');
    Route::post('/cadastrarprofissional','store')->name('cadastroprofissional.store');
    Route::get('/listarprofissional','listarprofissional')->name('listarprofissional.index');
    Route::get('/editarprofissional','index')->name('editarprofissional.index');
    Route::get('/excluirprofissional','index')->name('excluirprofissional.index');
});