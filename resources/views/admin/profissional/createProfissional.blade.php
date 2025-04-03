@extends('layouts.app')

@section('title', 'Cadastro Profissional')
@section('conteudo')

<!-- Area Chart -->
<div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Adicionar Novo Profissional</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                <!-- Formulario -->
                <form class="row g-3" action="{{route('cadastroprofissional.store')}}" method="POST" name="formCadastroProfissional" enctype="multipart/form-data">
                    @csrf
                        <div class="row">
                            <div class="col-sm-2 form-group text-center align-self-center">
                                <img class="img-thumbnail" src="img/logo/user-admin.jpg" width="150px" height="130px" id="foto_thumbnail">

                                <!-- Campo de upload de arquivo, escondido -->
                                <input type="file" id="upload_foto" name="thumbnail" accept="image/*" style="display:none" onchange="loadFile(event)">

                                <!-- Botão para selecionar arquivo da galeria ou capturar foto -->
                                <button type="button" class="btn btn-sm btn-primary mt-2 mb-0 w-100" onclick="document.getElementById('upload_foto').click();">
                                    <i class="fa fa-upload"></i>
                                    <span>Carregar Foto</span>
                                </button>

                                <div class="checkbox clip-check check-primary mt-2">
                                    <input type="checkbox" id="deletar_foto" name="deletar_foto" title="Deletar foto" onclick="deletePhoto()">
                                    <label for="deletar_foto">Excluir a foto?</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <p class="help-block" style="text-align: right;"><h11 class="text-danger">*</h11> Campo Obrigatório </p>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="nome" class="form-label">Nome<h11 class="text-danger">*</h11> </label>
                                        <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{old('nome')}}">
                                        <div class="invalid-feedback">
                                            @error('nome')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="sexo" class="form-label">Sexo<h11 class="text-danger">*</h11> </label>
                                        <select class="form-select" aria-label="Default select example" name="sexo">
                                            <option selected value=""{{ old('sexo') == '' ? 'selected' : '' }}>Selecione</option>
                                            <option value="Feminino" {{ old('sexo') == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                                            <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="dataNascimento" class="form-label">Data Nascimento<h11 class="text-danger">*</h11> </label>
                                        <input type="date" class="form-control @error('dataNascimento') is-invalid @enderror" id="dataNascimento" name="dataNascimento" value="{{old('dataNascimento')}}">
                                        <div class="invalid-feedback">
                                            @error('dataNascimento')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="cpf" class="form-label">CPF<h11 class="text-danger">*</h11> </label>
                                        <input type="number" class="form-control @error('cpf') is-invalid @enderror" id="cpf" name="cpf" value="{{old('cpf')}}">
                                        <div class="invalid-feedback">
                                            @error('cpf')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="formacao" class="form-label">Formação</label>
                                        <select class="form-select" name="formacao_id">
                                            <option selected>Selecione</option>
                                            @foreach($formacoes as $formacao)
                                                <option value="{{ $formacao->id }}" {{ old('formacao_id') == $formacao->id ? 'selected' : '' }}>{{ $formacao->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cargo" class="form-label">Cargo<h11 class="text-danger">*</h11> </label>
                                        <select class="form-select" name="cargo_id">
                                            <option selected>Selecione</option>
                                            @foreach($cargos as $cargo)
                                                <option value="{{$cargo->id}}" {{ old('cargo_id') == $cargo->id ? 'selected' : '' }}>{{$cargo->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="conselho" class="form-label">Conselho<h11 class="text-danger">*</h11> </label>
                                        <select class="form-select" name="conselho">
                                            <option selected>Selecione</option>
                                            <option value="COREN">COREN</option>
                                            <option value="CRAS">CRAS</option>
                                            <option value="CRBM">CRBM</option>
                                            <option value="CREFITO">CREFITO</option>
                                            <option value="CRF">CRF</option>
                                            <option value="CRFA">CRFA</option>
                                            <option value="CRM" selected="">CRM</option>
                                            <option value="CRN">CRN</option>
                                            <option value="CRO">CRO</option>
                                            <option value="CRP">CRP</option>
                                            <option value="CRTR">CRTR</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="registro" class="form-label">Registro Profissional<h11 class="text-danger">*</h11> </label>
                                        <input type="number" class="form-control @error('registro') is-invalid @enderror" id="registro" name="registro" value="{{old('registro')}}">
                                        <div class="invalid-feedback">
                                            @error('registro')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="rqe" class="form-label">Registro de qualificação de especialista (RQE)</label>
                                        <input type="text" class="form-control" id="rqe" name="rqe" value="{{old('rqe')}}">
                                        <div class="invalid-feedback">
                                            @error('rqe')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <p style="text-align: right;">
                                            <a href="{{route('index')}}" class="btn btn-warning btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-arrow-left"></i>
                                                </span>
                                                <span class="text">Voltar</span>
                                            </a>
                                            <button type="submit" class="btn btn-primary btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-check-square"></i>
                                                </span>
                                                <span class="text">Gravar</span>
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
            output.src = '{{ asset('img/logo/user-admin.jpg') }}'; // Imagem padrão
            document.getElementById('upload_foto').value = ''; // Limpa o campo de upload
        }
    }
</script>

@endpush
