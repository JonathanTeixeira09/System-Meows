<?php

use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\FormacaoProfissionalController;
use App\Http\Controllers\EvolucaoController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;


Route::controller(AuthController::class)->group(function (){
    Route::get('/login', 'index')->name('login.index');
    Route::post('/login', 'store')->name('login.store');
    Route::get('/logout', 'destroy')->name('logout');
    Route::get('/register', 'createUser')->name('register.index')->middleware('auth');
    Route::post('/register', 'storeUser')->name('register.store')->middleware('auth');
    Route::get('/listarusuarios', 'listarUser')->name('listarusuarios.index')->middleware('auth')->middleware('role:superadmin,admin');
    Route::get('/editarusuario/{id}/', 'editUser')->name('editarusuario.index')->middleware('auth')->middleware('role:superadmin,admin');
    Route::post('/editarusuario/{id}/', 'updateUser')->name('editarusuario.update')->middleware('auth')->middleware('role:superadmin,admin');
    Route::patch('/users/{user}/disable', 'disable')->name('users.disable')->middleware('auth')->middleware('role:superadmin,admin');
    Route::patch('/users/{user}/enable', 'enable')->name('users.enable')->middleware('auth')->middleware('role:superadmin,admin');
    Route::get('/user/{user}', 'show')->name('user.show')->middleware('auth')->middleware('role:superadmin,admin');
});

Route::get('/sobremim', function () {
    return view('layouts.sobreMim');
})->name('sobremim.index');

// Rota para exibir a view Principal com o gráfico
Route::get('/',[EvolucaoController::class,'viewPrincipal'])->name('index')->middleware('auth', 'role:superadmin,profissional,admin');

Route::middleware('auth', 'role:superadmin,profissional')->group(function () {

    Route::controller(PacienteController::class)->group(function (){
        Route::get('/cadastrarpaciente','index')->name('cadastrarpaciente.index');
        Route::post('/cadastrarpaciente','store')->name('cadastrarpaciente.store');
        Route::get('/listarpaciente','listarpaciente')->name('listarpaciente.index');
        Route::get('/editarpaciente','index')->name('editarpaciente.index');
        Route::get('/excluirpaciente','index')->name('excluirpaciente.index');
        Route::get('/buscar-cep/{cep}', 'buscarCep')->name('buscar.cep');
    });


    Route::controller(EvolucaoController::class)->group(function (){
        Route::get('/incluirevolucao/{atendimento}','index')->name('incluirEvolucao');
        Route::post('/incluirEvolucao','store')->name('incluirEvolucao.store');
        Route::get('/evolucao/{id}/relatorio', 'relatorio')->name('evolucao.relatorio');
        route::get('/evolucao/{id}/pdf', 'gerarPdf')->name('evolucao.pdf');
        route::get('/evolucao/{id}/ultima-evolucao', 'ultimaEvolucao')->name('evolucao.ultima');
        route::get('/evolucao/{id}/listar-evolucoes', 'listarEvolucoes')->name('evolucao.listar');
        // Rota para exibir a view com o gráfico
        Route::get('/atendimentos/{atendimento_id}', 'mostrarGrafico')->name('evolucoes.grafico');
        //Rota Principal do Sistema
//        Route::get('/', 'viewPrincipal')->name('index');
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

    Route::controller(LocalController::class)->group(function (){
        Route::get('/cadastrarLocal','index')->name('cadastrarLocal.index');
        Route::post('/cadastrarLocal','store')->name('cadastrarLocal.store');
        Route::get('/listarLocal','listarLocal')->name('listarLocal.index');
        Route::get('/editarLocal/{id}','edit')->name('editarLocal.index');
        Route::put('/editarLocal/{id}','update')->name('editarLocal.update');
        Route::get('/excluirLocal','index')->name('excluirLocal.index');
    });

    Route::controller(AtendimentoController::class)->group(function (){
        Route::get('/iniciarAtendimento','index')->name('iniciarAtendimento.index');
        Route::post('/iniciarAtendimento','store')->name('iniciarAtendimento.store');
        Route::get('/listarAtendimentos','list')->name('listarAtendimentos.index');
        Route::get('/altaPaciente/{atendimento_id}','altaPaciente')->name('altaPaciente.index');
    });

});

Route::get('/debug-auth', function() {
    dd(auth()->user()); // Deve retornar o usuário logado
});


