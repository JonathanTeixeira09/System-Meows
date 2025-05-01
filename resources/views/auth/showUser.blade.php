@extends('layouts.app')

@section('title', 'Visualizar Usuário')
@section('conteudo')
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h5 class="m-0 font-weight-bold text-primary">Informações do Usuário: {{$user->profissional->nome}}</h5>
                        <a href="{{ route('listarusuarios.index') }}" class="btn btn-sm btn-secondary float-end">Voltar</a>
                    </div>

                    <div class="card-body">
                        <div class="row mb-4">
                            <!-- Thumbnail -->
                            <div class="col-md-3 text-center">
                                @if($user->profissional->thumbnail)
                                    <img src="{{ asset('storage/' . $user->profissional->thumbnail) }}"
                                         alt="Thumbnail do usuário"
                                         class="img-thumbnail rounded-circle"
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                                         style="width: 150px; height: 150px;">
                                        <i class="fas fa-user text-white fa-3x"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Informações básicas -->
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="mb-3">Dados Pessoais</h5>
                                        <p><strong>Nome:</strong> {{ $user->profissional->nome }}</p>
                                        <p><strong>Email:</strong> {{ $user->email }}</p>
                                        <p><strong>Cargo:</strong> {{ $user->profissional->cargo->nome ?? 'Não informado' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="mb-3">Status e Permissões</h5>
                                        <p>
                                            <strong>Status:</strong>
                                            <span class="badge bg-{{ $user->status == 'Ativo' ? 'success' : 'danger' }}">
                                            {{ ucfirst($user->status) }}
                                        </span>
                                        </p>
                                        <p><strong>Permissão:</strong> {{ $user->role ?? 'Padrão' }}</p>
                                        <p><strong>Cadastrado em:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Seção adicional para outros detalhes -->
                        <div class="border-top pt-3">
                            <h5>Informações Adicionais</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Último login:</strong>
                                        {{ $user->last_login_at ? $user->last_login_at->format('d/m/Y H:i') : 'Nunca acessou' }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>IP último login:</strong> {{ $user->last_login_ip ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ações -->
                    <div class="card-footer d-flex justify-content-between">
                        <div>
                            @if($user->status == 'Ativo')
                                <form action="{{ route('users.disable', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Tem certeza que deseja desativar este usuário?')">
                                        <i class="fas fa-user-slash"></i> Desativar
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('users.enable', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fas fa-user-check"></i> Ativar
                                    </button>
                                </form>
                            @endif
                        </div>
                        <div>
                            <a href="{{ route('editarusuario.update', $user) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                        </div>
                    </div>
                </div>
{{--            </div>--}}
        </div>
    </div>
@endsection
