<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Evolução - {{ $evolucao->atendimento->paciente->nome }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .header img { max-height: 80px; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; }
        .table th { background-color: #f2f2f2; text-align: left; }
        .badge { padding: 3px 6px; border-radius: 3px; font-size: 12px; }
        .bg-success { background-color: #28a745; color: white; }
        .bg-danger { background-color: #dc3545; color: white; }
        .bg-warning { background-color: #ffc107; color: black; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; }
        .signature { margin-top: 80px; border-top: 1px solid #000; width: 300px; }
    </style>
</head>
<body>
<div class="header">
    <h2>Relatório de Evolução</h2>
    <p>Emitido em: {{ now()->format('d/m/Y H:i') }}</p>
</div>

<!-- Conteúdo igual ao do relatório em HTML, adaptado para PDF -->
<div class="container">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Relatório de Evolução</h4>
            {{--                <a href="{{ route('evolucao.pdf', $evolucao->id) }}" class="btn btn-danger">--}}
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

            <!-- Observações -->
            <div class="mt-4">
                <h5>Observações</h5>
                <div class="p-3 bg-light rounded">
                    {{ $evolucao->obs ?? 'Nenhuma observação registrada.' }}
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Fim -->

<div class="footer">
{{--    <p>Sistema para Maternidade - {{ config('app.name') }}</p>--}}
    <p>Sistema para Maternidade - Meows DiGI</p>
    <div class="signature">
        <p>{{ $evolucao->user->profissional->nome }}</p>
        <p></p>
    </div>
</div>
</body>
</html>
