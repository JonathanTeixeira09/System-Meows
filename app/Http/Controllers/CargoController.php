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
            'nome' => 'required|string|max:255|unique:cargos,nome',
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.max' => 'O nome não pode ter mais que 255 caracteres',
            'nome.unique' => 'Este cargo já está cadastrado'
        ]);

        Cargo::create($request->all());

        flash('Cargo cadastrado com sucesso!')->success();
        return redirect()->route('cadastrarCargo.index');
    }
}
