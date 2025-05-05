@extends('layouts.app')

@section('title', 'Seja Bem-vindo ao sistema: ' . Auth::user()->profissional->nome . ' - ' . Auth::user()->profissional->cargo->nome)

@section('conteudo')
    <script>
        setInterval(function () {
            location.reload();
        }, 30000); // 30000 milissegundos = 30 segundos
    </script>
    <style>
        /* Estilos para o card de atrasos */
        .card-border-left-danger {
            border-left: 0.25rem solid #e74a3b !important;
        }

        /* Lista de pacientes com atraso */
        #lista-atrasos {
            max-height: 300px;
            overflow-y: auto;
        }

        #lista-atrasos::-webkit-scrollbar {
            width: 5px;
        }

        #lista-atrasos::-webkit-scrollbar-thumb {
            background-color: #e74a3b;
            border-radius: 10px;
        }

        /* Item de paciente */
        .paciente-atrasado {
            transition: all 0.3s ease;
        }

        .paciente-atrasado:hover {
            background-color: #f8d7da !important;
        }

        /* Badge de tempo */
        .tempo-atraso {
            font-family: monospace;
            font-size: 0.85rem;
        }

        /* Estilo para os cronômetros */
        .tempo-espera-container, .tempo-atraso-container {
            font-family: monospace;
            font-size: 1.1rem;
        }

        /* Efeito de piscar para urgências */
        .blinking {
            animation: blink-animation 1s steps(2, start) infinite;
        }
        @keyframes blink-animation {
            to { visibility: hidden; }
        }
        .tempo-espera-container, .tempo-atraso-container {
            font-family: monospace;
        }
        .table-sm td, .table-sm th {
            padding: 0.5rem;
        }

        /* Cards com bordas coloridas */
        /*.border-danger { border-left: 4px solid #e74a3b !important; }*/
        /*.border-warning { border-left: 4px solid #f6c23e !important; }*/

        /* Badges nos cabeçalhos */
        .card-header .badge {
            font-size: 0.8rem;
            margin-left: 0.5rem;
        }
    </style>


    <!-- Content Row -->
    @include('layouts.cadsStatus')
    @auth
        @if(auth()->user()->isProfissional() || auth()->user()->isSuperAdmin())

    <!-- Content Row -->

    <div class="row">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>
                <div class="btn-group" role="group">
                    <a href="{{ request()->fullUrlWithQuery(['periodo' => 'hoje']) }}"
                       class="btn btn-sm {{ $filtro == 'hoje' ? 'btn-primary' : 'btn-outline-primary' }}">
                        Hoje
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['periodo' => 'semana']) }}"
                       class="btn btn-sm {{ $filtro == 'semana' ? 'btn-primary' : 'btn-outline-primary' }}">
                        Esta Semana
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['periodo' => 'mes']) }}"
                       class="btn btn-sm {{ $filtro == 'mes' ? 'btn-primary' : 'btn-outline-primary' }}">
                        Este Mês
                    </a>
                </div>
            </div>
        </div>
        <!-- Area Chart -->
        <!-- Gráfico 1: Distribuição por Status (Novo) -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Status dos Pacientes</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <div class="chart-pie">
                            <canvas id="deterioracaoChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Distribuição de Pacientes</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="statusPieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

