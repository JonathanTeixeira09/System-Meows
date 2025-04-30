<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Profissional;
use Illuminate\Http\Request;

/**
 * Controller responsável por gerenciar os cargos
 *
 * @package App\Http\Controllers
 */
class CargoController extends Controller
{
    /**
     * Exibe a view para cadastrar cargos
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cargos = Cargo::orderby('nome')->get();
        return view('admin.administrativo.createCargo',['cargos' => $cargos]);
    }

    /**
     * Armazena um novo cargo no banco de dados
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
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

    /**
     * Exibe a view para editar um cargo existente
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $cargo = Cargo::findOrFail($id);
        $cargos = Cargo::orderBy('nome')->get();
        return view('admin.administrativo.createCargo', compact('cargo', 'cargos'));
    }

    /**
     * Atualiza um cargo existente no banco de dados
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $cargo = Cargo::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:255|unique:cargos,nome,'.$cargo->id,
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.max' => 'O nome não pode ter mais que 255 caracteres',
            'nome.unique' => 'Este cargo já está cadastrado'
        ]);

        $cargo->update($request->all());
        flash('Cargo atualizado com sucesso!')->success();
        return redirect()->route('cadastrarCargo.index');
    }

    /**
     * Exclui um cargo do banco de dados
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $cargo = Cargo::findOrFail($id);

        // Verifica se o cargo está sendo usado por profissionais
        if (Profissional::where('cargo_id', $cargo->id)->exists()) {
            flash('Este cargo está vinculado a Evolução de Paciente e não pode ser excluído!')->error();
            return back();
        }

        try {
            $cargo->delete();
            flash('Cargo removido com sucesso!')->success();
        } catch (\Exception $e) {
            flash('Erro ao excluir cargo: ' . $e->getMessage())->error();
        }

        return redirect()->route('cadastrarCargo.index');
    }
}
