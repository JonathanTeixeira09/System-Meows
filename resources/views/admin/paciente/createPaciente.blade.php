@extends('layouts.app')

@section('title', 'Cadastro Paciente')
@section('conteudo')
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Adicionar Paciente</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <div class="row">
                        <div class="col-sm-2 form-group text-center align-self-auto">
                            <img class="img-thumbnail" src="img/logo/user-admin.jpg" width="150px" height="130px"
                                 id="foto_thumbnail">
                            <button id="upload_foto" type="button" class="btn btn-sm btn-primary mt-2 mb-0 w-100"
                                    title="Fazer upload da foto" data-toggle="modal" data-target=".modal-lg">
                                <i class="fa fa-camera"></i>
                                <span>Carregar Foto</span>
                            </button>
                        </div>

                        <div class="col-md-10">
                            <div class="col-md-12">
                                <p class="help-block" style="text-align: right;">
                                    <h11 class="text-danger">*</h11>
                                    Campo Obrigatório
                                </p>
                            </div>

                            <form class="row g-3">
                                <div class="col-md-6">
                                    <label for="nome" class="form-label">Nome
                                        <h11 class="text-danger">*</h11>
                                    </label>
                                    <input type="text" class="form-control" id="nome">
                                </div>
                                <div class="col-md-3">
                                    <label for="sexo" class="form-label">Sexo
                                        <h11 class="text-danger">*</h11>
                                    </label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Selecione</option>
                                        <option value="1">Feminino</option>
                                        <option value="2">Masculino</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="dtNasc" class="form-label">Data Nascimento
                                        <h11 class="text-danger">*</h11>
                                    </label>
                                    <input type="date" class="form-control" id="dtNasc">
                                </div>

                                <div class="col-md-4">
                                    <label for="cpf" class="form-label">CPF
                                        <h11 class="text-danger">*</h11>
                                    </label>
                                    <input type="text" class="form-control" id="cpf">
                                </div>
                                <div class="col-md-4">
                                    <label for="rg" class="form-label">RG</label>
                                    <input type="text" class="form-control" id="rg">
                                </div>
                                <div class="col-md-4">
                                    <label for="dataGestacao" class="form-label">Data Gestação</label>
                                    <input type="date" class="form-control" id="dataGestacao">
                                </div>

                                <div class="col-md-6">
                                    <label for="nomeMae" class="form-label">Nome da Mãe</label>
                                    <input type="text" class="form-control" id="nomeMae">
                                </div>
                                <div class="col-md-6">
                                    <label for="nomePai" class="form-label">Nome do Pai</label>
                                    <input type="text" class="form-control" id="nomePai">
                                </div>

                                <div class="col-md-4">
                                    <label for="cns" class="form-label">CNS</label>
                                    <input type="text" class="form-control" id="cns"
                                           placeholder="Cartão Nacional de Saúde">
                                </div>
                                <div class="col-md-4">
                                    <label for="codProntuario" class="form-label">Código Prontuário</label>
                                    <input type="text" class="form-control" id="codProntuario"
                                           placeholder="Gerado automaticamente">
                                </div>
                                <div class="form-check col-md-4 align-self-lg-end">
                                    <input class="form-check-input" type="checkbox" id="gridCheck">
                                    <label class="form-check-label" for="gridCheck">
                                        Ativo
                                    </label>
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
                                            <input type="text" class="form-control" placeholder="" aria-label="cep" aria-describedby="basic-addon2">
                                            <span class="input-group-text" id="basic-addon2"><i class="fas fa-search"></i></span></span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="uf" class="form-label">UF</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>--</option>
                                            <option value="1">RS</option>
                                            <option value="2">SC</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="cidade" class="form-label">Cidade</label>
                                        <input type="text" class="form-control" id="cidade">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="bairro" class="form-label">Bairro</label>
                                        <input type="text" class="form-control" id="bairro">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="logradouro" class="form-label">Logradouro</label>
                                        <input type="text" class="form-control" id="logradouro">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="numero" class="form-label">Número</label>
                                        <input type="text" class="form-control" id="numero">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="complemento" class="form-label">Complemento</label>
                                        <input type="text" class="form-control" id="complemento">
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
                                               placeholder="Informe um email válido">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="celular" class="form-label">Celular</label>
                                        <input type="text" class="form-control" id="celular">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="celular2" class="form-label">Celular 2</label>
                                        <input type="text" class="form-control" id="celular2">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="fixo" class="form-label">Telefone Fixo</label>
                                        <input type="text" class="form-control" id="fixo">
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
                                        <label for="exampleFormControlTextarea1" class="form-label"></label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <p style="text-align: right;">
                                        <a href="#" class="btn btn-primary btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-check-square"></i>
                                            </span>
                                            <span class="text">Gravar</span>
                                        </a>
                                        <a href="{{route('index')}}" class="btn btn-warning btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-arrow-left"></i>
                                            </span>
                                            <span class="text">Voltar</span>
                                        </a>
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
