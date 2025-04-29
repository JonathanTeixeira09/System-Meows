{{--@extends('layouts.app')--}}

{{--@section('title', $title)--}}
{{--@section('title', 'Criação de Local')--}}
{{--@section('conteudo')--}}
{{--    <style>--}}
{{--        @media (max-width: 767px) {--}}
{{--            .table thead {--}}
{{--                display: none;--}}
{{--            }--}}

{{--            .table td {--}}
{{--                display: flex;--}}
{{--                justify-content: space-between;--}}
{{--            }--}}

{{--            .table tr {--}}
{{--                display: block;--}}
{{--            }--}}

{{--            .table td:first-of-type {--}}
{{--                font-weight: bold;--}}
{{--                font-size: 1.2rem;--}}
{{--                text-align: center;--}}
{{--                display: block;--}}
{{--            }--}}

{{--            .table td:not(:first-of-type):before {--}}
{{--                content: attr(data-title);--}}
{{--                display: block;--}}
{{--                font-weight: bold;--}}
{{--            }--}}
{{--        }--}}
{{--    </style>--}}
{{--    <div class="col-xl-12 col-lg-12">--}}
{{--        <div class="card shadow mb-4">--}}
{{--            <!-- Card Header -->--}}
{{--            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">--}}
{{--                <h6 class="m-0 font-weight-bold text-primary"> Cadastrando Locais </h6>--}}
{{--            </div>--}}
{{--            <!-- Card Body -->--}}
{{--            <div class="card-body">--}}
{{--                <div class="chart-area">--}}
{{--                    <div class="row">--}}

{{--                        <div class="col-md-12">--}}
{{--                            <!-- Home Form -->--}}
{{--                            <form class="row g-2" action="{{route('cadastrarLocal.store')}}" method="POST" name="formCadastro" enctype="multipart/form-data">--}}
{{--                                @csrf--}}
{{--                                <div class="col-md-8">--}}
{{--                                    <label for="nome" class="form-label">Nome do Local:</label>--}}
{{--                                    <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome') }}">--}}
{{--                                    <div class="invalid-feedback">--}}
{{--                                        @error('nome')--}}
{{--                                        {{ $message }}--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-4 mb-2">--}}
{{--                                    <label for="descricao" class="form-label">Descrição:</label>--}}
{{--                                    <input type="text" class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" value="{{ old('descricao') }}">--}}
{{--                                    <div class="invalid-feedback">--}}
{{--                                        @error('descricao')--}}
{{--                                        {{ $message }}--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <!-- Botão de Enviar -->--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <p style="text-align: right;">--}}
{{--                                        <button type="submit" class="btn btn-success text-white" value="cadastrar">--}}
{{--                                            <span class="icon text-white-50">--}}
{{--                                                <i class="fas fa-check-square"></i>--}}
{{--                                            </span><span class="text">Cadastrar</span>--}}
{{--                                        </button>--}}
{{--                                    </p>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                            <!-- Fim do Formulário -->--}}
{{--                            <span class="mb-4" style="text-align: center; font-size: 20px; font-weight: bold;">Locais cadastrados</span>--}}
{{--                            <table class="table table-striped table-md mb-3">--}}
{{--                                <div class="table-responsive">--}}
{{--                                    <thead>--}}
{{--                                        <tr style='text-align:left;'>--}}
{{--                                            <th>Nome</th>--}}
{{--                                            <th>Descrição</th>--}}
{{--                                            <th style='text-align:right;'>Ações</th>--}}
{{--                                        </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody style='text-align:left;'>--}}
{{--                                        @foreach ($locals as $local)--}}
{{--                                            <tr>--}}
{{--                                                <td class='fw-bold' style="text-align: left">{{ $local->nome }}</td>--}}
{{--                                                <td data-title="Descrição">{{ $local->descricao }}</td>--}}
{{--                                                <td data-title="Ações" style='text-align:right;'>--}}
{{--                                                    <a href='--}}{{-- route('editproduto', $produto->id) --}}{{--'><button type='button'--}}
{{--                                                                                                                   class='btn btn-sm btn-warning'><i class="fa-solid fa-pen-to-square"> Editar</i></button></a>--}}

{{--                                                    <form action="--}}{{-- route('excluirprodutoestoque', $produto->id) --}}{{--" method="post"--}}
{{--                                                          style="display:inline-block;">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('delete')--}}
{{--                                                        <button type="submit" class="btn btn-sm btn-danger" value="excluir"><i class="fa-solid fa-trash"></i></button>--}}
{{--                                                    </form>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                        @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </div>--}}
{{--                            </table>--}}
{{--                            @if ($locals->isEmpty())--}}
{{--                                <p style="text-align: center;"> Não existe Locais cadastrados no sistema</p>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--@endsection--}}
@extends('layouts.app')

@section('title', isset($local) ? 'Edição de Local' : 'Criação de Local')

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
    </style>
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ isset($local) ? 'Editando Local' : 'Cadastrando Locais' }}
                </h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Form -->
                            <form class="row g-2" action="{{ isset($local) ? route('editarLocal.update', $local->id) : route('cadastrarLocal.store') }}" method="POST" name="formCadastro">
                                @csrf
                                @if(isset($local))
                                    @method('PUT')
                                @endif

                                <div class="col-md-8">
                                    <label for="nome" class="form-label">Nome do Local:</label>
                                    <input type="text" class="form-control @error('nome') is-invalid @enderror"
                                           id="nome" name="nome"
                                           value="{{ old('nome', $local->nome ?? '') }}">
                                    <div class="invalid-feedback">
                                        @error('nome')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="descricao" class="form-label">Descrição:</label>
                                    <input type="text" class="form-control @error('descricao') is-invalid @enderror"
                                           id="descricao" name="descricao"
                                           value="{{ old('descricao', $local->descricao ?? '') }}">
                                    <div class="invalid-feedback">
                                        @error('descricao')
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
                                            <span class="text">{{ isset($local) ? 'Atualizar' : 'Cadastrar' }}</span>
                                        </button>

                                        @if(isset($local))
                                            <a href="{{ route('cadastrarLocal.index') }}" class="btn btn-secondary">
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

                            @unless(isset($local))
                                <span class="mb-4" style="text-align: center; font-size: 20px; font-weight: bold;">Locais cadastrados</span>
                                <table class="table table-striped table-md mb-3">
                                    <div class="table-responsive">
                                        <thead>
                                        <tr style='text-align:left;'>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th style='text-align:right;'>Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody style='text-align:left;'>
                                        @foreach ($locals as $localItem)
                                            <tr>
                                                <td class='fw-bold' style="text-align: left">{{ $localItem->nome }}</td>
                                                <td data-title="Descrição">{{ $localItem->descricao }}</td>
                                                <td data-title="Ações" style='text-align:right;'>
                                                    <a href="{{ route('editarLocal.index', $localItem->id) }}">
                                                        <button type='button' class='btn btn-sm btn-warning'>
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </a>

                                                    {{--                                                    <form action="{{ route('locais.destroy', $localItem->id) }}" method="post"--}}
                                                    {{--                                                          style="display:inline-block;">--}}
                                                    {{--                                                        @csrf--}}
                                                    {{--                                                        @method('delete')--}}
                                                    {{--                                                        <button type="submit" class="btn btn-sm btn-danger" value="excluir"--}}
                                                    {{--                                                                onclick="return confirm('Tem certeza que deseja excluir este local?')">--}}
                                                    {{--                                                            <i class="fa-solid fa-trash"></i>--}}
                                                    {{--                                                        </button>--}}
                                                    {{--                                                    </form>--}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </div>
                                </table>
                                @if ($locals->isEmpty())
                                    <p style="text-align: center;"> Não existem locais cadastrados no sistema</p>
                                @endif
                            @endunless
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
