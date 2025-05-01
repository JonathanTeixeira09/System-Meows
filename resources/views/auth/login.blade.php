<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('title')">
    <meta name="author" content="Jonathan">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('img/logo/logo.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo/logo-site.ico') }}">
    <title> @yield('title')</title>

    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/sign-in.css') }}">

    <style>
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        html,
        body {
            height: 100%;
            /*background: url("./img/bg.jpg");*/
            /*background-image: url('img/bg2.jpg') !important;*/
            /*background-size: cover;*/
            /*background-position: center;*/

        }

    </style>

</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">

<main class="form-signin w-100 m-auto">
    <form action="{{route('login.store')}}" method="post">
        @csrf
        <center><img class="mb-2" src="img/logo/logo.png" alt="logo" width="230" height="230"></center>
        <h1 class="h4 mb-2 fw-normal"><center>MEOWS DIGITAL</center></h1>

        <!-- Mensagem de erro de login -->
        @if(session('error') || $errors->has('errorLogin'))
            <div class="alert alert-danger messageBox" role="alert">
                {{ session('error') ?? $errors->first('errorLogin') }}
            </div>
        @endif

        <div class="form-floating">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                   placeholder="name@example.com" value="{{ old('email') }}">
            <label for="floatingInput">Email</label>
            <div class="invalid-feedback">
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-floating">
            <input type="password" class="form-control  @error('password') is-invalid @enderror" id="password"
                   name="password" placeholder="Password">
            <label for="floatingPassword">Password</label>
            <div class="invalid-feedback">
                @error('password')
                {{ $message }}
                @enderror
            </div>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">Acessar</button>
        <p class="mb-3 text-muted"><center> &copy; 2025 - Sistema MEOWS DIGITAL</center></p>

    </form>
</main>


<script src="{{ asset('js/booststrap.bundle.min.js')}}"></script>
</body>
</html>
