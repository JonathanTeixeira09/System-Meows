@extends('layouts.app')

@section('title', 'Listar Usuários')
@section('conteudo')
    <style>
        @media (max-width: 1000px) {
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
                <h6 class="m-0 font-weight-bold text-primary">Listagem de Usuários</h6>
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
                                <th>Email</th>
                                <th>Permissão</th>
                                <th>Status</th>
                                <th>Cargo</th>
                                <th style='text-align:center;'>Ações</th>
                            </tr>
                            </thead>
                            <tbody style='text-align:left;'>
                            @foreach ($users as $user)
                                <tr>
                                    <td data-title='Foto'><img class="img-profile rounded-circle" src="storage/{{ $user->profissional->thumbnail }}" style="width: 50px; height: 50px; object-fit: cover; object-position: center center;"></td>
                                    <td class='fw-bold'>{{ $user->profissional->nome }}</td>
                                    <td data-title='Email'>{{ $user->email }}</td>
                                    <td data-title='Cargo'>{{ $user->role }}</td>
                                    <td data-title='Status'>{{ $user->status }}</td>
                                    <td data-title='Cargo'>{{ $user->profissional->cargo->nome }}</td>
                                    <td data-title="Ações">
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <a href='{{ route('user.show', $user->id) }}' class="btn btn-sm btn-primary"><i class="fa-solid fa-eye"></i> Visualizar</a>
                                            <a href='{{ route('editarusuario.index', $user->id) }}' class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
    {{--                                        <a href='{{ route('users.disable', $user->id) }}'><button type='button' class='btn btn-sm btn-danger'><i class="fa-solid fa-user-large-slash"></i> Desabilitar</button></a>--}}
                                            @if($user->status === 'Ativo')
                                                <form action="{{ route('users.disable', $user) }}" method="POST" class="m-0">
                                                    @csrf
                                                    @method('PATCH')  <!-- Converte o POST em PATCH -->
                                                    <button type='submit' class='btn btn-sm btn-danger' onclick="return confirm('Tem certeza que deseja desativar este usuário?')"><i class="fa-solid fa-user-large-slash"></i> Desabilitar</button></a>
                                                </form>
                                            @else
                                                <form action="{{ route('users.enable', $user->id) }}" method="POST" class="m-0">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fas fa-user-check"></i> Ativar
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                            @endforeach
                            </tbody>
                        </div>
                    </table>
                    @if ($users->isEmpty())
                        <p style="text-align: center;"> Não existe usuários cadastrados no sistema</p>
                    @endif
                </div>
            </div>
            <!-- Paginação -->
            <div class="d-flex justify-content-center">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>



@endsection
