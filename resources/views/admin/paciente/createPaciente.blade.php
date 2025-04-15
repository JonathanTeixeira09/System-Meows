@extends('layouts.app')

@section('title', 'Cadastro Paciente')
@section('conteudo')
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-3">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Adicionar Nova Paciente</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <!-- Formulario -->
                    <form class="row g-3" action="{{route('cadastrarpaciente.store')}}" method="POST" name="formCadastroProfissional" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- thumbnail -->
                            <div class="col-sm-2 form-group text-center align-self-top mt-4">
                                    <img class="img-thumbnail" src="img/logo/paciente.png" width="150px" height="130px" id="foto_thumbnail">

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
                                        <label for="nome" class="form-label">Nome
                                            <h11 class="text-danger">*</h11>
                                        </label>
                                        <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome') }}">
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
                                            <!-- <option selected>Selecione</option> -->
                                            <option value="Feminino" selected>Feminino</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Outro">Outros</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="data_nascimento" class="form-label">Data Nascimento<h11 class="text-danger">*</h11></label>
                                        <input type="date" class="form-control @error('data_nascimento') is-invalid @enderror " id="dtNasc" name="data_nascimento" value="{{ old('data_nascimento') }}">
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
                                        <input type="text" class="form-control @error('cpf') is-invalid @enderror" id="cpf" name="cpf" value="{{ old('cpf') }}">
                                        <div class="invalid-feedback">
                                            @error('cpf')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="rg" class="form-label">RG</label>
                                        <input type="text" class="form-control" id="rg" name="rg" value="{{ old('rg') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="data_gestacao" class="form-label">Data Gestação
                                            <h11 class="text-danger">*</h11>
                                        </label>
                                        <input type="date" class="form-control @error('data_gestacao') is-invalid @enderror" id="data_gestacao" name="data_gestacao" value="{{ old('data_gestacao') }}">
                                        <div class="invalid-feedback">
                                            @error('data_gestacao')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="nome_mae" class="form-label">Nome da Mãe</label>
                                        <input type="text" class="form-control" id="nome_mae" name="nome_mae" value="{{ old('nome_mae') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nome_pai" class="form-label">Nome do Pai</label>
                                        <input type="text" class="form-control" id="nome_pai" name="nome_pai" value="{{ old('nome_pai') }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="cns" class="form-label">CNS</label>
                                        <input type="text" class="form-control" id="cns" name="cns" value="{{ old('cns') }}"
                                            placeholder="Cartão Nacional de Saúde">
                                    </div>
                                    <!-- <div class="col-md-4">
                                        <label for="codProntuario" class="form-label">Código Prontuário</label>
                                        <input type="text" class="form-control" id="codProntuario"
                                            placeholder="Gerado automaticamente">
                                    </div> -->
                                    <!-- <div class="form-check col-md-4 align-self-lg-end">
                                        <input class="form-check-input" type="checkbox" id="gridCheck">
                                        <label class="form-check-label" for="gridCheck">
                                            Ativo
                                        </label>
                                    </div> -->
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
                                                <input type="text" class="form-control" placeholder="" id="cep" name="cep" oninput="formatarCEP(this)" maxlength="9" value="{{ old('cep') }}"> <!-- Permite "00000-000" -->
                                                <button type="button" class="btn btn-outline-secondary" onclick="buscarEndereco(event)">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                                <!-- <span class="btn input-group-text" onclick="buscarEndereco()"><i class="fas fa-search"></i></span></span> -->
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="uf" class="form-label">UF</label>
                                            <input type="text" class="form-control" id="uf" name="uf" value="{{ old('uf') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="cidade" class="form-label">Cidade</label>
                                            <input type="text" class="form-control" id="cidade" name="cidade" value="{{ old('cidade') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="bairro" class="form-label">Bairro</label>
                                            <input type="text" class="form-control" id="bairro" name="bairro" value="{{ old('bairro') }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="logradouro" class="form-label">Logradouro</label>
                                            <input type="text" class="form-control" id="logradouro" name="logradouro" value="{{ old('logradouro') }}">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="numero" class="form-label">Número</label>
                                            <input type="text" class="form-control" id="numero" name="numero" value="{{ old('numero') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="complemento" class="form-label">Complemento</label>
                                            <input type="text" class="form-control" id="complemento" name="complemento" value="{{ old('complemento') }}">
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
                                                placeholder="Informe um email válido" name="email" value="{{ old('email') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="celular" class="form-label">Celular</label>
                                            <input type="text" class="form-control" id="celular" name="celular" value="{{ old('celular') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="celular2" class="form-label">Celular 2</label>
                                            <input type="text" class="form-control" id="celular2" name="celular2" value="{{ old('celular2') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="telefone_fixo" class="form-label">Telefone Fixo</label>
                                            <input type="text" class="form-control" id="telefone_fixo" name="telefone_fixo" value="{{ old('telefone_fixo') }}">
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
                                            <textarea class="form-control" id="observacoes" rows="3" name="observacoes">{{ old('observacoes') }}</textarea>
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

@push('photoPacienteJs')
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
            output.src = '{{ asset('img/logo/paciente.png') }}'; // Imagem padrão
            document.getElementById('upload_foto').value = ''; // Limpa o campo de upload
        }
    }
</script>
<script>
   function formatarCEP(input) {
    // Mantém posição do cursor
    const cursorPos = input.selectionStart;

    // Remove não-dígitos e aplica máscara
    let cep = input.value.replace(/\D/g, '');
    if (cep.length > 5) cep = cep.substring(0, 5) + '-' + cep.substring(5, 8);

    // Atualiza valor
    input.value = cep;
    input.setSelectionRange(cursorPos, cursorPos);

    // Busca automática se completo
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
            // Preenche campos MAS mantém editáveis
            document.getElementById('uf').value = data.uf;
            document.getElementById('cidade').value = data.cidade;
            document.getElementById('bairro').value = data.bairro;
            document.getElementById('logradouro').value = data.logradouro;
        }
        // Se não encontrou, simplesmente não faz nada (campos permanecem editáveis)

    } catch (error) {
        console.log("Busca de CEP opcional - não encontrado");
    }
}
</script>
@endpush
