<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function index()
    {
        $cargos = Cargo::orderby('nome')->get();
        return view('admin.administrativo.createCargo',['cargos' => $cargos]);
    }

    /**
     * Exibe a lista de cargos cadastrados
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
        ],
        [
            'nome.required' => 'O nome do cargo é obrigatório.',
        ]);

        Cargo::create($request->all());

        flash('Cargo cadastrado com sucesso!')->success();
        return redirect()->route('cadastrarCargo.index');
    }
}
