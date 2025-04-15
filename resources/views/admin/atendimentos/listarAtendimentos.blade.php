@extends('layouts.app')

@section('title', 'Listagem de Atendimentos')
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
    </style>

    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Listagem de Atendimentos</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">

                    <table class="table table-striped table-md">
                        <div class="table-responsive">
                            <thead>
                            <tr style='text-align:left;'>
                                <th>Foto</th>
                                <th>Nome</th>
                                <th>Data de Entrada</th>
                                <th>Hora de Entrada</th>
                                <th>Nome do Profissional</th>
                                <th>Status</th>
                                <th style='text-align:right;'>Ações</th>
                            </tr>
                            </thead>
                            <tbody style='text-align:left;'>
                            @foreach ($atendimentos as $atendimento)
                                <tr>
                                    <td data-title='Foto'><img class="img-profile rounded-circle" src="storage/{{ $atendimento->paciente->thumbnail }}" style="width: 60px; height: 60px; object-fit: cover; object-position: center center; /* Foco no centro */"></td>
                                    <td data-title='Nome '>{{ $atendimento->paciente->nome }}</td>
                                    <td data-title='Data de Entrada'>{{ date('d/m/Y', strtotime($atendimento->data_entrada)) }}</td>
                                    <td data-title='Hora de Entrada'>{{ $atendimento->hora_entrada }}</td>
                                    <td data-title='Nome do Profissional'>{{ $atendimento->entradaUser->profissional->nome }}</td>
                                    <td data-title='Status'><span class="badge bg-danger text-white">Aguardando Atendimento</span>
                                        @if ($atendimento->status == 'Em Atendimento')
                                            <span class="badge bg-primary">{{ $atendimento->status }}</span>
                                        @elseif ($atendimento->status == 'Finalizado')
                                            <span class="badge bg-success">{{ $atendimento->status }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ $atendimento->status }}</span>
                                        @endif
                                    </td>
                                    <td data-title="Ações" style='text-align:right;'>
                                        <a href='{{-- route('editproduto', $produto->id) --}}'><button type='button'
                                                                                                       class='btn btn-sm btn-warning' title="Incluir Anamnese"><i class="fa-solid fa-pen-to-square"></i></button></a>
                                        <a href='{{-- route('editproduto', $produto->id) --}}'><button type='button'
                                                                                                       class='btn btn-sm btn-primary' title="Visualizar evolução"><i class="fa-solid fa-eye"></i></button></a>

                                        <a href='{{-- route('editproduto', $produto->id) --}}'><button type='button'
                                                                                                       class='btn btn-sm btn-info' title="Evoluções"><i class="fa-solid fa-list"></i></button></a>
                                        <a href='{{-- route('editproduto', $produto->id) --}}'><button type='button'
                                                                                                      class='btn btn-sm btn-success' title="Dar Alta"><i class="fa-solid fa-circle-up"></i></button></a>
                                    </td>
                            @endforeach
                            </tbody>
                        </div>
                    </table>
                    @if ($atendimentos->isEmpty())
                        <p style="text-align: center;"> Não existe pacientes em atendimento</p>
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
