@extends('layouts.app')

@section('title', 'Relatório de Evolução')
@section('conteudo')
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary">Relatório de Evolução</h5>
                <a href="{{ route('evolucao.pdf', $evolucao->id) }}" class="btn btn-sm btn-danger">
                    <i class="fas fa-file-pdf"></i> Gerar PDF
                </a>
            </div>

            <div class="card-body">
                <div class="chart-area">
                    <!-- Cabeçalho com dados do paciente -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Dados do Paciente</h5>
                            <p><strong>Nome:</strong> {{ $evolucao->atendimento->paciente->nome }}</p>
                            <p><strong>Idade:</strong> {{ $evolucao->atendimento->paciente->idade  }} anos</p>
                            <p><strong>Local:</strong> {{ $evolucao->local->nome }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Profissional Responsável</h5>
                            <p><strong>Nome:</strong> {{ $evolucao->user->profissional->nome }}</p>
                            <p><strong>CRM/CRP:</strong> {{ $evolucao->user->profissional->registro }}</p>
                            <p><strong>Data:</strong> {{ $evolucao->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <!-- Parâmetros coletados -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th>Parâmetro</th>
                                <th>Valor Normal</th>
                                <th>Valor Coletado</th>
                                <th>Classificação</th>
                                <th>Pontuação MEOWS</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Frequência Cardíaca -->
                            <tr>
                                <td>Frequência Cardíaca (bpm)</td>
                                <td>60-99 bpm</td>
                                <td>{{ $evolucao->fc ?? '--' }}</td>
                                <td>
                                    @php
                                        $fc = (float)$evolucao->fc;
                                        $class = '--';
                                        $score = '--';
                                        $class = '';
                                        if($fc < 50) {
                                            $class = 'Crítico';
                                            $score = 3;
                                            $color = 'danger'; // vermelho
                                        } elseif($fc >= 50 && $fc <= 59) {
                                            $class = 'Leve';
                                            $score = 1;
                                            $color = 'success'; // amarelo
                                        } elseif($fc >= 60 && $fc <= 99) {
                                            $class = 'Normal';
                                            $score = 0;
                                            $color = 'primary'; // azul
                                        } elseif($fc >= 100 && $fc <= 109) {
                                            $class = 'Leve';
                                            $score = 1;
                                            $color = 'success'; // verde
                                        } elseif($fc >= 110 && $fc <= 129) {
                                            $class = 'Moderado';
                                            $score = 2;
                                            $color = 'warning'; // amarelo
                                        } elseif($fc >= 130) {
                                            $class = 'Crítico';
                                            $score = 3;
                                            $color = 'danger'; // vermelho
                                        } else {
                                            $class = '--';
                                            $score = '--';
                                            $color = 'secondary';
                                        }
                                    @endphp
                                    {{ $class }}
                                </td>
                                <td>
                    <span class="badge bg-{{ $color }}">
                        {{ $score }}
                    </span>
                                </td>
                            </tr>

                            <!-- Frequência Respiratória -->
                            <tr>
                                <td>Frequência Respiratória (rpm)</td>
                                <td>16-20 rpm</td>
                                <td>{{ $evolucao->fr ?? '--' }}</td>
                                <td>
                                    @php
                                        $fr = (float)$evolucao->fr;
                                        $class = '--';
                                        $score = '--';
                                        if($fr < 12) {
                                            $class = 'Crítico';
                                            $score = 3;
                                            $color = 'danger';
                                        } elseif($fr >= 12 && $fr <= 15) {
                                            $class = 'Moderado';
                                            $score = 2;
                                            $color = 'warning';
                                        } elseif($fr >= 16 && $fr <= 20) {
                                            $class = 'Normal';
                                            $score = 0;
                                            $color = 'primary';
                                        } elseif($fr >= 21 && $fr <= 24) {
                                            $class = 'Leve';
                                            $score = 1;
                                            $color = 'success';
                                        } elseif($fr >= 25 && $fr <= 30) {
                                            $class = 'Moderado';
                                            $score = 2;
                                            $color = 'warning';
                                        } elseif($fr > 30) {
                                            $class = 'Crítico';
                                            $score = 3;
                                            $color = 'danger';
                                        } else {
                                            $class = '--';
                                            $score = '--';
                                            $color = 'secondary';
                                        }
                                    @endphp
                                    {{ $class }}
                                </td>
                                <td>
                    <span class="badge bg-{{ $color }}">
                        {{ $score }}
                    </span>
                                </td>
                            </tr>

                            <!-- Pressão Arterial Sistólica -->
                            <tr>
                                <td>Pressão Arterial Sistólica (mmHg)</td>
                                <td>90-139 mmHg</td>
                                <td>{{ $evolucao->pas ?? '--' }}</td>
                                <td>
                                    @php
                                        $pas = (float)$evolucao->pas; // Garante que é número
                                        $class = '--';
                                        $score = '--';
                                        $color = 'secondary';

                                        if ($pas !== null) {
                                            if($pas < 70) {
                                                $class = 'Crítico';
                                                $score = 3;
                                                $color = 'danger';
                                            } elseif($pas >= 70 && $pas < 90) {
                                                $class = 'Moderado';
                                                $score = 2;
                                                $color = 'warning';
                                            } elseif($pas >= 90 && $pas <= 139) {
                                                $class = 'Normal';
                                                $score = 0;
                                                $color = 'primary';
                                            } elseif($pas > 139 && $pas <= 149) {
                                                $class = 'Leve';
                                                $score = 1;
                                                $color = 'success';
                                            } elseif($pas > 149 && $pas <= 159) {
                                                $class = 'Moderado';
                                                $score = 2;
                                                $color = 'warning';
                                            } elseif($pas >= 160) {
                                                $class = 'Crítico';
                                                $score = 3;
                                                $color = 'danger';
                                            }
                                        }
                                    @endphp
                                    {{ $class }}
                                </td>
                                <td>
                    <span class="badge bg-{{ $color }}">
                        {{ $score }}
                    </span>
                                </td>
                            </tr>

                            <!-- Pressão Arterial Diastólica -->
                            <tr>
                                <td>Pressão Arterial Diastólica (mmHg)</td>
                                <td>45-89 mmHg</td>
                                <td>{{ $evolucao->pad ?? '--' }}</td>
                                <td>
                                    @php
                                        $pad = (float)$evolucao->pad; // Garante conversão para número
                                        $class = '--';
                                        $score = '--';
                                        $color = 'secondary';

                                        if (!is_null($pad)) {
                                            if($pad < 45) {
                                                $class = 'Moderado';
                                                $score = 2;  // Corrigido para 2 (deve ser amarelo)
                                                $color = 'warning'; // amarelo
                                            } elseif($pad >= 45 && $pad <= 89) {
                                                $class = 'Normal';
                                                $score = 0;
                                                $color = 'primary'; // azul
                                            } elseif($pad >= 90 && $pad <= 99) {
                                                $class = 'Leve';
                                                $score = 1;
                                                $color = 'success'; // verde
                                            } elseif($pad >= 100 && $pad <= 109) {
                                                $class = 'Moderado';
                                                $score = 2;
                                                $color = 'warning'; // amarelo
                                            } elseif($pad >= 110) {
                                                $class = 'Crítico';
                                                $score = 3;
                                                $color = 'danger'; // vermelho
                                            }
                                        }
                                    @endphp
                                    {{ $class }}
                                </td>
                                <td>
                    <span class="badge bg-{{ $color }}">
                        {{ $score }}
                    </span>
                                </td>
                            </tr>

                            <!-- Temperatura -->
                            <tr>
                                <td>Temperatura (°C)</td>
                                <td>35-37.4 °C</td>
                                <td>{{ $evolucao->temp ?? '--' }}</td>
                                <td>
                                    @php
                                        $temp = (float)$evolucao->temp;
                                        $class = '--';
                                        $score = '--';
                                        if($temp < 35) {
                                            $class = 'Moderado';
                                            $score = 2;
                                            $color = 'warning';
                                        } elseif($temp >= 35 && $temp <= 37.4) {
                                            $class = 'Normal';
                                            $score = 0;
                                            $color = 'primary';
                                        } elseif($temp >= 37.5 && $temp <= 37.9) {
                                            $class = 'Leve';
                                            $score = 1;
                                            $color = 'success';
                                        } elseif($temp >= 38 && $temp <= 39) {
                                            $class = 'Moderado';
                                            $score = 2;
                                            $color = 'warning';
                                        } elseif($temp > 39) {
                                            $class = 'Crítico';
                                            $score = 3;
                                            $color = 'danger';
                                        } else {
                                            $class = '--';
                                            $score = '--';
                                            $color = 'secondary';
                                        }
                                    @endphp
                                    {{ $class }}
                                </td>
                                <td>
                    <span class="badge bg-{{ $color }}">
                        {{ $score }}
                    </span>
                                </td>
                            </tr>

                            <!-- Saturação de Oxigênio -->
                            <tr>
                                <td>Saturação de Oxigênio (%)</td>
                                <td>≥96%</td>
                                <td>{{ $evolucao->so ?? '--' }}</td>
                                <td>
                                    @php
                                        $soRaw = $evolucao->so ?? null;

                                    // 1. Tratamento dos casos textuais primeiro
                                    if ($soRaw === ">= 96" || $soRaw === "≥96") {
                                        $class = 'Normal';
                                        $score = 0;
                                        $color = 'primary';
                                    } elseif ($soRaw === "< 92" || $soRaw === "<92") {
                                        $class = 'Crítico';
                                        $score = 3;
                                        $color = 'danger';
                                    } elseif (strpos($soRaw, '92 - 95') !== false || strpos($soRaw, '92-95') !== false) {
                                        $class = 'Moderado';
                                        $score = 2;
                                        $color = 'warning';
                                    } else {
                                        // 2. Conversão para valores numéricos (caso não seja um texto pré-definido)
                                        $so = is_numeric(str_replace(',', '.', $soRaw)) ? (float)str_replace(',', '.', $soRaw) : null;

                                        if ($so !== null) {
                                            if ($so < 92) {
                                                $class = 'Crítico';
                                                $score = 3;
                                                $color = 'danger';
                                            } elseif ($so >= 92 && $so < 96) {
                                                $class = 'Moderado';
                                                $score = 2;
                                                $color = 'warning';
                                            } else { // >= 96
                                                $class = 'Normal';
                                                $score = 0;
                                                $color = 'primary';
                                            }
                                        } else {
                                            $class = '--';
                                            $score = '--';
                                            $color = 'secondary';
                                        }
                                    }
                                    @endphp
                                    {{ $class }}
                                </td>
                                <td>
                    <span class="badge bg-{{ $color }}">
                        {{ $score }}
                    </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Grau de Deterioração -->
                    <div class="mt-4">
                        <h5>Grau de Deterioração</h5>
                        <div class="p-3 rounded
                            @php
                                if ($evolucao->grauDeterioracao == 0) {
                                    echo 'bg-primary text-white'; // Azul - Sem risco
                                } elseif ($evolucao->grauDeterioracao >= 1 && $evolucao->grauDeterioracao <= 3) {
                                    echo 'bg-success text-white'; // Verde - Baixo risco
                                } elseif ($evolucao->grauDeterioracao >= 4 && $evolucao->grauDeterioracao <= 5) {
                                    echo 'bg-warning text-dark'; // Amarelo - Risco moderado
                                } elseif ($evolucao->grauDeterioracao >= 6) {
                                    echo 'bg-danger text-white'; // Vermelho - Alto risco
                                }
                            @endphp">
                            @php
                                if ($evolucao->grauDeterioracao == 0) {
                                    $avaliacao = 'Não há risco de deterioração';
//                                    $icon = '✓';
                                } elseif ($evolucao->grauDeterioracao >= 1 && $evolucao->grauDeterioracao <= 3) {
                                    $avaliacao = 'Baixo risco de deterioração';
//                                    $icon = '⚠️';
                                } elseif ($evolucao->grauDeterioracao >= 4 && $evolucao->grauDeterioracao <= 5) {
                                    $avaliacao = 'Risco moderado de deterioração';
//                                    $icon = '⚠️⚠️';
                                } elseif ($evolucao->grauDeterioracao >= 6) {
                                    $avaliacao = 'ALTO RISCO DE DETERIORAÇÃO';
//                                    $icon = '❗❗❗';
                                }
                            @endphp
{{--                            <span class="fw-bold">{{ $icon }} {{ $avaliacao }}</span>--}}
                            <span class="fw-bold"> {{ $avaliacao }}</span>
                            <span class="float-end">Score Total: {{ $evolucao->grauDeterioracao }}</span>
                        </div>
                    </div>

                    <!-- Observações -->
                    <div class="mt-4">
                        <h5>Observações</h5>
                        <div class="p-3 bg-light rounded">
                            {{ $evolucao->obs ?? 'Nenhuma observação registrada.' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mb-4">
            <a href="{{ route('evolucao.pdf', $evolucao->id) }}" class="btn btn-lg btn-danger">
                <i class="fas fa-file-pdf"></i> Baixar Relatório em PDF
            </a>
        </div>
    </div>
@endsection
