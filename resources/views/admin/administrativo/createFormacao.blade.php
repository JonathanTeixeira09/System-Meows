@extends('layouts.app')

@section('title', isset($formacao) ? 'Edição de Formação' : 'Criação de Formação')

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
            <!-- Card Header -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ isset($formacao) ? 'Editando Formação' : 'Cadastrando Formações' }}
                </h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Form -->
                            <form class="row g-2" action="{{ isset($formacao) ? route('editarFormacao.update', $formacao->id) : route('cadastrarFormacao.store') }}" method="POST">
                                @csrf
                                @if(isset($formacao))
                                    @method('PUT')
                                @endif

                                <div class="col-md-12">
                                    <label for="nome" class="form-label">Nome da Formação:</label>
                                    <input type="text" class="form-control @error('nome') is-invalid @enderror"
                                           id="nome" name="nome"
                                           value="{{ old('nome', $formacao->nome ?? '') }}">
                                    <div class="invalid-feedback">
                                        @error('nome')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <!-- Botão de Enviar -->
                                <div class="col-md-12">
                                    <p style="text-align: right;">
                                        <button type="submit" class="btn btn-success text-white" value="salvar">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-check-square"></i>
                                            </span>
                                            <span class="text">{{ isset($formacao) ? 'Atualizar' : 'Cadastrar' }}</span>
                                        </button>

                                        @if(isset($formacao))
                                            <a href="{{ route('cadastrarFormacao.index') }}" class="btn btn-secondary">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-times"></i>
                                            </span>
                                                <span class="text">Cancelar</span>
                                            </a>
                                        @endif
                                    </p>
                                </div>
                            </form>
                            <!-- Fim do Formulário -->

                            @unless(isset($formacao))
                                <table class="table table-striped table-md">
                                    <div class="table-responsive">
                                        <thead>
                                        <tr style='text-align:left;'>
                                            <th>Nome</th>
                                            <th style='text-align:right;'>Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody style='text-align:left;'>
                                        @foreach ($formacoes as $formacaoItem)
                                            <tr>
                                                <td class='fw-bold'>{{ $formacaoItem->nome }}</td>
                                                <td data-title="Ações" style='text-align:right;'>
                                                    <a href="{{ route('editarFormacao.edit', $formacaoItem->id) }}">
                                                        <button type='button' class='btn btn-sm btn-warning'>
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </a>

                                                    <form action="{{ route('excluirFormacao.destroy', $formacaoItem->id) }}" method="post"
                                                          style="display:inline-block;">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-sm btn-danger" value="excluir"
                                                                onclick="return confirm('Tem certeza que deseja excluir esta formação?')">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </div>
                                </table>
                                @if ($formacoes->isEmpty())
                                    <p style="text-align: center;">Não existem formações cadastradas no sistema</p>
                                @endif
                            @endunless
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
