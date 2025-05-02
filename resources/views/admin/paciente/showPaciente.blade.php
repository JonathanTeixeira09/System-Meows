@extends('layouts.app')

@section('title', 'Visualizar Paciente')
@section('conteudo')
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-3">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary text-white">
                <h6 class="m-0 font-weight-bold">Detalhes do Paciente: {{ $paciente->nome }}</h6>
                <div>
                    <a href="{{ route('editarpaciente.edit', $paciente->hashid) }}" class="btn btn-sm btn-light">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <a href="{{ route('listarpaciente.index') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </a>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <!-- Foto do Paciente -->
                    <div class="col-md-2 text-center mb-4">
                        <img class="img-thumbnail"
                             src="{{ $paciente->thumbnail ? asset('storage/'.$paciente->thumbnail) : asset('img/logo/paciente.png') }}"
                             width="150" height="150" style="object-fit: cover;">
                    </div>

                    <!-- Dados Pessoais -->
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="mb-3 border-bottom pb-2">
                                    <i class="fas fa-user-circle mr-2"></i>Dados Pessoais
                                </h5>
                            </div>

                            <div class="col-md-4">
                                <p><strong>Nome:</strong> {{ $paciente->nome }}</p>
                            </div>
                            <div class="col-md-2">
                                <p><strong>Sexo:</strong> {{ $paciente->sexo }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><strong>Data Nascimento:</strong> {{ $paciente->data_nascimento->format('d/m/Y') }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><strong>Idade:</strong> {{ $paciente->data_nascimento->age }} anos</p>
                            </div>

                            <div class="col-md-3">
                                <p><strong>CPF:</strong> {{ $paciente->cpf }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><strong>RG:</strong> {{ $paciente->rg ?? 'Não informado' }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><strong>CNS:</strong> {{ $paciente->cns ?? 'Não informado' }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><strong>Nr Prontuário:</strong> {{ $paciente->codigo_prontuario ?? 'Não informado' }}</p>
                            </div>

                            <div class="col-md-6">
                                <p><strong>Nome da Mãe:</strong> {{ $paciente->nome_mae ?? 'Não informado' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Nome do Pai:</strong> {{ $paciente->nome_pai ?? 'Não informado' }}</p>
                            </div>
                        </div>

                        <!-- Dados da Gestação -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h5 class="mb-3 border-bottom pb-2">
                                    <i class="fas fa-baby mr-2"></i>Dados da Gestação
                                </h5>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Data da Gestação:</strong> {{ $paciente->data_gestacao->format('d/m/Y') }}</p>
                            </div>
                            <div class="col-md-4">
                                @php
                                    $gestacao = $paciente->formatarTempoGestacao();
                                @endphp
                                <p><strong>Semanas de Gestação:</strong> {{ $gestacao['texto'] }}</p>
                            </div>
                        </div>

                        <!-- Endereço -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h5 class="mb-3 border-bottom pb-2">
                                    <i class="fas fa-map-marker-alt mr-2"></i>Endereço
                                </h5>
                            </div>

                            @if($paciente->cep)
                                <div class="col-md-3">
                                    <p><strong>CEP:</strong> {{ $paciente->cep }}</p>
                                </div>
                                <div class="col-md-2">
                                    <p><strong>UF:</strong> {{ $paciente->uf }}</p>
                                </div>
                                <div class="col-md-3">
                                    <p><strong>Cidade:</strong> {{ $paciente->cidade }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Bairro:</strong> {{ $paciente->bairro }}</p>
                                </div>

                                <div class="col-md-6">
                                    <p><strong>Logradouro:</strong> {{ $paciente->logradouro }}</p>
                                </div>
                                <div class="col-md-2">
                                    <p><strong>Número:</strong> {{ $paciente->numero }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Complemento:</strong> {{ $paciente->complemento ?? 'Não informado' }}</p>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <p class="text-muted">Endereço não cadastrado</p>
                                </div>
                            @endif
                        </div>

                        <!-- Contatos -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h5 class="mb-3 border-bottom pb-2">
                                    <i class="fas fa-phone-alt mr-2"></i>Contatos
                                </h5>
                            </div>

                            @if($paciente->email || $paciente->celular || $paciente->telefone_fixo)
                                <div class="col-md-4">
                                    <p><strong>Email:</strong> {{ $paciente->email ?? 'Não informado' }}</p>
                                </div>
                                <div class="col-md-3">
                                    <p><strong>Celular:</strong> {{ $paciente->celular ?? 'Não informado' }}</p>
                                </div>
                                <div class="col-md-3">
                                    <p><strong>Celular 2:</strong> {{ $paciente->celular2 ?? 'Não informado' }}</p>
                                </div>
                                <div class="col-md-2">
                                    <p><strong>Telefone Fixo:</strong> {{ $paciente->telefone_fixo ?? 'Não informado' }}</p>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <p class="text-muted">Contatos não cadastrados</p>
                                </div>
                            @endif
                        </div>

                        <!-- Observações -->
                        @if($paciente->observacoes)
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3 border-bottom pb-2">
                                        <i class="fas fa-sticky-note mr-2"></i>Observações
                                    </h5>
                                    <div class="bg-light p-3 rounded">
                                        {!! nl2br(e($paciente->observacoes)) !!}
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Datas do Cadastro -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h5 class="mb-3 border-bottom pb-2">
                                    <i class="fas fa-calendar-alt mr-2"></i>Registro
                                </h5>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Cadastrado em:</strong> {{ $paciente->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Última atualização:</strong> {{ $paciente->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
