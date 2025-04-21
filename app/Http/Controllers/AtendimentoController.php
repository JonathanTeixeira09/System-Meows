<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atendimento;
use App\Models\Paciente;

class AtendimentoController extends Controller
{
    public function index()
    {
//        // Carrega atendimentos com relacionamentos
        $atendimentos = Atendimento::with(['paciente', 'entradaUser', 'altaUser'])
            ->latest() // Opcional: ordena do mais recente para o mais antigo
            ->get();

        // Carrega todos os pacientes ordenados por nome para o campo de busca
        $pacientes = Paciente::orderBy('nome')->get();

        // Retorna a view com inicio dos atendimentos a pacientes
        return view(('admin.atendimentos.formIniciarAtendimento'), ['pacientes' => $pacientes, 'atendimentos' => $atendimentos]);

    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id|unique:atendimentos,paciente_id,NULL,id,data_alta,NULL',
        ],
        [
            'paciente_id.required' => 'Obrigatório selecionar uma paciente.',
            'paciente_id.exists' => 'O paciente selecionado não existe.',
            'paciente_id.unique' => 'O paciente já está em atendimento.',
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
        $atendimentos = Atendimento::with(['paciente', 'entradaUser.profissional', 'evolucoes' => function($query) {
            $query->latest()->limit(1); // Pega apenas a última evolução
        }])->get();

        return view('admin.atendimentos.listarAtendimentos', [
            'atendimentos' => $atendimentos,
        ]);
    }

    public function altaPaciente($pacienteId)
    {
        $atendimento = Atendimento::where('paciente_id', $pacienteId)
            ->whereNull('data_alta')
            ->first();

        if ($atendimento) {
            $now = now()->setTimezone('America/Sao_Paulo');
            $atendimento->update([
                'data_alta' => $now->toDateString(),
                'hora_alta' => $now->toTimeString(),
                'alta_user_id' => auth()->id()
            ]);
            flash('Alta do paciente realizada com sucesso!')->success();
        } else {
            flash('Paciente não encontrado ou já recebeu alta.')->error();
        }

        return redirect()->route('listarAtendimentos.index');
    }

}
