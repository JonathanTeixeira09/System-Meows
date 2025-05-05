@extends('layouts.app')

@section('title', isset($profissional) ? 'Editar Profissional' : 'Cadastrar Profissional')
@section('conteudo')
    <style>
        #cameraContainer {
            background-color: #000;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #video {
            max-width: 100%;
            max-height: 400px;
        }
        .modal-content {
            overflow: hidden;
        }
    </style>

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ isset($profissional) ? 'Editar Profissional' : 'Cadastrar Profissional' }}
                </h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <!-- Formulario -->
                    <form class="row g-3" action="{{ isset($profissional) ? route('editarprofissional.update', $profissional->hashid) : route('cadastroprofissional.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($profissional))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-sm-2 form-group text-center align-self-center">
                                <!-- Preview da foto -->
                                <img class="img-thumbnail" src="{{ isset($profissional) && $profissional->thumbnail ? asset('storage/'.$profissional->thumbnail) : asset('img/logo/user-admin.jpg') }}"
                                     id="foto_thumbnail" width="150" height="130" style="object-fit: cover;">

                                <!-- Input file oculto -->
                                <input type="file" id="upload_foto" name="thumbnail" accept="image/*" style="display:none" onchange="loadFile(event)">

                                <!-- Botões -->
                                <div class="d-grid gap-2 mt-2">
                                    <button type="button" class="btn btn-sm btn-primary" onclick="showWebcamModal()">
                                        <i class="fas fa-camera"></i> Tirar Foto
                                    </button>
                                    <button type="button" class="btn btn-sm btn-secondary" onclick="document.getElementById('upload_foto').click()">
                                        <i class="fas fa-image"></i> Carregar Foto
                                    </button>
                                </div>

                                @if(isset($profissional) && $profissional->thumbnail)
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="deletar_foto" name="deletar_foto" onchange="deletePhoto()">
                                        <label class="form-check-label" for="deletar_foto">Remover foto</label>
                                    </div>
                                @endif

                                <!-- Modal da Webcam -->
                                <div class="modal fade" id="webcamModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">Tirar Foto</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <div class="mb-3">
                                                    <video id="video" width="100%" autoplay playsinline style="max-height: 400px; background: #000;"></video>
                                                    <canvas id="canvas" style="display:none;"></canvas>
                                                </div>
                                                <div id="photoPreview" class="mb-3"></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="fas fa-times"></i> Cancelar
                                                </button>
                                                <button type="button" class="btn btn-primary" id="takePhotoBtn" onclick="takePhoto()">
                                                    <i class="fas fa-camera"></i> Capturar
                                                </button>
                                                <button type="button" class="btn btn-success" id="usePhotoBtn" style="display:none;" onclick="usePhoto()">
                                                    <i class="fas fa-check"></i> Usar Foto
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <p class="help-block" style="text-align: right;"><h11 class="text-danger">*</h11> Campo Obrigatório </p>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="nome" class="form-label">Nome<h11 class="text-danger">*</h11> </label>
                                        <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome', $profissional->nome ?? '') }}">
                                        <div class="invalid-feedback">
                                            @error('nome')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="sexo" class="form-label">Sexo<h11 class="text-danger">*</h11> </label>
                                        <select class="form-select @error('sexo') is-invalid @enderror" id="sexo" name="sexo">
                                            <option value="" {{ old('sexo', $profissional->sexo ?? '') == '' ? 'selected' : '' }}>Selecione</option>
                                            <option value="Feminino" {{ old('sexo', $profissional->sexo ?? '') == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                                            <option value="Masculino" {{ old('sexo', $profissional->sexo ?? '') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            @error('sexo')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="dataNascimento" class="form-label">Data Nascimento<h11 class="text-danger">*</h11> </label>
                                        <input type="date" class="form-control @error('dataNascimento') is-invalid @enderror" id="dataNascimento" name="dataNascimento" value="{{ old('dataNascimento', isset($profissional) ? $profissional->dataNascimento->format('Y-m-d') : '') }}">
                                        <div class="invalid-feedback">
                                            @error('dataNascimento')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="cpf" class="form-label">CPF<h11 class="text-danger">*</h11> </label>
                                        <input type="text" class="form-control @error('cpf') is-invalid @enderror" id="cpf" name="cpf" value="{{ old('cpf', $profissional->cpf ?? '') }}">
                                        <div class="invalid-feedback">
                                            @error('cpf')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="formacao_id" class="form-label">Formação</label>
                                        <select class="form-select @error('formacao_id') is-invalid @enderror" id="formacao_id" name="formacao_id">
                                            <option value="">Selecione</option>
                                            @foreach($formacoes as $formacao)
                                                <option value="{{ $formacao->id }}" {{ old('formacao_id', $profissional->formacao_id ?? '') == $formacao->id ? 'selected' : '' }}>{{ $formacao->nome }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            @error('formacao_id')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cargo_id" class="form-label">Cargo<h11 class="text-danger">*</h11> </label>
                                        <select class="form-select @error('cargo_id') is-invalid @enderror" id="cargo_id" name="cargo_id">
                                            <option value="">Selecione</option>
                                            @foreach($cargos as $cargo)
                                                <option value="{{$cargo->id}}" {{ old('cargo_id', $profissional->cargo_id ?? '') == $cargo->id ? 'selected' : '' }}>{{$cargo->nome}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            @error('cargo_id')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="conselho" class="form-label">Conselho<h11 class="text-danger">*</h11> </label>
                                        <select class="form-select @error('conselho') is-invalid @enderror" id="conselho" name="conselho">
                                            <option value="">Selecione</option>
                                            @foreach(['COREN', 'CRAS', 'CRBM', 'CREFITO', 'CRF', 'CRFA', 'CRM', 'CRN', 'CRO', 'CRP', 'CRTR'] as $opcao)
                                                <option value="{{ $opcao }}" {{ old('conselho', $profissional->conselho ?? '') == $opcao ? 'selected' : '' }}>{{ $opcao }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            @error('conselho')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="registro" class="form-label">Registro Profissional<h11 class="text-danger">*</h11> </label>
                                        <input type="text" class="form-control @error('registro') is-invalid @enderror" id="registro" name="registro" value="{{ old('registro', $profissional->registro ?? '') }}">
                                        <div class="invalid-feedback">
                                            @error('registro')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="rqe" class="form-label">Registro de qualificação de especialista (RQE)</label>
                                        <input type="text" class="form-control @error('rqe') is-invalid @enderror" id="rqe" name="rqe" value="{{ old('rqe', $profissional->rqe ?? '') }}">
                                        <div class="invalid-feedback">
                                            @error('rqe')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <p style="text-align: right;">
                                            <a href="{{ route('listarprofissional.index') }}" class="btn btn-warning btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-arrow-left"></i>
                                                </span>
                                                <span class="text">Voltar</span>
                                            </a>
                                            <button type="submit" class="btn btn-primary btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-check-square"></i>
                                                </span>
                                                <span class="text">{{ isset($profissional) ? 'Atualizar' : 'Gravar' }}</span>
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

@endsection
@push('profissionalJs')
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
                        width: { ideal: 1280 },
                        height: { ideal: 720 },
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

            // Desenhar a imagem espelhada (para ficar natural como selfie)
            const ctx = canvas.getContext('2d');
            ctx.translate(canvas.width, 0);
            ctx.scale(-1, 1);
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Mostrar preview da foto
            const photoUrl = canvas.toDataURL('image/jpeg');
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
                const file = new File([blob], 'foto_profissional_'+Date.now()+'.jpg', {
                    type: 'image/jpeg',
                    lastModified: new Date()
                });

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

                // Resetar o modal
                document.getElementById('photoPreview').innerHTML = '';
                document.getElementById('usePhotoBtn').style.display = 'none';
                document.getElementById('takePhotoBtn').style.display = 'inline-block';
            }, 'image/jpeg', 0.9); // Qualidade 90%
        }

        // Função para carregar arquivo selecionado
        function loadFile(event) {
            var output = document.getElementById('foto_thumbnail');
            if (event.target.files && event.target.files[0]) {
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src); // Liberar memória

                    // Desmarcar o checkbox de deletar foto se existir
                    const deleteCheckbox = document.getElementById('deletar_foto');
                    if (deleteCheckbox) {
                        deleteCheckbox.checked = false;
                    }
                }
            }
        }

        // Função para deletar foto e voltar para imagem padrão
        function deletePhoto() {
            var checkbox = document.getElementById('deletar_foto');
            var output = document.getElementById('foto_thumbnail');
            if (checkbox.checked) {
                output.src = '{{ asset("img/logo/user-admin.jpg") }}';
                document.getElementById('upload_foto').value = '';
            }
        }

        // Evento quando o modal é fechado
        $('#webcamModal').on('hidden.bs.modal', function () {
            stopWebcam();
            // Resetar o modal
            document.getElementById('photoPreview').innerHTML = '';
            document.getElementById('usePhotoBtn').style.display = 'none';
            document.getElementById('takePhotoBtn').style.display = 'inline-block';
        });

        // Máscaras (se necessário)
        $(document).ready(function() {
            $('#cpf').mask('000.000.000-00');
            $('#registro').mask('0000000000');
        });
    </script>
@endpush
