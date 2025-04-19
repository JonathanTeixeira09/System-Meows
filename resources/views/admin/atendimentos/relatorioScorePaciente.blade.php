@extends('layouts.app')

@section('title', 'Relatório de Evolução')
@section('conteudo')
    <div class="container">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Relatório de Evolução</h4>
                <a href="{{ route('evolucao.pdf', $evolucao->id) }}" class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i> Gerar PDF
                </a>
            </div>

            <div class="card-body">
                <!-- Cabeçalho com dados do paciente -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Dados do Paciente</h5>
                        <p><strong>Nome:</strong> {{ $evolucao->atendimento->paciente->nome }}</p>
                        <p><strong>Idade:</strong> {{ $evolucao->atendimento->paciente->idade  }} anos</p>
                        <p><strong>Local:</strong> {{ $evolucao->local->nome }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Profissional Responsável</h5>
                        <p><strong>Nome:</strong> {{ $evolucao->user->profissional->nome }}</p>
                        <p><strong>CRM/CRP:</strong> {{ $evolucao->user->profissional->registro }}</p>
                        <p><strong>Data:</strong> {{ $evolucao->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <!-- Parâmetros coletados -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                        <tr>
                            <th>Parâmetro</th>
                            <th>Valor Coletado</th>
                            <th>Faixa Normal</th>
                            <th>Status</th>
{{--                            <th>Grau Deterioração</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(['fc', 'fr', 'pas', 'pad', 'temp', 'so'] as $parametro)
                            @if(!is_null($evolucao->$parametro))
                                <tr>
                                    <td>{{ $parametrosNormais[$parametro]['label'] }}</td>
                                    <td>{{ $evolucao->$parametro }}</td>
                                    <td>
                                        {{ $parametrosNormais[$parametro]['min'] }} -
                                        {{ $parametrosNormais[$parametro]['max'] }}
                                    </td>
                                    <td>
                                        @php
                                            $valor = $evolucao->$parametro;
                                            $min = $parametrosNormais[$parametro]['min'];
                                            $max = $parametrosNormais[$parametro]['max'];
                                            $status = ($valor >= $min && $valor <= $max) ? 'Normal' : 'Alterado';
                                        @endphp
                                        <span class="badge bg-{{ $status == 'Normal' ? 'success' : 'danger' }}">
                                    {{ $status }}
                                </span>
                                    </td>
{{--                                    <td>--}}
{{--                                        @php--}}
{{--                                            $grau = '';--}}
{{--                                            $cor = '';--}}
{{--                                            if($parametro == 'fc') {--}}
{{--                                                if($valor < 50) { $grau = 'Grave (3)'; $cor = 'danger'; }--}}
{{--                                                elseif($valor >= 50 && $valor <= 59) { $grau = 'Leve (1)'; $cor = 'warning'; }--}}
{{--                                                // ... complete com sua lógica de scores ...--}}
{{--                                            }--}}
{{--                                        @endphp--}}
{{--                                        <span class="badge bg-{{ $cor }}">{{ $grau }}</span>--}}
{{--                                    </td>--}}
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Grau de Deterioração -->
                <div class="mt-4">
                    <h5>Grau de Deterioração</h5>
                    <div class="p-3 bg-light rounded">
                        @php
                            if ($evolucao->grauDeterioracao == 0){
                                $avaliacao = 'Não há risco de deterioração';
                            } elseif ($evolucao->grauDeterioracao >= 1 && $evolucao->grauDeterioracao <= 3){
                                $avaliacao = 'Baixo risco de deterioração';
                            } elseif ($evolucao->grauDeterioracao >= 4 && $evolucao->grauDeterioracao <= 5){
                                $avaliacao = 'Risco moderado de deterioração';
                            } elseif ($evolucao->grauDeterioracao >= 6){
                                $avaliacao = 'Risco Alto de Deterioração';
            }
                        @endphp
                        <span>{{$avaliacao . ' - ' . $evolucao->grauDeterioracao }}</span>
                    </div>
                </div>

                <!-- Observações -->
                <div class="mt-4">
                    <h5>Observações</h5>
                    <div class="p-3 bg-light rounded">
                        {{ $evolucao->obs ?? 'Nenhuma observação registrada.' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mb-4">
            <a href="{{ route('evolucao.pdf', $evolucao->id) }}" class="btn btn-lg btn-danger">
                <i class="fas fa-file-pdf"></i> Baixar Relatório em PDF
            </a>
        </div>
    </div>
@endsection
