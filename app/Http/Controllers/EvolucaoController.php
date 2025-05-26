<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Hashids\Hashids;
use Illuminate\Http\Request;
use App\Models\Evolucao;
use App\Models\Atendimento;
use App\Models\Local;
use App\Models\User;


class EvolucaoController extends Controller
{
    /**
     * Apresenta a view de cadastro de evolução.
     */
    public function index(Atendimento $atendimento)
    {
        // Carrega o relacionamento com paciente e as evoluções (ordenadas por data decrescente)
        $atendimento->load(['paciente', 'evolucoes' => function($query) {
            $query->orderBy('created_at', 'desc');
        }]);

        $locals = Local::all()->sortBy('nome'); // Ordena os locais pelo nome

        // Verifica se existem evoluções anteriores
        $ultimoLocal = null;
        if ($atendimento->evolucoes->isNotEmpty()) {
            // Pega o local da última evolução
            $ultimoLocal = $atendimento->evolucoes->first()->local_id;
        }

        return view('admin.atendimentos.formAnamnese', [
            'atendimento' => $atendimento,
            'nome_paciente' => $atendimento->paciente->nome,
            'atendimento_id' => $atendimento->id,
            'locals' => $locals,
            'ultimo_local' => $ultimoLocal // Passa o ID do último local usado
        ]);
    }

