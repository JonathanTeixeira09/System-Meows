<?php

namespace App\Http\Controllers;

use App\Models\FormacaoProfissional;
use App\Models\Profissional;
use Illuminate\Http\Request;

/**
 * Class FormacaoProfissionalController
 * Responsável por gerenciar as formações profissionais
 * @package App\Http\Controllers
 */
class FormacaoProfissionalController extends Controller
{
    /**
     * Exibe a view para cadastrar uma nova formação profissional
     *
     */
    public function index()
    {
        $formacoes = FormacaoProfissional::orderby('nome')->get();
        return view('admin.administrativo.createFormacao', ['formacoes' => $formacoes]);
    }

    /**
     * Armazena uma nova formação profissional
     *
     */
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

    /**
     * Função para editar uma formação profissional
     *
     */
    public function edit($id)
    {
        $formacao = FormacaoProfissional::findOrFail($id);
        $formacoes = FormacaoProfissional::orderBy('nome')->get();
        return view('admin.administrativo.createFormacao', compact('formacao', 'formacoes'));
    }

    /**
     * Atualiza uma formação profissional existente
     *
     */
    public function update(Request $request, $id)
    {
        $formacao = FormacaoProfissional::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:255|unique:formacao_profissionals,nome,'.$formacao->id,
        ], [
            'nome.required' => 'O campo nome da Formação é obrigatório',
            'nome.max' => 'O nome não pode ter mais que 255 caracteres',
            'nome.unique' => 'Este nome já está cadastrado'
        ]);

        $formacao->update($request->all());
        flash('Formação atualizada com sucesso!')->success();
        return redirect()->route('cadastrarFormacao.index');
    }

    /**
     * Exclui uma formação profissional
     *
     */
    public function destroy($id)
    {
        $formacao = FormacaoProfissional::findOrFail($id);

        // Verifica se a formação está sendo usada por usuários
        if (Profissional::where('formacao_id', $formacao->id)->exists()) {
            flash('Esta formação está vinculada a usuários e não pode ser excluída!')->error();
            return back();
        }

        try {
            $formacao->delete();
            flash('Formação removida com sucesso!')->success();
        } catch (\Exception $e) {
            flash('Erro ao excluir formação: ' . $e->getMessage())->error();
        }

        return redirect()->route('cadastrarFormacao.index');
    }
}
