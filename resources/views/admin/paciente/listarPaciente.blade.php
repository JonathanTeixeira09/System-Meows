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

        .vertical-center-table td,
        .vertical-center-table th {
            vertical-align: middle;
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
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

                    <table class="table table-striped vertical-center-table">
                        <div class="table-responsive">
                            <thead>
                            <tr style='text-align:left;'>
                                <th>Foto</th>
                                <th>Nome</th>
                                <th>Data de Nascimento</th>
                                <th>Data de Gestação</th>
                                <th>Tempo de Gestação</th>
                                <th>Última Consulta</th>
                                <th style='text-align:right;'>Ações</th>
                            </tr>
                            </thead>
                            <tbody style='text-align:left;'>
                            @foreach ($pacientes as $paciente)
                                <tr class="align-middle">
                                    <td data-title='Foto'><img class="img-profile rounded-circle" src="storage/{{ $paciente->thumbnail }}" style="width: 40px; height: 40px; object-fit: cover; object-position: center center; /* Foco no centro */"></td>
                                    <td class='fw-bold'>{{ $paciente->nome }}</td>
                                    <td data-title='Data de Nascimento'>{{ date('d/m/Y', strtotime($paciente->data_nascimento)) }}</td>
                                    <td data-title='Data de Gestação'>{{ date('d/m/Y', strtotime($paciente->data_gestacao)) }}</td>
                                    <td data-title='Tempo de Gestação'>
                                        @php $gestacao = $paciente->formatarTempoGestacao(); @endphp
                                        <span class="badge {{ $gestacao['badge'] }}">
                                            {{ $gestacao['texto'] }}
                                        </span>
                                    </td>
                                    <td data-title='Última Consulta'>
                                        @if($paciente->ultimoAtendimento && $paciente->ultimoAtendimento->data_alta)
                                            {{ $paciente->ultimoAtendimento->data_alta->format('d/m/Y')}}
                                        @else
                                            <span class="badge bg-danger">Sem consultas</span>
                                        @endif
                                    <td data-title="Ações" style='text-align:right;'>
                                        <a href='{{-- route('editproduto', $produto->id) --}}'><button type='button'
                                                                                                      class='btn btn-sm btn-primary' title="Visualizar"><i class="fa-solid fa-eye"></i> Visualizar</button></a>
                                        <a href='{{-- route('editproduto', $produto->id) --}}'><button type='button'
                                                                                                       class='btn btn-sm btn-warning' title="Editar"><i class="fa-solid fa-pen-to-square"></i> Editar</button></a>
                                    </td>
                            @endforeach
                            </tbody>
                        </div>
                    </table>
                    @if ($pacientes->isEmpty())
                        <p style="text-align: center;"> Não existe pacienter cadastrados no sistema</p>
                    @endif
                </div>
            </div>
            <!-- Paginação -->
            <div class="d-flex justify-content-center">
                {{ $pacientes->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

@endsection