    /**
     * Armazena os dados da evolução.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $data = $request->validate([
            'fc' => 'required',
            'fr' => 'required',
            'PA' => 'required',
            'PAD' => 'required',
            'Temp' => 'required',
            'SO' => 'required',
            'obs' => 'nullable|string|max:10000',
            'local_id' => 'required|exists:locals,id',
        ], [
            // Mensagens de erro personalizadas
            'fc.required' => 'Selecione uma opção para a frequência cardíaca.',
            'fr.required' => 'Selecione uma opção para a frequência respiratória.',
            'PA.required' => 'Selecione uma opção para a pressão arterial sistólica.',
            'PAD.required' => 'Selecione uma opção para a pressão arterial diastólica.',
            'Temp.required' => 'Selecione uma opção para a temperatura.',
            'SO.required' => 'Selecione uma opção para a saturação de oxigênio.',
            'local_id.required' => 'Selecione um local para a evolução.',
        ]);

        // Recebe os dados do formulário
        $fc = $request->input('fc');
        $fr = $request->input('fr');
        $pas = $request->input('PA');
        $pad = $request->input('PAD');
        $temp = $request->input('Temp');
        // $avpu = $request->input('condicaoNeurologica');
        $so = $request->input('SO');
        // $diurese = $request->input('diurese');
        $local_id = $request->input('local_id');

        $scores = [
            'fc' => 0,
            'fr' => 0,
            'pas' => 0,
            'pad' => 0,
            'temp' => 0,
            // 'condicaoNeurologica' => 0,
            'so' => 0,
            // 'diurese' => 0,
        ];

        // Inicializa a pontuação total
        $scoresTotal = 0;

        // Calcula a pontuação total
        // Frequência Cardíaca
        if ($fc == 1){
            $scores['fc'] = 3;
            $fc = '< 50';
        } elseif ($fc == 2){
            $scores['fc'] = 1;
            $fc = '50 - 59';
        } elseif ($fc == 3){
            $scores['fc'] = 0;
            $fc = '60 - 99';
        } elseif ($fc == 4){
            $scores['fc'] = 1;
            $fc = '100 - 109';
        } elseif ($fc == 5){
            $scores['fc'] = 2;
            $fc = '110 - 129';
        } elseif ($fc == 6){
            $scores['fc'] = 3;
            $fc = '> 130';
        }

        // Frequência Respiratória
        if ($fr == 1){
            $scores['fr'] = 3;
            $fr = '<= 12';
        } elseif ($fr == 2){
            $scores['fr'] = 2;
            $fr = '13 - 15';
        } elseif ($fr == 3){
            $scores['fr'] = 0;
            $fr = '16 - 20';
        } elseif ($fr == 4){
            $scores['fr'] = 1;
            $fr = '21 - 24';
        } elseif ($fr == 5){
            $scores['fr'] = 2;
            $fr = '25 - 30';
        } elseif ($fr == 6){
            $scores['fr'] = 3;
            $fr = '>= 31';
        }

        // Pressão Arterial Sistólica
        if ($pas == 1){
            $scores['pas'] = 3;
            $pas = '< 70';
        } elseif ($pas == 2){
            $scores['pas'] = 2;
            $pas = '70 - 89';
        } elseif ($pas == 3){
            $scores['pas'] = 0;
            $pas = '90 - 139';
        } elseif ($pas == 4){
            $scores['pas'] = 1;
            $pas = '140 - 149';
        } elseif ($pas == 5){
            $scores['pas'] = 2;
            $pas = '150 - 159';
        } elseif ($pas == 6){
            $scores['pas'] = 3;
            $pas = '>= 160';
        }

        // Pressão Arterial Diastólica
        if ($pad == 1){
            $scores['pad'] = 2;
            $pad = '< 45';
        } elseif ($pad == 2){
            $scores['pad'] = 0;
            $pad = '45 - 89';
        } elseif ($pad == 3){
            $scores['pad'] = 1;
            $pad = '90 - 99';
        } elseif ($pad == 4){
            $scores['pad'] = 2;
            $pad = '100 - 109';
        } elseif ($pad == 5){
            $scores['pad'] = 3;
            $pad = '>= 110';
        }

        // Temperatura
        if ($temp == 1){
            $scores['temp'] = 2;
            $temp = '< 35';
        } elseif ($temp == 2){
            $scores['temp'] = 0;
            $temp = '35 - 37.4';
        } elseif ($temp == 3){
            $scores['temp'] = 1;
            $temp = '37.5 - 37.9';
        } elseif ($temp == 4){
            $scores['temp'] = 2;
            $temp = '38 - 38.9';
        } elseif ($temp == 5){
            $scores['temp'] = 3;
            $temp = '>= 39.0';
        }

        // Saturação de Oxigênio
        if ($so == 1){
            $scores['so'] = 3;
            $so = '< 92';
        } elseif ($so == 2){
            $scores['so'] = 2;
            $so = '92 - 95';
        } elseif ($so == 3){
            $scores['so'] = 0;
            $so = '>= 96';
        }

        $scoresTotal = $scores['fc'] + $scores['fr'] + $scores['pas'] + $scores['pad'] + $scores['temp'] + $scores['so'];

        // Avaliação do risco de deterioração
        $evolucao = new Evolucao();
        $evolucao->fc = $fc;
        $evolucao->fr = $fr;
        $evolucao->pas = $pas;
        $evolucao->pad = $pad;
        $evolucao->temp = $temp;
        $evolucao->so = $so;
        $evolucao->local_id = $local_id;
        $evolucao->grauDeterioracao = $scoresTotal;
        $evolucao->atendimento_id = $request->input('atendimento_id');
        $evolucao->obs = $request->input('obs');
        $evolucao->user_id = auth()->id();
        $evolucao->save();

        flash('Anamnese da Paciente cadastrada com sucesso!')->success();
        return redirect()->route('evolucao.relatorio', $evolucao->id);

    }

    /**
     * Mostra o relatório da evolução.
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function relatorio($id)
    {
        $evolucao = Evolucao::with(['atendimento.paciente', 'local', 'user','avaliacao'])
            ->whereHas('atendimento') // Só traz se tiver atendimento relacionado
            ->findOrFail($id);
        $evolucao->atendimento->paciente->idade = Carbon::parse($evolucao->atendimento->paciente->data_nascimento)->age;

        // Parâmetros normais para comparação
        $parametrosNormais = [
            'fc' => ['min' => 60, 'max' => 99, 'label' => 'Frequência Cardíaca (bpm)'],
            'fr' => ['min' => 16, 'max' => 20, 'label' => 'Frequência Respiratória (rpm)'],
            'pas' => ['min' => 90, 'max' => 139, 'label' => 'Pressão Arterial Sistólica (mmHg)'],
            'pad' => ['min' => 45, 'max' => 89, 'label' => 'Pressão Arterial Diastólica (mmHg)'],
            'temp' => ['min' => 35, 'max' => 37.4, 'label' => 'Temperatura (°C)'],
            'so' => ['min' => 96, 'max' => 100, 'label' => 'Saturação de Oxigênio (%)']
        ];

        return view('admin.atendimentos.relatorioScorePaciente', compact('evolucao', 'parametrosNormais'));
    }

    /**
     * Gera o PDF da evolução.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function gerarPdf($id)
    {
        $evolucao = Evolucao::with(['atendimento.paciente', 'local', 'user'])
            ->whereHas('atendimento') // Só traz se tiver atendimento relacionado
            ->findOrFail($id);
        $evolucao->atendimento->paciente->idade = Carbon::parse($evolucao->atendimento->paciente->data_nascimento)->age;

        $parametrosNormais = [
            'fc' => ['min' => 60, 'max' => 99, 'label' => 'Frequência Cardíaca (bpm)'],
            'fr' => ['min' => 16, 'max' => 20, 'label' => 'Frequência Respiratória (rpm)'],
            'pas' => ['min' => 90, 'max' => 139, 'label' => 'Pressão Arterial Sistólica (mmHg)'],
            'pad' => ['min' => 45, 'max' => 89, 'label' => 'Pressão Arterial Diastólica (mmHg)'],
            'temp' => ['min' => 35, 'max' => 37.4, 'label' => 'Temperatura (°C)'],
            'so' => ['min' => 96, 'max' => 100, 'label' => 'Saturação de Oxigênio (%)']
        ];

        $pdf = PDF::loadView('admin.atendimentos.gerarPdfScoreParturiente', compact('evolucao', 'parametrosNormais'))
            ->setPaper('a4', 'portrait')
            ->setOption('margin-top', '5mm')
            ->setOption('margin-bottom', '5mm')
            ->setOption('margin-left', '20mm')
            ->setOption('margin-right', '20mm');

//        return $pdf->download('evolucao_'.$evolucao->atendimento->paciente->nome.'_'.now()->format('d-m-Y').'.pdf');
        return $pdf->download('evolucao_'.$evolucao->atendimento->paciente->nome.'_'.$evolucao->created_at->format('dmY_H-i').'.pdf');
    }

    /**
     * Mostra a última evolução do atendimento.
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function ultimaEvolucao($id)
    {
        $evolucao = Evolucao::with(['atendimento.paciente', 'local', 'user'])
            ->where('atendimento_id', $id)  // Filtra pelo ID do atendimento
            ->latest('created_at')  // Ordena pela data de criação (mais recente primeiro)
            ->first();  // Pega o primeiro registro (que será o mais recente)


        $evolucao->atendimento->paciente->idade = Carbon::parse($evolucao->atendimento->paciente->data_nascimento)->age;
        $evolucao->grauDeterioracao;
        if (!$evolucao) {
            return back()->with('error', 'Nenhuma evolução encontrada para este atendimento');
        }

        $parametrosNormais = [
            'fc' => ['min' => 60, 'max' => 99, 'label' => 'Frequência Cardíaca (bpm)'],
            'fr' => ['min' => 16, 'max' => 20, 'label' => 'Frequência Respiratória (rpm)'],
            'pas' => ['min' => 90, 'max' => 139, 'label' => 'Pressão Arterial Sistólica (mmHg)'],
            'pad' => ['min' => 45, 'max' => 89, 'label' => 'Pressão Arterial Diastólica (mmHg)'],
            'temp' => ['min' => 35, 'max' => 37.4, 'label' => 'Temperatura (°C)'],
            'so' => ['min' => 96, 'max' => 100, 'label' => 'Saturação de Oxigênio (%)']
        ];

        return view('admin.atendimentos.relatorioScorePaciente', compact('evolucao', 'parametrosNormais'));
    }

    /**
     * Mostra a view com a lista de evoluções.
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function listarEvolucoes($id)
    {
        $evolucoes = Evolucao::with(['atendimento.paciente', 'local', 'user'])
            ->where('atendimento_id', $id)  // Filtra pelo ID do atendimento
            ->latest('created_at')  // Ordena pela data de criação (mais recente primeiro)
            ->get();  // Pega todos os registros

        return view('admin.atendimentos.listarEvolucoes', compact('evolucoes'));
    }

    // Mostra a view com o gráfico
    public function mostrarGrafico($atendimento_id)
    {
        // Busca as evoluções + nome do paciente (com eager loading)
        $evolucoes = Evolucao::with(['atendimento.paciente'])
            ->where('atendimento_id', $atendimento_id)
            ->orderBy('created_at')
            ->get();

        // Nome do paciente (acessível via relacionamento)
        $nomePaciente = $evolucoes->first()->atendimento->paciente->nome ?? 'Paciente não encontrado';

        // Garanta que $labels seja gerado corretamente
        $labels = $evolucoes->map(function ($evolucao) {
            return $evolucao->created_at->format('d/m H:i');
        });

        // Processamento dos dados para o gráfico (métodos auxiliares)
        $fr = $this->extractNumbers($evolucoes->pluck('fr'));
        $fc = $this->extractFirstNumbers($evolucoes->pluck('fc'));
        $pas = $this->extractNumbers($evolucoes->pluck('pas'));
        $pad = $this->extractNumbers($evolucoes->pluck('pad'));
        $temp = $this->extractNumbers($evolucoes->pluck('temp'));
        $so = $this->extractNumbers($evolucoes->pluck('so'));

        // Debug: Verifique se $labels está populado
//         dd($labels); // Descomente para testar

        return view('admin.atendimentos.listarEvolucoes', [
            'evolucoes' => $evolucoes,
            'labels'    => $labels, // Certifique-se de que está sendo passado
            'fr'        => $fr,
            'fc'        => $fc,
            'pas'       => $pas,
            'pad'       => $pad,
            'temp'      => $temp,
            'so'        => $so,
            'nomePaciente' => $nomePaciente,
        ]);
    }

    // Extrai o primeiro número de cada valor (ex: "100-109" → 100)
    private function extractFirstNumbers($values)
    {
        return $values->map(function ($value) {
            if (is_numeric($value)) return (float) $value;
            preg_match('/\d+/', $value, $matches); // Pega o primeiro número
            return isset($matches[0]) ? (float) $matches[0] : null;
        });
    }

    // Extrai números (incluindo decimais) de cada valor (ex: "36.5-37" → 36.5)
    private function extractNumbers($values)
    {
        return $values->map(function ($value) {
            if (is_numeric($value)) return (float) $value;
            preg_match('/\d+\.?\d*/', $value, $matches); // Pega números com ou sem decimal
            return isset($matches[0]) ? (float) $matches[0] : null;
        });
    }

    private function getFiltroDatas($filtro)
    {
        return match($filtro) {
            'hoje' => [
                'inicio' => now()->startOfDay(),
                'fim' => now()->endOfDay()
            ],
            'semana' => [
                'inicio' => now()->startOfWeek(),
                'fim' => now()->endOfWeek()
            ],
            'mes' => [
                'inicio' => now()->startOfMonth(),
                'fim' => now()->endOfMonth()
            ],
            default => [
                'inicio' => now()->subDays(30),
                'fim' => now()
            ]
        };
    }

    //teste de classificação de risco
    public function viewPrincipal(Request $request)
    {
        // Obter o filtro do request ou usar 'hoje' como padrão
        $filtro = $request->input('periodo', 'hoje');

        // Configurar as datas com base no filtro
        $filtroData = $this->getFiltroDatas($filtro);

        // Consultas principais (mantidas como estão)
        $totalAtendimentos = Atendimento::whereBetween('created_at', [$filtroData['inicio'], $filtroData['fim']])->count();
        $totalAltas = Atendimento::whereNotNull('data_alta')->whereBetween('data_alta', [$filtroData['inicio'], $filtroData['fim']])->count();

        // Total de Usuários Ativos
        $totalUsersAtivos = User::where('status', 'ativo')->count();
        // Total de Usuários Inativos
        $totalUsersInativos = User::where('status', 'inativo')->count();

        $totalInternados = Atendimento::whereNull('data_alta')
            ->join('evolucaos', 'atendimentos.id', '=', 'evolucaos.atendimento_id')
            ->whereBetween('evolucaos.created_at', [$filtroData['inicio'], $filtroData['fim']])
            ->distinct('atendimentos.id')
            ->count('atendimentos.id');

        $pacientesNaoAtendidos = Atendimento::whereDoesntHave('evolucoes')
            ->whereNull('data_alta')
            ->whereBetween('created_at', [$filtroData['inicio'], $filtroData['fim']])
            ->count();

        // Gráfico por mês
        $evolucoesPorMes = Evolucao::selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
            ->whereBetween('created_at', [$filtroData['inicio'], $filtroData['fim']])
            ->groupBy('mes')
            ->orderBy('mes')
            ->get()
            ->pluck('total', 'mes');

        // Preenche meses faltantes
        $dadosCompletos = [];
        for ($mes = 1; $mes <= 12; $mes++) {
            $dadosCompletos[$mes] = $evolucoesPorMes->has($mes) ? $evolucoesPorMes[$mes] : 0;
        }

        // Gráfico de deterioração
        $deterioracaoData = Atendimento::with('ultimaEvolucao')
            ->selectRaw('
            CASE
                WHEN evolucaos.grauDeterioracao IS NULL THEN "Sem avaliação"
                WHEN evolucaos.grauDeterioracao BETWEEN 0 AND 2 THEN "Sem risco"
                WHEN evolucaos.grauDeterioracao BETWEEN 3 AND 4 THEN "Baixo risco"
                WHEN evolucaos.grauDeterioracao BETWEEN 5 AND 6 THEN "Risco moderado"
                ELSE "Risco alto"
            END as status,
            COUNT(*) as total
        ')
            ->leftJoin('evolucaos', function($join) {
                $join->on('atendimentos.id', '=', 'evolucaos.atendimento_id')
                    ->whereRaw('evolucaos.id = (
                    SELECT id FROM evolucaos
                    WHERE atendimento_id = atendimentos.id
                    ORDER BY created_at DESC
                    LIMIT 1
                )');
            })
            ->whereNull('data_alta')
            ->groupBy('status')
            ->orderByRaw('
            CASE status
                WHEN "Risco alto" THEN 1
                WHEN "Risco moderado" THEN 2
                WHEN "Baixo risco" THEN 3
                WHEN "Sem risco" THEN 4
                ELSE 5
            END
        ')
            ->get();

        $chartDeterioracao = [
            'labels' => $deterioracaoData->pluck('status'),
            'data' => $deterioracaoData->pluck('total'),
            'cores' => ['#e74a3b', '#f6c23e', '#4e73df', '#1cc88a', '#e0e0e0']
        ];



        // Consulta para atendimentos ativos (sem alta) - SEM FILTRO DE DATA
        $atendimentos = Atendimento::with([
            'paciente',
            'ultimaEvolucao',
            'entradaUser.profissional'
        ])
            ->whereNull('data_alta')
//            ->whereBetween('created_at', [$filtroData['inicio'], $filtroData['fim']])
            ->get()
            ->map(function ($atendimento) {
                $atendimento->load('evolucoes'); // Carrega todas evoluções
                $atendimento->statusInfo = $atendimento->determinarStatus();
                return $atendimento;
            });

        // Classificar atendimentos por tipo
        $pacientesSemAvaliacao = $atendimentos->filter(function ($atendimento) {
            return $atendimento->evolucoes->isEmpty();
        });

        $pacientesIntervencao = $atendimentos->filter(function ($atendimento) {
            return $atendimento->ultimaEvolucao &&
                $atendimento->ultimaEvolucao->grauDeterioracao >= 7;
        });

        $pacientesAtrasados = $atendimentos->filter(function ($atendimento) {
            return $atendimento->tempoAtrasoVerificacao() > 0;
        });


        return view('index', compact(
            'totalAtendimentos',
            'totalAltas',
            'totalInternados',
            'pacientesNaoAtendidos',
            'dadosCompletos',
            'chartDeterioracao',
            'pacientesAtrasados',
            'pacientesSemAvaliacao',
            'pacientesIntervencao',
            'filtro',
            'totalUsersAtivos',
            'totalUsersInativos',
        ));
    }


    // Método de classificação de risco
    private function classificarRisco($grau)
    {
        return match(true) {
            $grau === null => 'Sem avaliação',
            $grau >= 7 => 'Risco alto',
            $grau >= 5 => 'Risco moderado',
            $grau >= 3 => 'Baixo risco',
            $grau >= 0 => 'Sem risco',
            default => 'Sem avaliação'
        };
    }

    // Método para formatar o tempo
    // Recebe o tempo em minutos e retorna uma string formatada
    // Exemplo: 1440 minutos retorna "1 dia"
    private function formatarTempo($minutos)
    {
        if ($minutos >= 1440) return round($minutos/1440) . ' dias';
        if ($minutos >= 60) return round($minutos/60) . ' horas';
        return $minutos . ' minutos';
    }

    /*
     * Método para salvar a avaliação
     * Recebe o ID da evolução e os dados da avaliação
     * Se o ID da avaliação for passado, atualiza a avaliação existente
     * Caso contrário, cria uma nova avaliação
     * Retorna uma mensagem de sucesso e redireciona para o relatório da evolução
     */
    public function salvarAvaliacao(Request $request, $evolucaoId)
    {
        $request->validate([
            'avaliacao' => 'required|string|min:10',
            'conduta' => 'required|string|min:10',
        ]);

        $evolucao = Evolucao::findOrFail($evolucaoId);

        if($request->has('avaliacao_id')) {
            // Atualização
            $avaliacao = Avaliacao::findOrFail($request->avaliacao_id);
            $avaliacao->update([
                'avaliacao' => $request->avaliacao,
                'conduta' => $request->conduta
            ]);
        } else {
            // Criação
            Avaliacao::create([
                'evolucao_id' => $evolucao->id,
                'avaliacao' => $request->avaliacao,
                'conduta' => $request->conduta,
                'profissionals_id' => auth()->user()->profissional->id, // Adicione esta linha
                'user_id' => auth()->id()
            ]);
        }

        flash('Avaliação registrada com sucesso!')->success();
        return redirect()->route('evolucao.relatorio', $evolucao->id);
    }
}
