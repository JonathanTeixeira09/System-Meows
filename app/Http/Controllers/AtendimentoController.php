<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atendimento;
use App\Models\Paciente;

class AtendimentoController extends Controller
{
    public function index()
    {
        // Carrega atendimentos com relacionamentos
        $atendimentos = Atendimento::with(['paciente', 'entradaUser', 'altaUser'])
            ->latest() // Opcional: ordena do mais recente para o mais antigo
            ->get();

        // Carrega todos os pacientes ordenados por nome para o campo de busca
        $pacientes = Paciente::orderBy('nome')->get();
        return view(('admin.atendimentos.formIniciarAtendimento'), ['pacientes' => $pacientes, 'atendimentos' => $atendimentos]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
        ],
        [
            'paciente_id.required' => 'Obrigatório selecionar uma paciente.',
            'paciente_id.exists' => 'O paciente selecionado não existe.',
        ]);


        $now = now()->setTimezone('America/Sao_Paulo');

        $data = array_merge($data, [
            'data_entrada' => $now->toDateString(),
            'hora_entrada' => $now->toTimeString(),
            'entrada_user_id' => auth()->id()
        ]);

        Atendimento::create($data);

        flash('Atendimento iniciodo com sucesso!')->success();
        return redirect()->route('listarAtendimentos.index');
    }

    public function list()
    {
        // Atendimentos em aberto (sem data de alta) com relacionamentos
        $atendimentos = Atendimento::with(['paciente', 'entradaUser'])
            ->whereNull('data_alta')
            ->orderBy('data_entrada', 'desc')
            ->orderBy('hora_entrada', 'desc')
            ->get();
        return view('admin.atendimentos.listarAtendimentos', [
            'atendimentos' => $atendimentos,
        ]);
    }
}
