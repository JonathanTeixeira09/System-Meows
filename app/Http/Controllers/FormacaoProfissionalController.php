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
            'nome' => 'required|string|max:255',
        ],
        [
            'nome.required' => 'O nome da formação é obrigatório.',
        ]);

        FormacaoProfissional::create($request->all());

        flash('Formação cadastrada com sucesso!')->success();
        return redirect()->route('cadastrarFormacao.index');
    }
}
