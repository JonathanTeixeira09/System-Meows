<?php

use App\Http\Controllers\ParturientesController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\FormacaoProfissionalController;
use App\Models\Profissional;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;




Route::controller(AuthController::class)->group(function (){
    Route::get('/login', 'index')->name('login.index');
    Route::post('/login', 'store')->name('login.store');
    Route::get('/logout', 'destroy')->name('logout');
    Route::get('/register', 'createUser')->name('register.index')->middleware('auth');
    Route::post('/register', 'storeUser')->name('register.store')->middleware('auth');
    Route::get('/listarusuarios', 'listarUser')->name('listarusuarios.index')->middleware('auth');
});

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('index');
    })->name('index');

    Route::get('/sobremim', function () {
        return view('layouts.sobreMim');
    })->name('sobremim.index');

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

    Route::controller(CargoController::class)->group(function (){
        Route::get('/cadastrarCargo','index')->name('cadastrarCargo.index');
        Route::post('/cadastrarCargo','store')->name('cadastrarCargo.store');
        Route::get('/listarCargo','listarCargo')->name('listarCargo.index');
        Route::get('/editarCargo','index')->name('editarCargo.index');
        Route::get('/excluirCargo','index')->name('excluirCargo.index');
    });

    Route::controller(FormacaoProfissionalController::class)->group(function (){
        Route::get('/cadastrarFormacao','index')->name('cadastrarFormacao.index');
        Route::post('/cadastrarFormacao','store')->name('cadastrarFormacao.store');
        Route::get('/listarFormacao','listarFormacao')->name('listarFormacao.index');
        Route::get('/editarFormacao','index')->name('editarFormacao.index');
        Route::get('/excluirFormacao','index')->name('excluirFormacao.index');
    });
});
