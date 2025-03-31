<?php

use App\Http\Controllers\ParturientesController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\AuthController;
use App\Models\Profissional;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;




Route::controller(AuthController::class)->group(function (){
    Route::get('/login', 'index')->name('login.index');
    Route::post('/login', 'store')->name('login.store');
    Route::get('/logout', 'destroy')->name('logout');
    Route::get('/register', 'createUser')->name('register.index');
    Route::post('/register', 'storeUser')->name('register.store');
    Route::get('/listarusuarios', 'listarUser')->name('listarusuarios.index');
});

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('index');
    })->name('index');

    Route::controller(PacienteController::class)->group(function (){
        Route::get('/cadastrarpaciente','index')->name('cadastrarpaciente.index');
        Route::post('/cadastrarpaciente','store')->name('cadastrarpaciente.store');
        Route::get('/listarpaciente','listarpaciente')->name('listarpaciente.index');
        Route::get('/editarpaciente','index')->name('editarpaciente.index');
        Route::get('/excluirpaciente','index')->name('excluirpaciente.index');
        Route::get('/buscar-cep/{cep}', 'buscarCep')->name('buscar.cep');
    });

    Route::controller(ParturientesController::class)->group(function (){
        Route::get('/incluirAnamnese','index')->name('incluirAnamenese.index');
        Route::post('/incluirAnamnese','store')->name('incluirAnamenese.store');
        Route::get('/iniciarAtendimento','indexAtendimento')->name('iniciarAtendimento.index');
    });

    Route::controller(ProfissionalController::class)->group(function (){
        Route::get('/cadastrarprofissional','index')->name('cadastroprofissional.index');
        Route::post('/cadastrarprofissional','store')->name('cadastroprofissional.store');
        Route::get('/listarprofissional','listarprofissional')->name('listarprofissional.index');
        Route::get('/editarprofissional','index')->name('editarprofissional.index');
        Route::get('/excluirprofissional','index')->name('excluirprofissional.index');
    });
});
