@extends('layouts.app')

@section('title', 'Seja Bem-vindo ao sistema MEOWS ')
@section('conteudo')
    @auth
        @if(auth()->user()->isProfissional() || auth()->user()->isSuperAdmin())
    <!-- Content Row -->
    @include('layouts.cadsStatus')

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <!-- Gráfico 1: Distribuição por Status (Novo) -->
        <div class="col-xl-4 col-lg-4">
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

        <div class="col-xl-4 col-lg-4">
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

        <div class="col-xl-4 col-lg-4">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Evoluções por Mês</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="evolucoesBarChart"></canvas>
                    </div>
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
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts dos Gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{--    <script>--}}
{{--        // Gráfico de Pizza - Status--}}
{{--        const statusPieCtx = document.getElementById('statusPieChart');--}}
{{--        if (statusPieCtx) {--}}
{{--            new Chart(statusPieCtx, {--}}
{{--                type: 'pie',--}}
{{--                data: {--}}
{{--                    labels: {!! json_encode(array_keys($statusAtendimentos)) !!},--}}
{{--                    datasets: [{--}}
{{--                        data: {!! json_encode(array_values($statusAtendimentos)) !!},--}}
{{--                        backgroundColor: ['#1cc88a', '#f6c23e', '#e74a3b'],--}}
{{--                        // backgroundColor: ['#4e73df', '#1cc88a', '#e74a3b', '#f6c23e']--}}
{{--                        hoverBackgroundColor: ['#17a673', '#dda20a', '#be2617'],--}}
{{--                        hoverBorderColor: "rgba(234, 236, 244, 1)",--}}
{{--                    }],--}}
{{--                },--}}
{{--                options: {--}}
{{--                    maintainAspectRatio: false,--}}
{{--                    plugins: {--}}
{{--                        tooltip: {--}}
{{--                            enabled: true, // Certifique-se que está ativado--}}
{{--                            backgroundColor: "rgb(0,0,0)",--}}
{{--                            bodyFontColor: "#858796",--}}
{{--                            borderColor: '#dddfeb',--}}
{{--                            borderWidth: 1,--}}
{{--                            padding: 15,--}}
{{--                            displayColors: true, // Alterado para true para mostrar as cores--}}
{{--                            caretPadding: 10,--}}
{{--                            callbacks: {--}}
{{--                                title: (items) => `Total: ${items[0].dataset.data.reduce((a, b) => a + b)}`,--}}
{{--                                label: function(context) {--}}
{{--                                    const label = context.label || '';--}}
{{--                                    const value = context.raw || 0;--}}
{{--                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);--}}
{{--                                    const percentage = Math.round((value / total) * 100);--}}
{{--                                    return `${label}: ${value} (${percentage}%)`;--}}
{{--                                }--}}
{{--                            }--}}
{{--                        },--}}
{{--                        legend: {--}}
{{--                            display: true,--}}
{{--                            position: 'bottom',--}}
{{--                            labels: {--}}
{{--                                usePointStyle: true,--}}
{{--                                padding: 20--}}
{{--                            }--}}
{{--                        }--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}

{{--        // Gráfico de Barras - Evoluções por Mês--}}
{{--        const evolucoesBarCtx = document.getElementById('evolucoesBarChart');--}}
{{--        if (evolucoesBarCtx) {--}}
{{--            new Chart(evolucoesBarCtx, {--}}
{{--                type: 'bar',--}}
{{--                data: {--}}
{{--                    labels: Object.values(@json($nomesMeses)),--}}
{{--                    datasets: [{--}}
{{--                        label: "Evoluções",--}}
{{--                        backgroundColor: '#4e73df',--}}
{{--                        hoverBackgroundColor: '#2e59d9',--}}
{{--                        borderColor: '#4e73df',--}}
{{--                        data: Object.values(@json($dadosGrafico)),--}}
{{--                    }],--}}
{{--                },--}}
{{--                options: {--}}
{{--                    responsive: true,--}}
{{--                    maintainAspectRatio: false,--}}
{{--                    scales: {--}}
{{--                        x: {--}}
{{--                            grid: {--}}
{{--                                display: false,--}}
{{--                                drawBorder: false--}}
{{--                            }--}}
{{--                        },--}}
{{--                        y: {--}}
{{--                            beginAtZero: true,--}}
{{--                            ticks: {--}}
{{--                                precision: 0--}}
{{--                            },--}}
{{--                            grid: {--}}
{{--                                color: "rgb(234, 236, 244)",--}}
{{--                                drawBorder: false,--}}
{{--                                borderDash: [2],--}}
{{--                            }--}}
{{--                        }--}}
{{--                    },--}}
{{--                    plugins: {--}}
{{--                        legend: {--}}
{{--                            display: false--}}
{{--                        },--}}
{{--                        tooltip: {--}}
{{--                            callbacks: {--}}
{{--                                label: function(context) {--}}
{{--                                    return `Evoluções: ${context.raw}`;--}}
{{--                                }--}}
{{--                            }--}}
{{--                        }--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}
{{--    </script>--}}
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
                        position: 'right',
                    },
                    tooltip: {
                        callbacks: {
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
                    backgroundColor: ['#4e73df', '#f6c23e', '#858796'],
                }]
            },
            options: {
                maintainAspectRatio: false,
            }
        });
    </script>
@endpush
