@extends('layouts.app')

@section('title', 'Editar Paciente')
@section('conteudo')
<!-- Area Chart -->
<div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-3">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Editar Paciente: {{ $paciente->nome }}</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-area">
                <!-- Formulario -->
                <form class="row g-3" action="{{ route('editarpaciente.update', $paciente->hashid) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- thumbnail -->
                        <div class="col-sm-2 form-group text-center align-self-top mt-4">
                            <img class="img-thumbnail" src="{{ $paciente->thumbnail ? asset('storage/'.$paciente->thumbnail) : asset('img/logo/paciente.png') }}" width="150px" height="130px" id="foto_thumbnail">

                            <!-- Campo de upload de arquivo, escondido -->
                            <input type="file" id="upload_foto" name="thumbnail" accept="image/*" style="display:none" onchange="loadFile(event)">

                            <!-- Botão para selecionar arquivo da galeria ou capturar foto -->
                            <div class="btn-group w-100">
                                <!-- Botão principal que também funciona para seleção de arquivo -->
                                <button type="button" class="btn btn-sm btn-primary mt-2 mb-0 w-100" onclick="document.getElementById('upload_foto').click()">
                                    <i class="fa fa-upload"></i>
                                    <span>Alterar Foto</span>
                                </button>

                                <!-- Botão dropdown apenas para a setinha -->
                                <button type="button" class="btn btn-sm btn-primary mt-2 mb-0 dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Mais opções</span>
                                </button>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#" onclick="document.getElementById('upload_foto').click(); return false;">
                                        <i class="fas fa-folder-open mr-2"></i> Selecionar arquivo
                                    </a>
                                    <a class="dropdown-item" href="#" onclick="showWebcamModal(); return false;">
                                        <i class="fas fa-camera mr-2"></i> Tirar foto com a webcam
                                    </a>
                                </div>
                            </div>

                            @if($paciente->thumbnail)
                            <div class="checkbox clip-check check-primary mt-2">
                                <input type="checkbox" id="deletar_foto" name="deletar_foto" title="Deletar foto" onclick="deletePhoto()">
                                <label for="deletar_foto">Excluir a foto?</label>
                            </div>
                            @endif
                        </div>

                        <div class="col-md-10">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <p class="help-block" style="text-align: right;"><h11 class="text-danger">*</h11> Campo Obrigatório </p>
                                </div>

                                <div class="col-md-6">
                                    <label for="nome" class="form-label">Nome
                                        <h11 class="text-danger">*</h11>
                                    </label>
                                    <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome', $paciente->nome) }}">
                                    <div class="invalid-feedback">
                                        @error('nome')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="sexo" class="form-label">Sexo
                                        <h11 class="text-danger">*</h11>
                                    </label>
                                    <select class="form-select" name="sexo" id="sexo">
                                        <option value="Feminino" {{ old('sexo', $paciente->sexo) == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                                        <option value="Masculino" {{ old('sexo', $paciente->sexo) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="Outro" {{ old('sexo', $paciente->sexo) == 'Outro' ? 'selected' : '' }}>Outros</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="data_nascimento" class="form-label">Data Nascimento<h11 class="text-danger">*</h11></label>
                                    <input type="date" class="form-control @error('data_nascimento') is-invalid @enderror " id="dtNasc" name="data_nascimento" value="{{ old('data_nascimento', $paciente->data_nascimento->format('Y-m-d')) }}">
                                    <div class="invalid-feedback">
                                        @error('data_nascimento')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="cpf" class="form-label">CPF
                                        <h11 class="text-danger">*</h11>
                                    </label>
                                    <input type="text" class="form-control @error('cpf') is-invalid @enderror" id="cpf" name="cpf" value="{{ old('cpf', $paciente->cpf) }}">
                                    <div class="form-text">Apenas números</div>
                                    <div class="invalid-feedback">
                                        @error('cpf')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="rg" class="form-label">RG</label>
                                    <input type="text" class="form-control" id="rg" name="rg" value="{{ old('rg', $paciente->rg) }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="data_gestacao" class="form-label">Data Gestação
                                        <h11 class="text-danger">*</h11>
                                    </label>
                                    <input type="date" class="form-control @error('data_gestacao') is-invalid @enderror" id="data_gestacao" name="data_gestacao" value="{{ old('data_gestacao', $paciente->data_gestacao ? $paciente->data_gestacao->format('Y-m-d') : '') }}">
                                    <div class="invalid-feedback">
                                        @error('data_gestacao')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="nome_mae" class="form-label">Nome da Mãe</label>
                                    <input type="text" class="form-control" id="nome_mae" name="nome_mae" value="{{ old('nome_mae', $paciente->nome_mae) }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="nome_pai" class="form-label">Nome do Pai</label>
                                    <input type="text" class="form-control" id="nome_pai" name="nome_pai" value="{{ old('nome_pai', $paciente->nome_pai) }}">
                                </div>

                                <div class="col-md-4">
                                    <label for="cns" class="form-label">CNS</label>
                                    <input type="text" class="form-control" id="cns" name="cns" value="{{ old('cns', $paciente->cns) }}"
                                           placeholder="Cartão Nacional de Saúde">
                                </div>

                                <hr>

                                <h5 class="col-md-12 mb-1">
                                    <a class="btn" data-toggle="collapse" href="#endereco" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Endereço
                                        <i class="fas fa-angle-down"></i>
                                    </a>
                                </h5>
                                <div class="row collapse" id="endereco">
                                    <div class="col-md-4">
                                        <label for="uf" class="form-label">CEP</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="" id="cep" name="cep" oninput="formatarCEP(this)" maxlength="9" value="{{ old('cep', $paciente->cep) }}">
                                            <button type="button" class="btn btn-outline-secondary" onclick="buscarEndereco(event)">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="uf" class="form-label">UF</label>
                                        <input type="text" class="form-control" id="uf" name="uf" value="{{ old('uf', $paciente->uf) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="cidade" class="form-label">Cidade</label>
                                        <input type="text" class="form-control" id="cidade" name="cidade" value="{{ old('cidade', $paciente->cidade) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="bairro" class="form-label">Bairro</label>
                                        <input type="text" class="form-control" id="bairro" name="bairro" value="{{ old('bairro', $paciente->bairro) }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="logradouro" class="form-label">Logradouro</label>
                                        <input type="text" class="form-control" id="logradouro" name="logradouro" value="{{ old('logradouro', $paciente->logradouro) }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="numero" class="form-label">Número</label>
                                        <input type="text" class="form-control" id="numero" name="numero" value="{{ old('numero', $paciente->numero) }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="complemento" class="form-label">Complemento</label>
                                        <input type="text" class="form-control" id="complemento" name="complemento" value="{{ old('complemento', $paciente->complemento) }}">
                                    </div>
                                </div>
                                <hr>
                                <p class="col-md-12 mb-2">
                                    <a class="btn" data-toggle="collapse" href="#contato" role="button"
                                       aria-expanded="false" aria-controls="collapseExample">
                                        Contato
                                        <i class="fas fa-angle-down"></i>
                                    </a>
                                </p>
                                <div class="row collapse" id="contato">
                                    <div class="col-md-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="email"
                                               placeholder="Informe um email válido" name="email" value="{{ old('email', $paciente->email) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="celular" class="form-label">Celular</label>
                                        <input type="text" class="form-control" id="celular" name="celular" value="{{ old('celular', $paciente->celular) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="celular2" class="form-label">Celular 2</label>
                                        <input type="text" class="form-control" id="celular2" name="celular2" value="{{ old('celular2', $paciente->celular2) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="telefone_fixo" class="form-label">Telefone Fixo</label>
                                        <input type="text" class="form-control" id="telefone_fixo" name="telefone_fixo" value="{{ old('telefone_fixo', $paciente->telefone_fixo) }}">
                                    </div>
                                </div>

                                <hr>
                                <p class="col-md-12 mb-0">
                                    <a class="btn" data-toggle="collapse" href="#observacao" role="button"
                                       aria-expanded="false" aria-controls="collapseExample">
                                        Observações Adminitrativas
                                        <i class="fas fa-angle-down"></i>
                                    </a>
                                </p>
                                <div class="row collapse" id="observacao">
                                    <div class="col-md-12">
                                        <label for="observacoes" class="form-label"></label>
                                        <textarea class="form-control" id="observacoes" rows="3" name="observacoes">{{ old('observacoes', $paciente->observacoes) }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <p style="text-align: right;">
                                        <a href="{{ route('listarpaciente.index') }}" class="btn btn-warning btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-arrow-left"></i>
                                                </span>
                                            <span class="text">Voltar</span>
                                        </a>
                                        <button type="submit" class="btn btn-primary btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-check-square"></i>
                                                </span>
                                            <span class="text">Atualizar</span>
                                        </button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para captura de foto pela webcam -->
<div class="modal fade" id="webcamModal" tabindex="-1" role="dialog" aria-labelledby="webcamModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="webcamModalLabel">Tirar Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-3">
                    <video id="video" width="100%" height="auto" autoplay playsinline style="background-color: #f8f9fa;"></video>
                </div>
                <canvas id="canvas" style="display:none;"></canvas>
                <div id="photoPreview" class="mb-3"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="takePhotoBtn">Tirar Foto</button>
                <button type="button" class="btn btn-success" id="usePhotoBtn" style="display:none;">Usar Foto</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scriptsJS')
<script>
    // Variáveis globais para a webcam
    let stream = null;

    // Função para mostrar o modal da webcam
    function showWebcamModal() {
        $('#webcamModal').modal('show');
        startWebcam();
    }

    // Função para iniciar a webcam
    async function startWebcam() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({
                video: {
                    width: { ideal: 640 },
                    height: { ideal: 480 },
                    facingMode: 'user'
                },
                audio: false
            });
            const video = document.getElementById('video');
            video.srcObject = stream;
        } catch (err) {
            console.error("Erro ao acessar a webcam: ", err);
            alert("Não foi possível acessar a webcam. Verifique as permissões.");
            $('#webcamModal').modal('hide');
        }
    }

    // Função para parar a webcam
    function stopWebcam() {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
            stream = null;
        }
    }

    // Função para tirar foto
    function takePhoto() {
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const photoPreview = document.getElementById('photoPreview');

        // Configurar canvas com as mesmas dimensões do vídeo
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);

        // Mostrar preview da foto
        const photoUrl = canvas.toDataURL('image/png');
        photoPreview.innerHTML = `<img src="${photoUrl}" class="img-thumbnail" style="max-width: 100%;">`;

        // Mostrar botão para usar a foto
        document.getElementById('usePhotoBtn').style.display = 'inline-block';
        document.getElementById('takePhotoBtn').style.display = 'none';
    }

    // Função para usar a foto capturada
    function usePhoto() {
        const canvas = document.getElementById('canvas');
        const output = document.getElementById('foto_thumbnail');

        // Converter canvas para blob
        canvas.toBlob(function(blob) {
            // Criar um arquivo a partir do blob
            const file = new File([blob], 'foto_paciente.png', { type: 'image/png' });

            // Criar um DataTransfer para simular um input file
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);

            // Atribuir ao input file
            const inputFile = document.getElementById('upload_foto');
            inputFile.files = dataTransfer.files;

            // Atualizar a thumbnail
            output.src = URL.createObjectURL(file);

            // Fechar o modal e parar a webcam
            $('#webcamModal').modal('hide');
            stopWebcam();
        }, 'image/png');
    }

    // Eventos
    document.addEventListener('DOMContentLoaded', function() {
        // Eventos do modal da webcam
        document.getElementById('takePhotoBtn').addEventListener('click', takePhoto);
        document.getElementById('usePhotoBtn').addEventListener('click', usePhoto);

        // Parar webcam quando o modal é fechado
        $('#webcamModal').on('hidden.bs.modal', function () {
            stopWebcam();
            // Resetar o modal
            document.getElementById('photoPreview').innerHTML = '';
            document.getElementById('usePhotoBtn').style.display = 'none';
            document.getElementById('takePhotoBtn').style.display = 'inline-block';
        });
    });

    // Funções existentes (mantidas)
    function loadFile(event) {
        var output = document.getElementById('foto_thumbnail');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    }

    function deletePhoto() {
        var checkbox = document.getElementById('deletar_foto');
        var output = document.getElementById('foto_thumbnail');
        if (checkbox.checked) {
            output.src = '{{ asset('img/logo/paciente.png') }}'; // Imagem padrão
            document.getElementById('upload_foto').value = ''; // Limpa o campo de upload
        }
    }

    function formatarCEP(input) {
        const cursorPos = input.selectionStart;
        let cep = input.value.replace(/\D/g, '');
        if (cep.length > 5) cep = cep.substring(0, 5) + '-' + cep.substring(5, 8);
        input.value = cep;
        input.setSelectionRange(cursorPos, cursorPos);
        if (cep.replace(/\D/g, '').length === 8) {
            buscarEndereco();
        }
    }

    async function buscarEndereco(event) {
        if (event) event.preventDefault();
        const cep = document.getElementById('cep').value.replace(/\D/g, '');
        if (cep.length !== 8) return;

        try {
            const response = await fetch(`/buscar-cep/${cep}`);
            const data = await response.json();
            if (data.found) {
                document.getElementById('uf').value = data.uf;
                document.getElementById('cidade').value = data.cidade;
                document.getElementById('bairro').value = data.bairro;
                document.getElementById('logradouro').value = data.logradouro;
            }
        } catch (error) {
            console.log("Busca de CEP opcional - não encontrado");
        }
    }

    // Máscaras
    $(document).ready(function() {
        $('#cpf').mask('000.000.000-00');
        $('#celular').mask('(00) 00000-0000');
        $('#celular2').mask('(00) 00000-0000');
        $('#telefone_fixo').mask('(00) 0000-0000');
    });
</script>
@endpush
