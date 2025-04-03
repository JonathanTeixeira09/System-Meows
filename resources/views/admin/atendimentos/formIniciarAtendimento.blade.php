@extends('layouts.app')

{{--@section('title', $title)--}}
@section('title', 'Iniciar Atendimento')
@section('conteudo')
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Iniciar Atendimento</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="col-md-12">
                                <p class="help-block" style="text-align: right;">
                                    <h11 class="text-danger">*</h11>
                                    Campo Obrigatório
                                </p>
                            </div>

                            <!-- Home Form -->
                            <form class="row g-2" action="#" method="POST"
                                  name="formCadastro" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <label for="nomeDaPaciente" class="form-label">Nome da Parturiente:</label>
                                    <div class="input-group">
                                    <input
                                        list="pacientes-list"
                                        class="form-control @error('paciente_id') is-invalid @enderror"
                                        name="paciente_nome"
                                        id="pacienteInput"
                                        placeholder="Digite o nome"
                                        autocomplete="off"
                                        value="{{ old('paciente_nome') }}"
                                    >
                                    <datalist id="pacientes-list">
                                        @foreach($pacientes as $paciente)
                                            <option value="{{ $paciente->nome }}" data-id="{{ $paciente->id }}">
                                        @endforeach
                                    </datalist>
                                    <!-- Botão condicional (inicialmente oculto) -->
                                    <button type="button" id="btnRedirecionarCadastro" class="btn btn-primary d-none" onclick="redirecionarParaCadastro()"                                    >
                                        <i class="fas fa-plus"></i> Cadastrar Nova
                                    </button>
                                </div>
                                <!-- Campo oculto para enviar o ID (se existir) -->
                                <input type="hidden" name="paciente_id" id="pacienteId" value="{{ old('paciente_id') }}">
                                @error('paciente_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                </div>

                                <!-- Botão de Enviar -->
                                <div class="col-md-12">
                                    <p style="text-align: right;">
                                        <button type="submit" class="btn btn-success text-white" value="cadastrar">
                                <span class="icon text-white-50">
                                    <i class="fas fa-check-square"></i>
                                </span><span class="text">Iniciar Atendimento</span>
                                        </button>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('iniciarAtendimentoJs')
<script>
document.getElementById('pacienteInput').addEventListener('input', function() {
    const nomeDigitado = this.value.trim();
    const btnCadastrar = document.getElementById('btnRedirecionarCadastro');
    const pacientesList = document.getElementById('pacientes-list').options;
    let pacienteExiste = false;

    // Verifica se o nome existe no datalist
    for (let i = 0; i < pacientesList.length; i++) {
        if (pacientesList[i].value === nomeDigitado) {
            pacienteExiste = true;
            document.getElementById('pacienteId').value = pacientesList[i].dataset.id;
            break;
        }
    }

    // Mostra/oculta o botão de cadastro
    if (nomeDigitado && !pacienteExiste) {
        btnCadastrar.classList.remove('d-none');
    } else {
        btnCadastrar.classList.add('d-none');
    }
});

function redirecionarParaCadastro() {
    const nomePaciente = document.getElementById('pacienteInput').value;
    // Redireciona para a view de cadastro com o nome pré-preenchido
    window.location.href = `{{ route('cadastrarpaciente.index') }}`;
}
</script>
@endpush
