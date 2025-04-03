@extends('layouts.app')

@section('title', 'Listagem de Pacientes')
@section('conteudo')
    <style>
        @media (max-width: 767px) {
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

            //estilo para data gestação
        .gestacao-cell {
            font-family: 'Segoe UI', sans-serif;
            font-size: 0.9rem;
        }

            .badge {
                padding: 0.35em 0.65em;
                font-weight: 500;
                border-radius: 0.25rem;
                white-space: nowrap;
            }

            .bg-primary {
                background-color: #0d6efd;
                color: white;
            }

            .bg-success {
                background-color: #198754;
                color: white;
            }

            .bg-danger {
                background-color: #dc3545;
                color: white;
            }

            .bg-info {
                background-color: #0dcaf0;
                color: #000;
            }
        }
    </style>

    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Listagem de Pacientes</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">

                    <table class="table table-striped table-md">
                        <div class="table-responsive">
                            <thead>
                            <tr style='text-align:center;'>
                                <th>Foto</th>
                                <th>Nome</th>
                                <th>Data de Nascimento</th>
                                <th>Data de Gestação</th>
                                <th>Tempo de Gestação</th>
                                <th style='text-align:right;'>Ações</th>
                            </tr>
                            </thead>
                            <tbody style='text-align:center;'>
                            @foreach ($pacientes as $paciente)
                                <tr>
                                    <td data-title='Foto'><img class="img-profile rounded-circle" src="storage/{{ $paciente->thumbnail }}" style="width: 60px; height: 60px; object-fit: cover; object-position: center center; /* Foco no centro */"></td>
                                    <td class='fw-bold'>{{ $paciente->nome }}</td>
                                    <td data-title='Data de Nascimento'>{{ date('d/m/Y', strtotime($paciente->dataNascimento)) }}</td>
                                    <td data-title='Data de Gestação'>{{ date('d/m/Y', strtotime($paciente->data_gestacao)) }}</td>
                                    <td data-title='Tempo de Gestação'>
                                        @php $gestacao = $paciente->formatarTempoGestacao(); @endphp
                                        <span class="badge {{ $gestacao['badge'] }}">
                                            {{ $gestacao['texto'] }}
                                        </span>
{{--                                        @php--}}
{{--                                            // Configurações iniciais--}}
{{--                                            $dataGestacao = \Carbon\Carbon::parse($paciente->data_gestacao);--}}
{{--                                            $dataAtual = now();--}}
{{--                                            $diasTotal = $dataGestacao->diffInDays($dataAtual);--}}
{{--                                            $semanas = floor($diasTotal / 7);--}}
{{--                                            $dias = $diasTotal % 7;--}}

{{--                                            // Formatação condicional--}}
{{--                                            if ($dataGestacao->isFuture()) {--}}
{{--                                                $diasFaltantes = $dataAtual->diffInDays($dataGestacao);--}}
{{--                                                $semanasFaltantes = floor($diasFaltantes / 7);--}}
{{--                                                $diasFaltantes = $diasFaltantes % 7;--}}

{{--                                                echo '<span class="badge bg-info text-dark">';--}}
{{--                                                echo 'Início em '.$dataGestacao->isoFormat('DD/MM/YYYY').' (';--}}
{{--                                                echo $semanasFaltantes > 0 ? $semanasFaltantes.' semana'.($semanasFaltantes != 1 ? 's' : '').' e ' : '';--}}
{{--                                                echo $diasFaltantes.' dia'.($diasFaltantes != 1 ? 's' : '').')';--}}
{{--                                                echo '</span>';--}}
{{--                                            } else {--}}
{{--                                                echo '<span class="badge ';--}}

{{--                                                // Cores baseadas no tempo de gestação--}}
{{--                                                if ($semanas >= 42) {--}}
{{--                                                    echo 'bg-danger">Pós-termo: ';--}}
{{--                                                } elseif ($semanas >= 37) {--}}
{{--                                                    echo 'bg-success">Termo: ';--}}
{{--                                                } else {--}}
{{--                                                    echo 'bg-primary">';--}}
{{--                                                }--}}

{{--                                                // Formata o texto de saída--}}
{{--                                                echo $semanas.' semana'.($semanas != 1 ? 's' : '');--}}
{{--                                                echo $dias > 0 ? ' e '.$dias.' dia'.($dias != 1 ? 's' : '') : '';--}}
{{--                                                echo '</span>';--}}
{{--                                            }--}}
{{--                                        @endphp--}}
                                    </td>
                                    <td data-title="Ações" style='text-align:right;'>
                            @endforeach
                            </tbody>
                        </div>
                    </table>
                    @if ($pacientes->isEmpty())
                        <p style="text-align: center;"> Não existe pacienter cadastrados no sistema</p>
                    @endif
                </div>
            </div>
        </div>
    </div>



@endsection
