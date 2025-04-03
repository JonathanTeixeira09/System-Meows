@extends('layouts.app')

@section('title', 'Listar Usuários')
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

    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Listagem de Usuários</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">

                    <table class="table table-striped table-md">
                        <div class="table-responsive">
                            <thead>
                            <tr style='text-align:center;'>
                                <th>Thumbnail</th>
                                <th>Nome</th>
                                <th>Permissão</th>
                                <th>Status</th>
                                <th style='text-align:right;'>Ações</th>
                            </tr>
                            </thead>
                            <tbody style='text-align:center;'>
                            @foreach ($users as $user)
                                <tr>
                                    <td data-title='Foto'><img class="img-profile rounded-circle" src="storage/{{ $user->profissional->thumbnail }}" style="width: 60px; height: 60px; object-fit: cover; object-position: center center;"></td>
                                    <td class='fw-bold'>{{ $user->profissional->nome }}</td>
                                    <td data-title='Cargo'>{{ $user->role }}</td>
                                    <td data-title='Status'>{{ $user->status }}</td>
                                    <td data-title="Ações" style='text-align:right;'>
                            @endforeach
                            </tbody>
                        </div>
                    </table>
                    @if ($users->isEmpty())
                        <p style="text-align: center;"> Não existe usuários cadastrados no sistema</p>
                    @endif
                </div>
            </div>
        </div>
    </div>



@endsection
