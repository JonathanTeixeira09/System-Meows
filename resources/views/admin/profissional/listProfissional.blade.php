@extends('layouts.app')

@section('title', 'Listar Profissionais')
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
    </style>

<div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Listagem de Profissionais</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">

                    <table class="table table-striped table-md">
                        <div class="table-responsive">
                            <thead>
                                <tr style='text-align:center;'>
                                    <th>Nome</th>
                                    <th>Cargo</th>
                                    <th>Data de Nascimento</th>
                                    <th>Status</th>
                                    <th style='text-align:right;'>Ações</th>
                                </tr>
                                </thead>
                                <tbody style='text-align:center;'>
                                @foreach ($profissionals as $profissional)
                                    <tr>
                                        <td class='fw-bold'>{{ $profissional->nome }}</td>
                                        <td data-title='Cargo'>{{ $profissional->cargo->nome }}</td>
                                        <td data-title='Data de Nascimento'>{{ date('d/m/Y', strtotime($profissional->dataNascimento)) }}</td>
                                        <td data-title='Status'>{{ $profissional->status }}</td>
                                        <td data-title="Ações" style='text-align:right;'>
                                @endforeach
                                        </tbody>
                        </div>
                    </table>
                    @if ($profissionals->isEmpty())
                        <p style="text-align: center;"> Não existe funcionarios cadastrados no sistema</p>
                    @endif
                </div>
            </div>
    </div>
</div>



@endsection