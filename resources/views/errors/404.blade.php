{{--@extends('errors::minimal')--}}

{{--@section('title', __('Not Found'))--}}
{{--@section('code', '404')--}}
{{--@section('message', __('Página não Encontrada'))--}}
@extends('layouts.app')
@section('title', 'Error 404')
@section('conteudo')

    @push('error404')
        <style>
            /*body {*/
            /*background-color: #2F3242;*/
            /*}*/
            /*svg {*/
            /*position: absolute;*/
            /*top: 50%;*/
            /*left: 50%;*/
            /*margin-top: -250px;*/
            /*margin-left: -400px;*/
            /*}*/
            /*.message-box {*/
            /*height: 200px;*/
            /*width: 380px;*/
            /*position: absolute;*/
            /*top: 50%;*/
            /*left: 50%;*/
            /*margin-top: -100px;*/
            /*margin-left: 50px;*/
            /*color: #FFF;*/
            /*font-family: Roboto;*/
            /*font-weight: 300;*/
            /*}*/
            /*.message-box h1 {*/
            /*font-size: 60px;*/
            /*line-height: 46px;*/
            /*margin-bottom: 40px;*/
            /*}*/
            /*.buttons-con .action-link-wrap {*/
            /*margin-top: 40px;*/
            /*}*/
            /*.buttons-con .action-link-wrap a {*/
            /*background: #68c950;*/
            /*padding: 8px 25px;*/
            /*border-radius: 4px;*/
            /*color: #FFF;*/
            /*font-weight: bold;*/
            /*font-size: 14px;*/
            /*transition: all 0.3s linear;*/
            /*cursor: pointer;*/
            /*text-decoration: none;*/
            /*margin-right: 10px*/
            /*}*/
            /*.buttons-con .action-link-wrap a:hover {*/
            /*background: #5A5C6C;*/
            /*color: #fff;*/
            /*}*/

            /*#Polygon-1 , #Polygon-2 , #Polygon-3 , #Polygon-4 , #Polygon-4, #Polygon-5 {*/
            /*animation: float 1s infinite ease-in-out alternate;*/
            /*}*/
            /*#Polygon-2 {*/
            /*animation-delay: .2s;*/
            /*}*/
            /*#Polygon-3 {*/
            /*animation-delay: .4s;*/
            /*}*/
            /*#Polygon-4 {*/
            /*animation-delay: .6s;*/
            /*}*/
            /*#Polygon-5 {*/
            /*animation-delay: .8s;*/
            /*}*/

            /*@keyframes float {*/
            /*100% {*/
            /*transform: translateY(20px);*/
            /*}*/
            /*}*/
            /*@media (max-width: 450px) {*/
            /*svg {*/
            /*position: absolute;*/
            /*top: 50%;*/
            /*left: 50%;*/
            /*margin-top: -250px;*/
            /*margin-left: -190px;*/
            /*}*/
            /*.message-box {*/
            /*top: 50%;*/
            /*left: 50%;*/
            /*margin-top: -100px;*/
            /*margin-left: -190px;*/
            /*text-align: center;*/
            /*}*/
            /*}*/

            @import url('https://fonts.googleapis.com/css?family=Montserrat:400,600,700');
            @import url('https://fonts.googleapis.com/css?family=Catamaran:400,800');

            .error-container {
                text-align: center;
                font-size: 180px;
                font-family: 'Catamaran', sans-serif;
                font-weight: 800;
                margin: 20px 15px;
            }

            .error-container > span {
                display: inline-block;
                line-height: 0.7;
                position: relative;
                color: #FFB485;
            }

            .error-container > span {
                display: inline-block;
                position: relative;
                vertical-align: middle;
            }

            .error-container > span:nth-of-type(1) {
                color: #D1F2A5;
                animation: colordancing 4s infinite;
            }

            .error-container > span:nth-of-type(3) {
                color: #F56991;
                animation: colordancing2 4s infinite;
            }

            .error-container > span:nth-of-type(2) {
                width: 120px;
                height: 120px;
                border-radius: 999px;
            }

            .error-container > span:nth-of-type(2):before,
            .error-container > span:nth-of-type(2):after {
                border-radius: 0%;
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: inherit;
                height: inherit;
                border-radius: 999px;
                box-shadow: inset 30px 0 0 rgba(209, 242, 165, 0.4),
                inset 0 30px 0 rgba(239, 250, 180, 0.4),
                inset -30px 0 0 rgba(255, 196, 140, 0.4),
                inset 0 -30px 0 rgba(245, 105, 145, 0.4);
                animation: shadowsdancing 4s infinite;
            }

            .error-container > span:nth-of-type(2):before {
                -webkit-transform: rotate(45deg);
                -moz-transform: rotate(45deg);
                transform: rotate(45deg);
            }

            .screen-reader-text {
                position: absolute;
                top: -9999em;
                left: -9999em;
            }

            @keyframes shadowsdancing {
                0% {
                    box-shadow: inset 30px 0 0 rgba(209, 242, 165, 0.4),
                    inset 0 30px 0 rgba(239, 250, 180, 0.4),
                    inset -30px 0 0 rgba(255, 196, 140, 0.4),
                    inset 0 -30px 0 rgba(245, 105, 145, 0.4);
                }
                25% {
                    box-shadow: inset 30px 0 0 rgba(245, 105, 145, 0.4),
                    inset 0 30px 0 rgba(209, 242, 165, 0.4),
                    inset -30px 0 0 rgba(239, 250, 180, 0.4),
                    inset 0 -30px 0 rgba(255, 196, 140, 0.4);
                }
                50% {
                    box-shadow: inset 30px 0 0 rgba(255, 196, 140, 0.4),
                    inset 0 30px 0 rgba(245, 105, 145, 0.4),
                    inset -30px 0 0 rgba(209, 242, 165, 0.4),
                    inset 0 -30px 0 rgba(239, 250, 180, 0.4);
                }
                75% {
                    box-shadow: inset 30px 0 0 rgba(239, 250, 180, 0.4),
                    inset 0 30px 0 rgba(255, 196, 140, 0.4),
                    inset -30px 0 0 rgba(245, 105, 145, 0.4),
                    inset 0 -30px 0 rgba(209, 242, 165, 0.4);
                }
                100% {
                    box-shadow: inset 30px 0 0 rgba(209, 242, 165, 0.4),
                    inset 0 30px 0 rgba(239, 250, 180, 0.4),
                    inset -30px 0 0 rgba(255, 196, 140, 0.4),
                    inset 0 -30px 0 rgba(245, 105, 145, 0.4);
                }
            }

            @keyframes colordancing {
                0% {
                    color: #D1F2A5;
                }
                25% {
                    color: #F56991;
                }
                50% {
                    color: #FFC48C;
                }
                75% {
                    color: #EFFAB4;
                }
                100% {
                    color: #D1F2A5;
                }
            }

            @keyframes colordancing2 {
                0% {
                    color: #FFC48C;
                }
                25% {
                    color: #EFFAB4;
                }
                50% {
                    color: #D1F2A5;
                }
                75% {
                    color: #F56991;
                }
                100% {
                    color: #FFC48C;
                }
            }

            /* demo stuff */
            * {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }

            body {
                background-color: #416475;
                margin-bottom: 50px;
            }

            html, button, input, select, textarea {
                font-family: 'Montserrat', Helvetica, sans-serif;
                color: #92a4ad;
            }

            h1 {
                text-align: center;
                margin: 30px 15px;
            }

            .zoom-area {
                max-width: 490px;
                margin: 30px auto 30px;
                font-size: 19px;
                text-align: center;
            }

            .link-container {
                text-align: center;
            }

            a.more-link {
                text-transform: uppercase;
                font-size: 13px;
                background-color: #92a4ad;
                padding: 10px 15px;
                border-radius: 0;
                color: #416475;
                display: inline-block;
                margin-right: 5px;
                margin-bottom: 5px;
                line-height: 1.5;
                text-decoration: none;
                margin-top: 50px;
                letter-spacing: 1px;
            }
        </style>
    @endpush
    {{--<svg width="380px" height="500px" viewBox="0 0 837 1045" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">--}}
    {{--    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">--}}
    {{--        <path d="M353,9 L626.664028,170 L626.664028,487 L353,642 L79.3359724,487 L79.3359724,170 L353,9 Z" id="Polygon-1" stroke="#007FB2" stroke-width="6" sketch:type="MSShapeGroup"></path>--}}
    {{--        <path d="M78.5,529 L147,569.186414 L147,648.311216 L78.5,687 L10,648.311216 L10,569.186414 L78.5,529 Z" id="Polygon-2" stroke="#EF4A5B" stroke-width="6" sketch:type="MSShapeGroup"></path>--}}
    {{--        <path d="M773,186 L827,217.538705 L827,279.636651 L773,310 L719,279.636651 L719,217.538705 L773,186 Z" id="Polygon-3" stroke="#795D9C" stroke-width="6" sketch:type="MSShapeGroup"></path>--}}
    {{--        <path d="M639,529 L773,607.846761 L773,763.091627 L639,839 L505,763.091627 L505,607.846761 L639,529 Z" id="Polygon-4" stroke="#F2773F" stroke-width="6" sketch:type="MSShapeGroup"></path>--}}
    {{--        <path d="M281,801 L383,861.025276 L383,979.21169 L281,1037 L179,979.21169 L179,861.025276 L281,801 Z" id="Polygon-5" stroke="#36B455" stroke-width="6" sketch:type="MSShapeGroup"></path>--}}
    {{--    </g>--}}
    {{--</svg>--}}
    {{--<div class="message-box">--}}
    {{--    <h1 class="text-black-50">404</h1>--}}
    {{--    <p class="text-black-50">Página não encontrada</p>--}}
    {{--    <div class="buttons-con">--}}
    {{--        <div class="action-link-wrap">--}}
    {{--            <a onclick="history.back(-1)" class="link-button link-back-button">Voltar</a>--}}
    {{--            <a href="" class="link-button">Página Inicial</a>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--</div>--}}

    {{--<h1>404 Error Page #3</h1>--}}
    <p class="zoom-area"><b>Página não encontrada </b></p>
    <section class="error-container">
        <span>4</span>
        <span><span class="screen-reader-text">0</span></span>
        <span>4</span>
    </section>
    <div class="link-container">
        <a href="{{ route('index') }}" class="more-link">Voltar
            ao Inicio</a>
    </div>
@endsection
