@extends('layouts.app')
@php
/**
 * @var stdClass $domain
 * @var stdClass $lastCheck
 */
@endphp
@section('content')
    <h5 class="card-title">{{ $domain->name }}</h5>
    <p class="card-text">
        @lang('added_at'): {{ $domain->created_at }}<br>
        @lang('last_check'):<br>
        @if($lastCheck)
        @lang('status_code'): {{ $lastCheck->status_code }}
        @lang('date'): {{ $lastCheck->created_at }}
        @endif
    </p>
    <form action="{{ route('domains.checks.store', $domain->id) }}" METHOD="post">
        @csrf
        <button type="submit" class="btn btn-primary mb-2">@lang('start_check')</button>
    </form>

    <table class="table table-borderless">
        @if(empty($checks))
            <p class="card-text">@lang('no_check').</p>
        @else
            <thead>
            <tr>
                <th>#</th>
                <th>@lang('status_code')</th>
                <th>H1 tag</th>
                <th>Description</th>
                <th>Keywords</th>
                <th>@lang('date')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($checks as $check)
                <tr>
                    <td>{{ $check->id }}</td>
                    <td>{{ $check->status_code }}</td>
                    <td>{{ $check->h1 }}</td>
                    <td>{{ $check->description }}</td>
                    <td>{{ $check->keywords }}</td>
                    <td>{{ $check->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        @endif
    </table>
@endsection
