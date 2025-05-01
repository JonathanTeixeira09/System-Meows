@extends('layouts.app')

@section('title', 'Visualizar Profissional')
@section('conteudo')
    <style>
        .card-header {
            font-weight: 600;
        }
        .badge {
            font-size: 0.9rem;
            padding: 0.35em 0.65em;
        }
    </style>
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detalhes do Profissional</h5>
                    <div>
                        <a href="{{ route('editarprofissional.edit', $profissional->id) }}" class="btn btn-light btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('listarprofissional.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-3 text-center">
                        @if($profissional->thumbnail)
                            <img src="{{ asset('storage/' . $profissional->thumbnail) }}"
                                 alt="Thumbnail do profissional"
                                 class="img-thumbnail rounded-circle"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="width: 200px; height: 200px;">
                                <i class="fas fa-user-md fa-4x text-secondary"></i>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-9">
                        <h3 class="mb-3">{{ $profissional->nome }}</h3>

                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>CPF:</strong> {{ $profissional->cpf }}</p>
                                <p><strong>Sexo:</strong> {{ ucfirst($profissional->sexo) }}</p>
                                <p><strong>Data de Nascimento:</strong> {{ ($profissional->dataNascimento)->format('d/m/Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Status:</strong>
                                    <span class="badge badge-{{ $profissional->status == 'Ativo' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($profissional->status) }}
                                </span>
                                </p>
                                <p><strong>Formação:</strong> {{ $profissional->formacao->nome ?? 'Não informado' }}</p>
                                <p><strong>Cargo:</strong> {{ $profissional->cargo->nome ?? 'Não informado' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Registro Profissional</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Conselho:</strong> {{ $profissional->conselho ?? 'Não informado' }}</p>
                                <p><strong>Número do Registro:</strong> {{ $profissional->registro ?? 'Não informado' }}</p>
                                <p><strong>RQE:</strong> {{ $profissional->rqe ?? 'Não informado' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Informações Adicionais</h5>
                            </div>
                            <div class="card-body">
                                <!-- Aqui você pode adicionar outras informações relacionadas ou estatísticas -->
                                <p class="text-muted">Informações adicionais podem ser adicionadas aqui.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-muted">
                <small>Última atualização: {{ $profissional->updated_at->format('d/m/Y H:i') }}</small>
            </div>
        </div>
    </div>
@endsection

