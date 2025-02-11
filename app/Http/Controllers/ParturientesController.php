<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParturientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view('admin.atendimentos.formAnamnese');
    }

    public function indexAtendimento()
    {
        return view('admin.atendimentos.formIniciarAtendimento');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $validated = $request->validate([
            'nomeDaPaciente' => 'required|string|max:255',
            'fc' => 'required',
            'fr' => 'required',
            'PA' => 'required',
            'PAD' => 'required',
            'Temp' => 'required',
            'SO' => 'required',
            'obs' => 'nullable|string|max:1000',
        ], [
            // Mensagens de erro personalizadas
            'nomeDaPaciente.required' => 'O nome da parturiente é obrigatório.',
            'fc.required' => 'Selecione uma opção para a frequência cardíaca.',
            'fr.required' => 'Selecione uma opção para a frequência respiratória.',
            'PA.required' => 'Selecione uma opção para a pressão arterial sistólica.',
            'PAD.required' => 'Selecione uma opção para a pressão arterial diastólica.',
            'Temp.required' => 'Selecione uma opção para a temperatura.',
            'SO.required' => 'Selecione uma opção para a saturação de oxigênio.',
        ]);

        dd($request);
        
        // Inicializa a pontuação total
        $pontuacaoTotal = 0;

        


        

        // $fc = $request->input('frequenciaCardiaca');
        // $fr = $request->input('frequenciaRespiratoria');
        // $pas = $request->input('pressaoArterialSistolica');
        // $pad = $request->input('pressaoArterialDiastolica');
        // $temp = $request->input('temperatura');
        // $avpu = $request->input('condicaoNeurologica');
        // $spo2 = $request->input('saturacaoOxigenio');
        // $diurese = $request->input('diurese');

        // $scores = [
        //     'frequenciaCardiaca' => 0,
        //     'frequenciaRespiratoria' => 0,
        //     'pressaoArterialSistolica' => 0,
        //     'pressaoArterialDiastolica' => 0,
        //     'temperatura' => 0,
        //     'condicaoNeurologica' => 0,
        //     'saturacaoOxigenio' => 0,
        //     'diurese' => 0,
        // ];

        // $messages = [
        //     'frequenciaCardiaca' => 'Não existe Mensagem',
        //     'frequenciaRespiratoria' => 'Não existe Mensagem',
        //     'pressaoArterialSistolica' => 'Não existe Mensagem',
        //     'pressaoArterialDiastolica' => 'Não existe Mensagem',
        //     'temperatura' => 'Não existe Mensagem',
        //     'condicaoNeurologica' => 'Não existe Mensagem',
        //     'saturacaoOxigenio' => 'Não existe Mensagem',
        //     'diurese' => 'Não existe Mensagem',
        // ];

        
        return redirect()->route('incluirAnamenese.index')->with('success', 'Anamnese cadastrada com sucesso!');
        // if ($request->ajax()) {
        //     return response()->json(['scores' => $scores, 'messages' => $messages]);
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
