<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atendimento;
use App\Models\Paciente;

class AtendimentoController extends Controller
{
    /**
     * Exibe a view para iniciar um novo atendimento.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $atendimentos = Atendimento::with(['paciente', 'entradaUser', 'altaUser'])
            ->latest()
            ->get();

        // Carrega apenas pacientes sem atendimento ativo, ordenados por nome
        $pacientes = Paciente::whereDoesntHave('atendimentos', function($query) {
            $query->whereNull('data_alta');
        })
            ->orderBy('nome')
            ->get();

        // Retorna a view com inicio dos atendimentos a pacientes
        return view(('admin.atendimentos.formIniciarAtendimento'), ['pacientes' => $pacientes, 'atendimentos' => $atendimentos]);

    }

    /**
     * Armazena um novo atendimento.
     *
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'paciente_id' => [
                'required',
                'exists:pacientes,id',
                function ($attribute, $value, $fail) {
                    // Verifica se existe atendimento em aberto para o paciente
                    $atendimentoAtivo = Atendimento::where('paciente_id', $value)
                        ->whereNull('data_alta')
                        ->exists();

                    if ($atendimentoAtivo) {
                        $fail('O paciente já está em atendimento.');
                    }
                }
            ],
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

        flash('Atendimento iniciado com sucesso!')->success();
        return redirect()->route('listarAtendimentos.index');

    }

    /**
     * Exibe a lista de atendimentos.
     *
     */
    public function list(Request $request)
    {
        $atendimentos = Atendimento::with([
            'paciente',
            'entradaUser.profissional',
            'evolucoes' => function($query) {
                $query->latest()
                    ->limit(1)
                    ->with('local'); // Carrega o relacionamento local da evolução
            }
        ])
            ->whereNull('data_alta')
            ->get();


        return view('admin.atendimentos.listarAtendimentos', [
            'atendimentos' => $atendimentos,
        ]);
    }

    /**
     * Exibe a view para registrar a alta do paciente.
     *
     */
    public function altaPaciente($atendimento_id)
    {
        // Verifica se o atendimento existe e se não tem data de alta
        $atendimento = Atendimento::where('id', $atendimento_id)
            ->whereNull('data_alta')
            ->first();

        if ($atendimento) {
            $now = now()->setTimezone('America/Sao_Paulo');
            $atendimento->update([
                'data_alta' => $now->toDateString(),
                'hora_saida' => $now->toTimeString(),
                'alta_user_id' => auth()->id()
            ]);
            flash('Alta do paciente realizada com sucesso!')->success();
        } else {
            flash('Paciente não encontrado ou já recebeu alta.')->error();
        }

        return redirect()->route('listarAtendimentos.index');
    }

}
