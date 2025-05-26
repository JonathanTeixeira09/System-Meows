@extends('layouts.app')

@section('title', 'Listar Profissionais')
@section('conteudo')
<style>
        @media (max-width: 1380px) {
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
                <h6 class="m-0 font-weight-bold text-primary">Listagem de Profissionais</h6>
                <div>
                    <a href="{{route('cadastroprofissional.index')}}" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-person-circle-plus"></i>  Cadastrar Novo Profissional
                    </a>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">

                    <table class="table table-striped table-md vertical-center-table">
                        <div class="table-responsive">
                            <thead>
                                <tr style='text-align:left;'>
                                    <th>Thumbnail</th>
                                    <th>Nome</th>
                                    <th>Cargo</th>
                                    <th>Data de Nascimento</th>
                                    <th>Status</th>
                                    <th style='text-align:right;'>Ações</th>
                                </tr>
                                </thead>
                                <tbody style='text-align:left;'>
                                @foreach ($profissionals as $profissional)
                                    <tr class="align-middle">
                                        <td data-title='Thumbnail'><img class="img-profile rounded-circle" src="storage/{{ $profissional->thumbnail }}" style="width: 50px; height: 50px; object-fit: cover; object-position: center center; /* Foco no centro */"></td>
                                        <td class='fw-bold'>{{ $profissional->nome }}</td>
                                        <td data-title='Cargo'>{{ $profissional->cargo->nome }}</td>
                                        <td data-title='Data de Nascimento'>{{ date('d/m/Y', strtotime($profissional->dataNascimento)) }}</td>
                                        <td data-title='Status'>{{ $profissional->status }}</td>
                                        <td data-title="Ações">
                                            <div class="gap-1" style="display: flex; justify-content: flex-end">
                                                <a href='{{ route('profissional.show', $profissional->hashid) }}' class="btn btn-sm btn-primary"><i class="fa-solid fa-eye"></i> Visualizar</a>
                                                <a href='{{ route('editarprofissional.edit', $profissional->hashid)}}' class='btn btn-sm btn-warning'><i class="fa-solid fa-pen-to-square"></i> Editar</a>

{{--                                                <form action="--}}{{-- route('excluirprodutoestoque', $produto->hashid) --}}{{--" method="post"--}}
{{--                                                      style="display:inline-block;">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('delete')--}}
{{--                                                    <button type="submit" class="btn btn-sm btn-danger" value="excluir"><i class="fa-solid fa-user-slash"></i> Desabilitar</button>--}}
{{--                                                </form>--}}
                                            </div>
                                        </td>
                                @endforeach
                                        </tbody>
                        </div>
                    </table>
                    @if ($profissionals->isEmpty())
                        <p style="text-align: center;"> Não existe funcionarios cadastrados no sistema</p>
                    @endif
                </div>
            </div>
            <!-- Paginação -->
            <div class="d-flex justify-content-center">
                {{ $profissionals->links('pagination::bootstrap-5') }}
            </div>
    </div>
</div>



@endsection
