@extends('layouts.app')

@section('title', 'Sobre Mim')
@section('conteudo')
    <style>
        .features {
            background-color: #f3e5f5;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .feature-item {
            margin-bottom: 10px;
            display: flex;
            align-items: flex-start;
        }

        .feature-icon {
            color: #6a3093;
            margin-right: 10px;
            font-weight: bold;
        }

        .mission {
            font-style: italic;
            text-align: center;
            margin: 30px 0;
            padding: 15px;
            background-color: #e8f5e9;
            border-left: 4px solid #4caf50;
        }

        .contact {
            text-align: center;
            margin-top: 30px;
        }

        .contact a {
            color: #6a3093;
            text-decoration: none;
            font-weight: bold;
        }

        .contact a:hover {
            text-decoration: underline;
        }
    </style>

    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Sistema MEOWS DIGITAL para Parturientes - Inovação
                    tecnológica para a saúde materna</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">

                    <div class="card mb-4 py-3 border-left-primary">
                        <div class="card-body">
                            <h2>Jonathan Teixeira</h2>
                            <p>Estudante do 8º semestre de <strong>Sistemas de Informação</strong> e
                                desenvolvedor deste sistema como parte do meu Trabalho de Final de Graduação (TFG).</p>
                        </div>
                    </div>

                    <section>
                        <h2>Sobre o Projeto</h2>
                        <p>O <strong>Sistema MEOWS</strong> (Modified Early Obstetric Warning System) foi
                            desenvolvido como uma plataforma web inovadora para auxiliar profissionais da saúde no
                            acompanhamento de parturientes, garantindo <strong>agilidade, precisão e segurança</strong>
                            na avaliação de resultados e diagnósticos.</p>

                        <div class="card mb-4 py-3 border-left-primary">
                            <div class="card-body">
                                <h3>Principais Funcionalidades:</h3>
                                <div class="feature-item">
                                    <span class="feature-icon">✓</span>
                                    <span>Monitoramento em tempo real dos sinais vitais conforme protocolo MeOWS</span>
                                </div>
                                <div class="feature-item">
                                    <span class="feature-icon">✓</span>
                                    <span>Sistema de alertas automatizados para potenciais complicações</span>
                                </div>
                                <div class="feature-item">
                                    <span class="feature-icon">✓</span>
                                    <span>Interface intuitiva desenvolvida especificamente para fluxos obstétricos</span>
                                </div>
                                <div class="feature-item">
                                    <span class="feature-icon">✓</span>
                                    <span>Armazenamento seguro de dados clínicos para análise e tomada de decisão</span>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section>
                        <h2>Motivação</h2>
                        <p>Durante minha formação em Sistemas de Informação e pesquisas na área de saúde digital,
                            identifiquei a oportunidade de aplicar meus conhecimentos técnicos para criar uma solução
                            que possa
                            <strong>impactar positivamente a saúde materna</strong>.</p>
                        <p>Este projeto representa a união entre minha paixão por tecnologia e meu desejo de contribuir
                            para áreas sociais essenciais, como a saúde pública.</p>
                    </section>

                    <div class="card bg-primary text-white shadow mb-3" style="opacity: 0.8">
                        <div class="card-body">
                            <p style="text-align: center"><code style="color: #FFFFFF">"Acredito que a tecnologia, quando bem aplicada, pode transformar realidades. Meu objetivo
                            com este sistema é oferecer aos profissionais de saúde uma ferramenta que potencialize seu
                                    trabalho e contribua para partos mais seguros."</code></p>
                        </div>
                    </div>

                    <section>
                        <h2>Objetivos Acadêmicos</h2>
                        <p>Como Trabalho de Final de Graduação, este projeto busca:</p>
                        <ul>
                            <li>Demonstrar a aplicação prática dos conhecimentos adquiridos durante o curso</li>
                            <li>Explorar o desenvolvimento de sistemas para áreas específicas como a saúde</li>
                            <li>Contribuir para o campo de Sistemas de Informação com uma solução inovadora</li>
                        </ul>
                    </section>

                    <div class="contact">
                        <h2>Contato</h2>
                        <p>Para mais informações sobre o projeto ou possíveis colaborações:</p>
                        <p>Email: <a href="mailto:jonathan.teixeira@ufn.edu.br">jonathan.teixeira@ufn.edu.br</a></p>
                        <p>LinkedIn: <a href="https://www.linkedin.com/in/jonathan-teixeira-636b3475/" target="_blank">linkedin.com/in/jonathanteixeira</a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
