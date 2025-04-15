<?php

namespace App\Http\Controllers;

use App\Models\FormacaoProfissional;
use Illuminate\Http\Request;

class FormacaoProfissionalController extends Controller
{
    public function index()
    {
        $formacoes = FormacaoProfissional::orderby('nome')->get();
        return view('admin.administrativo.createFormacao', ['formacoes' => $formacoes]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255|unique:formacao_profissionals,nome',
        ], [
            'nome.required' => 'O campo nome da Formação é obrigatório',
            'nome.max' => 'O nome não pode ter mais que 255 caracteres',
            'nome.unique' => 'Este nome já está cadastrado'
        ]);

        FormacaoProfissional::create($request->all());

        flash('Formação cadastrada com sucesso!')->success();
        return redirect()->route('cadastrarFormacao.index');
    }
}
