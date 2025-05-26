@extends('layouts.app')

@section('title', 'Relatório de Evolução')
@section('conteudo')
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary">Relatório de Evolução</h5>
{{--                <div class="d-flex">--}}
{{--                    <a href="{{route('listarAtendimentos.index')}}" class="btn btn-sm btn-secondary mr-2">--}}
{{--                        <i class="fas fa-arrow-left"></i> Voltar--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('evolucao.pdf', $evolucao->id) }}" class="btn btn-sm btn-danger">--}}
{{--                        <i class="fas fa-file-pdf"></i> Gerar PDF--}}
{{--                    </a>--}}
{{--                </div>--}}
                <div class="d-flex">
                    <a href="{{route('listarAtendimentos.index')}}" class="btn btn-sm btn-secondary mr-2">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </a>
{{--                    @if(!$evolucao->avaliacao)--}}
{{--                        <button id="btnAvaliar" class="btn btn-sm btn-success mr-2">--}}
{{--                            <i class="fas fa-clipboard-check"></i> Avaliar--}}
{{--                        </button>--}}
{{--                    @endif--}}
                    <a href="{{ route('evolucao.pdf', $evolucao->id) }}" class="btn btn-sm btn-danger">
                        <i class="fas fa-file-pdf"></i> Gerar PDF
                    </a>
                </div>
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
                                if ($evolucao->grauDeterioracao >= 0 && $evolucao->grauDeterioracao <= 2) {
                                    echo 'bg-primary text-white'; // Azul - Sem risco
                                } elseif ($evolucao->grauDeterioracao >= 3 && $evolucao->grauDeterioracao <= 4) {
                                    echo 'bg-success text-white'; // Verde - Baixo risco
                                } elseif ($evolucao->grauDeterioracao >= 5 && $evolucao->grauDeterioracao <= 6) {
                                    echo 'bg-warning text-dark'; // Amarelo - Risco moderado
                                } elseif ($evolucao->grauDeterioracao >= 7) {
                                    echo 'bg-danger text-white'; // Vermelho - Alto risco
                                }
                            @endphp">
                            @php
                                if ($evolucao->grauDeterioracao >= 0 && $evolucao->grauDeterioracao <= 2) {
                                    $avaliacao = 'Não há risco de deterioração';
//                                    $icon = '✓';
                                } elseif ($evolucao->grauDeterioracao >= 3 && $evolucao->grauDeterioracao <= 4) {
                                    $avaliacao = 'Baixo risco de deterioração';
//                                    $icon = '⚠️';
                                } elseif ($evolucao->grauDeterioracao >= 5 && $evolucao->grauDeterioracao <= 6) {
                                    $avaliacao = 'Risco moderado de deterioração';
//                                    $icon = '⚠️⚠️';
                                } elseif ($evolucao->grauDeterioracao >= 7) {
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

        <!-- Seção de Avaliação -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-primary text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-clipboard-check"></i> Avaliação Clínica
                </h6>
                @if(!$evolucao->avaliacao)
                    <button id="btnMostrarForm" class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i> Adicionar Avaliação
                    </button>
                @endif
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Visualização da Avaliação -->
                <div id="avaliacaoView" style="{{ $evolucao->avaliacao ? 'display:block' : 'display:none' }}">
                    @if($evolucao->avaliacao)
                        <div class="form-group">
                            <label><strong>Avaliação:</strong></label>
                            <div class="p-3 bg-light rounded">
                                {!! nl2br(e($evolucao->avaliacao->avaliacao)) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label><strong>Prescrição:</strong></label>
                            <div class="p-3 bg-light rounded">
                                {!! nl2br(e($evolucao->avaliacao->conduta)) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label><strong>Profissional:</strong></label>
                            <div class="p-3 bg-light rounded">
                                {!! nl2br(e($evolucao->user->profissional->nome .  " - ". $evolucao->user->profissional->cargo->nome)) !!}
                            </div>
                        </div>

                        <div class="text-right">
{{--                            <button id="btnEditarAvaliacao" class="btn btn-warning">--}}
{{--                                <i class="fas fa-edit"></i> Editar Avaliação--}}
{{--                            </button>--}}
                        </div>
                    @else
                        <p class="text-muted">Nenhuma avaliação registrada ainda.</p>
                    @endif
                </div>

                <!-- Formulário de Avaliação - SEMPRE VISÍVEL (mas oculto inicialmente) -->
                <div id="avaliacaoForm" style="display: none;">
                    <form method="POST" action="{{ route('avaliacoes.store', $evolucao->id) }}">
                        @csrf
                        @if($evolucao->avaliacao)
                            <input type="hidden" name="avaliacao_id" value="{{ $evolucao->avaliacao->id }}">
                        @endif

                        <div class="form-group">
                            <label for="textoAvaliacao">Avaliação Clínica <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="textoAvaliacao" name="avaliacao" rows="5" required>{{ $evolucao->avaliacao->avaliacao ?? old('avaliacao') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="textoConduta">Prescrição <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="textoConduta" name="conduta" rows="5" required>{{ $evolucao->avaliacao->conduta ?? old('conduta') }}</textarea>
                        </div>

                        <div class="text-right">
                            <button type="button" id="btnCancelar" class="btn btn-secondary mr-2">
                                <i class="fas fa-times"></i> Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ $evolucao->avaliacao ? 'Atualizar' : 'Salvar' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="text-center mb-4">
            <a href="{{ route('evolucao.pdf', $evolucao->id) }}" class="btn btn-lg btn-danger">
                <i class="fas fa-file-pdf"></i> Baixar Relatório em PDF
            </a>
        </div>
    </div>
    @push('avaliacaoJS')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const btnMostrarForm = document.getElementById('btnMostrarForm');
                const btnEditar = document.getElementById('btnEditarAvaliacao');
                const btnCancelar = document.getElementById('btnCancelar');
                const avaliacaoView = document.getElementById('avaliacaoView');
                const avaliacaoForm = document.getElementById('avaliacaoForm');

                // Configuração inicial
                @if(!$evolucao->avaliacao)
                    avaliacaoForm.style.display = 'none';
                avaliacaoView.style.display = 'block';
                @else
                    avaliacaoForm.style.display = 'none';
                avaliacaoView.style.display = 'block';
                @endif

                // Mostrar formulário para nova avaliação
                if(btnMostrarForm) {
                    btnMostrarForm.addEventListener('click', function() {
                        avaliacaoView.style.display = 'none';
                        avaliacaoForm.style.display = 'block';
                        this.style.display = 'none';
                    });
                }

                // Mostrar formulário para edição
                if(btnEditar) {
                    btnEditar.addEventListener('click', function() {
                        avaliacaoView.style.display = 'none';
                        avaliacaoForm.style.display = 'block';
                    });
                }

                // Cancelar edição/criação
                if(btnCancelar) {
                    btnCancelar.addEventListener('click', function() {
                        avaliacaoForm.style.display = 'none';
                        avaliacaoView.style.display = 'block';
                        if(btnMostrarForm) btnMostrarForm.style.display = 'block';
                    });
                }
            });
        </script>
    @endpush
@endsection
