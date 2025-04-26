@extends('layouts.app')

@section('title', 'Listando Evoluções')
@section('conteudo')
    @push('listandoAtendimentosCSS')
        <style>
            @media (max-width: 1280px) {
                .table thead {
                    display: none;
                }

                .table td {
                    display: flex;
                    justify-content: space-between;
                }

                .table tr {
                    display: block;
                }

                .table td:first-of-type {
                    font-weight: bold;
                    font-size: 1.2rem;
                    text-align: center;
                    display: block;
                }

                .table td:not(:first-of-type):before {
                    content: attr(data-title);
                    display: block;
                    font-weight: bold;
                }
            }
            .chart-area {
                background-color: #f8f9fa;
                border-radius: 5px;
                padding: 15px;
                margin-bottom: 20px;
                border: 1px solid #e3e6f0;
            }

            canvas {
                width: 100% !important;
                height: 400px !important;
            }
        </style>
    @endpush


    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Evolução dos Sinais Vitais de {{ $nomePaciente }}</h6>
                <div>
                    <a href="javascript:history.back()" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </a>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <div class="chart-area" style="position: relative; height: 500px;">
                        <canvas id="vitalSignsChart" height="500"></canvas>
                    </div>

                    <table class="table table-striped table-md">
                        <div class="table-responsive">
                            <thead>
                            <tr style='text-align:left;'>
                                <th>Data/Hora</th>
                                <th>FR (resp./min)</th>
                                <th>FC (bpm)</th>
                                <th>PAS (mmHg)</th>
                                <th>PAD (mmHg)</th>
                                <th>TEMP (°C)</th>
                                <th>SO (%)</th>
{{--                                <th>Frequência respiratória</th>--}}
{{--                                <th>Frequência cardíaca</th>--}}
{{--                                <th>Pressão arterial sistólica</th>--}}
{{--                                <th>Pressão arterial diastólica</th>--}}
{{--                                <th>Temperatura</th>--}}
{{--                                <th>Saturação de oxigênio</th>--}}
                                <th>Score Total</th>
{{--                                <th>Profissional</th>--}}
                                <th style='text-align:right;'>Ações</th>
                            </tr>
                            </thead>
                            <tbody style='text-align:left;'>
                            @foreach ($evolucoes as $evolucao)
                                <tr>
                                    <td data-title='Data/Hora'>{{ $evolucao->created_at->format('d/m/Y H:i') }}</td>
                                    <td data-title='Frequência respiratória'>{{ $evolucao->fr }}</td>
                                    <td data-title='Frequência cardíaca'>{{ $evolucao->fc }}</td>
                                    <td data-title='Pressão arterial sistólica'>{{ $evolucao->pas }}</td>
                                    <td data-title='Pressão arterial diastólica'>{{ $evolucao->pad }}</td>
                                    <td data-title='Temperatura'>{{ $evolucao->temp }}</td>
                                    <td data-title='Saturação de oxigênio'>{{ $evolucao->so }}</td>
                                    <td data-title='Score Total'>{{ $evolucao->grauDeterioracao }}</td>
{{--                                    <td data-title='Nome do Profissional'>{{ $evolucao->user->profissional->nome }}</td>--}}
                                    <td data-title="Ações" style='text-align:right;'>
                                        <a href='{{route('evolucao.relatorio', $evolucao->id) }}'><button type='button'
                                                                                                          class='btn btn-sm btn-primary' title="Visualizar evolução"><i class="fa-solid fa-eye"></i></button></a>
                                    </td>
                            @endforeach
                            </tbody>
                        </div>
                    </table>
                    @if ($evolucoes->isEmpty())
                        <p style="text-align: center;"> Não existe evoluções para está paciente</p>
                    @endif
                </div>
            </div>
            <!-- Paginação -->
            {{--            <div class="d-flex justify-content-center">--}}
            {{--                {{ $pacientes->links('pagination::bootstrap-5') }}--}}
            {{--            </div>--}}
        </div>
    </div>

@endsection

@push('listandoEvolucoesJS')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('vitalSignsChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [
                    {
                        label: 'FR (resp./min)',
                        data: @json($fr),
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.3,
                    },
                    {
                        label: 'FC (bpm)',
                        data: @json($fc),
                        borderColor: '#EF4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        tension: 0.3,
                    },
                    {
                        label: 'PAS (mmHg)',
                        data: @json($pas),
                        borderColor: '#10B981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    },
                    {
                        label: 'PAD (mmHg)',
                        data: @json($pad),
                        borderColor: '#F59E0B',
                        backgroundColor: 'rgba(245, 158, 11, 0.1)',
                    },
                    {
                        label: 'TEMP (°C)',
                        data: @json($temp),
                        borderColor: '#8B5CF6',
                        backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    },
                    {
                        label: 'SO (%)',
                        data: @json($so),
                        borderColor: '#EC4899',
{{--                        borderColor: @json($so.map(val => val < 95 ? '#EF4444' : '#10B981')), // Vermelho se < 95%--}}
                        backgroundColor: 'rgba(236, 72, 153, 0.1)',
                        borderDash: [5, 5],
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            afterBody: function(context) {
                                const dataIndex = context[0].dataIndex;
                                const evolucoes = @json($evolucoes);
                                return [
                                    `FR original: ${evolucoes[dataIndex].fr}`,
                                    `FC original: ${evolucoes[dataIndex].fc}`,
                                    `PAS original: ${evolucoes[dataIndex].pas}`,
                                    `PAD original: ${evolucoes[dataIndex].pad}`,
                                    `TEMP original: ${evolucoes[dataIndex].temp}`,
                                    `SO original: ${evolucoes[dataIndex].so}`
                                ];
                            }
                        }
                    },
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        title: {
                            display: true,
                            text: 'Valores'
                        }
                    }
                }
            }
        });
    </script>
@endpush