{{--        <div class="col-xl-4 col-lg-4">--}}
{{--            <div class="card shadow mb-4">--}}
{{--                <!-- Card Header - Dropdown -->--}}
{{--                <div--}}
{{--                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">--}}
{{--                    <h6 class="m-0 font-weight-bold text-primary">Evoluções por Mês</h6>--}}
{{--                </div>--}}
{{--                <!-- Card Body -->--}}
{{--                <div class="card-body">--}}
{{--                    <div class="chart-area">--}}
{{--                        <canvas id="evolucoesBarChart"></canvas>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!-- Card de resumo -->

        <!-- Seção para pacientes sem avaliação -->
        <div class="col-xl-6 col-lg-6 mt-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-light">
                    <h6 class="m-0 font-weight-bold text-dark">
                        <i class="fas fa-clock"></i> Aguardando Avaliação
                        <span class="badge bg-secondary">{{ count($pacientesSemAvaliacao) }}</span>
                    </h6>
                </div>
                <div class="card-body">
                    @if($pacientesSemAvaliacao->isEmpty())
                        <div class="text-center py-4">
                            <i class="fas fa-check-circle fa-2x text-success mb-3"></i>
                            <p class="mb-0">Todos os pacientes foram avaliados</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <tbody>
                                @foreach($pacientesSemAvaliacao as $atendimento)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('storage/'.$atendimento->paciente->thumbnail) }}"
                                                     class="rounded-circle mr-3" style="object-fit: cover" width="40" height="40">
                                                <div>
                                                    <strong>{{ $atendimento->paciente->nome }}</strong><br>
                                                    <small>Entrada: {{ $atendimento->created_at->format('d/m H:i') }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="tempo-espera-container" data-registro="{{ $atendimento->created_at->format('Y-m-d H:i:s') }}">
                                                <h5 class="tempo-espera text-danger mb-0">00:00:00</h5>
                                                <small>Em espera</small>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('incluirEvolucao', $atendimento->id) }}"
                                               class="btn btn-sm btn-warning">
                                                <i class="fas fa-user-md"></i> Avaliar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Seção para intervenção imediata -->
        <div class="col-xl-6 col-lg-6 mt-4">
            <div class="card shadow mb-4 border-danger">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-danger text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-exclamation-triangle"></i> Intervenção Imediata
                        <span class="badge bg-white text-danger">{{ count($pacientesIntervencao) }}</span>
                    </h6>
                </div>
                <div class="card-body">
                    @if($pacientesIntervencao->isEmpty())
                        <div class="text-center py-4">
                            <i class="fas fa-check-circle fa-2x text-success mb-3"></i>
                            <p class="mb-0">Nenhum caso crítico no momento</p>
                        </div>
                    @else
                        @foreach($pacientesIntervencao as $atendimento)
                            <div class="alert alert-danger mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="alert-heading blinking mb-1">
                                            <i class="fas fa-exclamation-circle"></i> {{ $atendimento->paciente->nome }}
                                        </h5>
                                        <p class="mb-1">Grau: {{ $atendimento->ultimaEvolucao->grauDeterioracao }}</p>
                                        <small>Última avaliação: {{ $atendimento->ultimaEvolucao->created_at->format('d/m H:i') }}</small>
                                    </div>
                                    <div>
                                        <a href="{{ route('incluirEvolucao', $atendimento->id) }}"
                                           class="btn btn-light btn-sm text-danger">
                                            <i class="fas fa-plus-circle"></i> Nova Avaliação
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <!-- Seção para verificações atrasadas -->
        <div class="col-xl-12 col-lg-12 mt-4">
            <div class="card shadow mb-4 border-warning">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-warning">
                    <h6 class="m-0 font-weight-bold text-dark">
                        <i class="fas fa-clock"></i> Verificações Atrasadas
                        <span class="badge bg-danger text-white">{{ count($pacientesAtrasados) }}</span>
                    </h6>
                </div>
                <div class="card-body">
                    @if($pacientesAtrasados->isEmpty())
                        <div class="text-center py-4">
                            <i class="fas fa-check-circle fa-2x text-success mb-3"></i>
                            <p class="mb-0">Nenhuma verificação atrasada</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="thead-light">
                                <tr>
                                    <th>Paciente</th>
                                    <th>Status</th>
                                    <th>Última Verificação</th>
                                    <th>Tempo Atrasado</th>
                                    <th>Responsável</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pacientesAtrasados as $atendimento)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('storage/'.$atendimento->paciente->thumbnail) }}"
                                                     class="rounded-circle mr-2" width="30" height="30" style="object-fit: cover">
                                                {{ $atendimento->paciente->nome }}
                                            </div>
                                        </td>
                                        <td>
                                    <span class="badge {{ $atendimento->statusInfo['class'] }}">
                                        {{ $atendimento->statusInfo['text'] }}
                                    </span>
                                        </td>
                                        <td>
                                            {{ $atendimento->ultimaEvolucao->created_at->format('d/m H:i') }}
                                        </td>
                                        <td class="font-weight-bold text-danger blinking">
                                            <div class="tempo-atraso-container"
                                                 data-registro="{{ $atendimento->ultimaEvolucao->created_at->format('Y-m-d H:i:s') }}"
                                                 data-tempo="{{ $atendimento->statusInfo['tempo'] }}">
                                                00:00:00
                                            </div>
                                        </td>
                                        <td>
                                            {{ $atendimento->entradaUser->profissional->nome ?? 'N/A' }}
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('incluirEvolucao', $atendimento->id) }}"
                                               class="btn btn-sm btn-warning">
                                                <i class="fas fa-user-md"></i> Avaliar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
        @endif
    @endauth
    @auth
        @if(auth()->user()->isAdmin())
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Painel do Profissional</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                Teste
            </div>
        </div>
    </div>
        @endif
    @endauth
