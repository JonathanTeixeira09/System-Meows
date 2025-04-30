<?php

namespace App\Http\Controllers;


use App\Models\Local;
use Illuminate\Http\Request;
use App\Models\Evolucao;


class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locals = Local::orderby('nome')->get();
        return view('admin.administrativo.createLocal', ['locals' => $locals]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255|unique:locals,nome',
            'descricao' => 'nullable|string|max:255'
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.max' => 'O nome não pode ter mais que 255 caracteres',
            'nome.unique' => 'Este local já está cadastrado',
            'descricao.max' => 'A descrição não pode ter mais que 255 caracteres'
        ]);

        Local::create($request->all());
        flash('Local cadastrado com sucesso!')->success();
        return redirect()->route('cadastrarLocal.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Local $local)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $local = Local::findOrFail($id);
        $locals = Local::orderby('nome')->get();
        return view('admin.administrativo.createLocal', compact('local', 'locals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $local = Local::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:255|unique:locals,nome,'.$local->id,
            'descricao' => 'nullable|string|max:255'
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.max' => 'O nome não pode ter mais que 255 caracteres',
            'nome.unique' => 'Este local já está cadastrado',
            'descricao.max' => 'A descrição não pode ter mais que 255 caracteres'
        ]);

        $local->update($request->all());
        flash('Local atualizado com sucesso!')->success();
        return redirect()->route('cadastrarLocal.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $local = Local::findOrFail($id);

        // Verifica se o local está sendo usado em alguma tabela relacionada
        $emUso = false;
        $mensagem = '';

        // Exemplo: verificar se há agendamentos usando este local
        if ($local->evolucaos()->count() > 0) {
            $emUso = true;
            $mensagem = 'Este local possui agendamentos vinculados.';
        }

        if ($emUso) {
            flash($mensagem . ' Não é possível excluir.')->error();
            return redirect()->route('cadastrarLocal.index');
        }

        // Se não estiver em uso, procede com a exclusão
        $local->delete();
        flash('Local removido com sucesso!')->success();
        return redirect()->route('cadastrarLocal.index');
    }
}
