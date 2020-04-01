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
    <meta name="description" content="Seo Page analyzer">
    <meta name="keywords" content="hexlet php laravel project">

</head>
<body>
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-auto w-100 h-50">
            @include('flash::message')
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" href="/">@lang('home')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('domains.index') }}">@lang('domains')</a>
                </li>
            </ul>
            <div class="card">
                <div class="card-header">
                    <h1 class="h5 card-title">@lang('page_analyzer')</h1>
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