@endsection

@push('chartsIndexJS')
    <!-- Scripts dos Gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // 1. Gráfico de Deterioração (Novo)
        const deterioracaoCtx = document.getElementById('deterioracaoChart');
        new Chart(deterioracaoCtx, {
            type: 'doughnut',
            data: {
                labels: @json($chartDeterioracao['labels']),
                datasets: [{
                    data: @json($chartDeterioracao['data']),
                    backgroundColor: @json($chartDeterioracao['cores']),
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }]
            },
            options: {
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            title: (items) => `Total de Pacientes: ${items[0].dataset.data.reduce((a, b) => a + b)}`,
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b);
                                const percentage = Math.round((context.raw / total) * 100);
                                return `${context.label}: ${context.raw} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // 2. Gráfico de Barras - Evoluções por Mês (Existente)
        const evolucoesBarCtx = document.getElementById('evolucoesBarChart');
        new Chart(evolucoesBarCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                datasets: [{
                    label: "Evoluções",
                    data: @json(array_values($dadosCompletos)),
                    backgroundColor: '#4e73df',
                    hoverBackgroundColor: '#2e59d9',
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // 3. Gráfico de Pizza - Status Atendimentos (Existente)
        const statusPieCtx = document.getElementById('statusPieChart');
        new Chart(statusPieCtx, {
            type: 'pie',
            data: {
                labels: ['Com Alta', 'Internados', 'Não Atendidos'],
                datasets: [{
                    data: [@json($totalAltas), @json($totalInternados), @json($pacientesNaoAtendidos)],
                    backgroundColor: ['#1cc88a', '#e74a3b', '#858796'],
                }]
            },
            options: {
                maintainAspectRatio: false,
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cronômetro progressivo para pacientes sem avaliação
            document.querySelectorAll('.tempo-espera-container').forEach(container => {
                const registroTime = new Date(container.dataset.registro).getTime();
                const display = container.querySelector('.tempo-espera');

                function update() {
                    const now = new Date().getTime();
                    const diff = now - registroTime;

                    const hours = Math.floor(diff / (1000 * 60 * 60));
                    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                    display.textContent =
                        `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                }

                update();
                setInterval(update, 1000);
            });

            // Cronômetro para verificações atrasadas
            document.querySelectorAll('.tempo-atraso-container').forEach(container => {
                const registroTime = new Date(container.dataset.registro).getTime();
                const tempoVerificacao = parseInt(container.dataset.tempo);
                const endTime = registroTime + tempoVerificacao;

                function update() {
                    const now = new Date().getTime();
                    const diff = now - endTime;

                    if (diff > 0) {
                        const hours = Math.floor(diff / (1000 * 60 * 60));
                        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                        container.textContent =
                            `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                    }
                }

                update();
                setInterval(update, 1000);
            });
        });
    </script>
@endpush
