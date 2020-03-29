<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token" />
</head>
<body>
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-auto w-100 h-50">
            @include('flash::message')
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('domains.index') }}">Domains</a>
                </li>
            </ul>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Page Analyzer</h5>
                </div>
                <div class="card-body">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
