<?php

namespace App\Http\Controllers;


use App\Models\Local;
use Illuminate\Http\Request;


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
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.max' => 'O nome não pode ter mais que 255 caracteres',
            'nome.unique' => 'Este local já está cadastrado'
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, Local $local)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Local $local)
    {
        //
    }
}
