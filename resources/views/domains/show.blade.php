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
        Added at: {{ $domain->created_at }}<br>
        Last check: <br>
        @if($lastCheck)
        Code: {{ $lastCheck->status_code }}
        Date: {{ $lastCheck->created_at }}
        @endif
    </p>
    <form action="{{ route('domains.checks.store', $domain->id) }}" METHOD="post">
        @csrf
        <button type="submit" class="btn btn-primary mb-2">Check</button>
    </form>

    <table class="table table-borderless">
        @if(empty($checks))
            <p class="card-text">No checks yet.</p>
        @else
            <thead>
            <tr>
                <th>ID</th>
                <th>Status code</th>
                <th>H1 tag</th>
                <th>Description</th>
                <th>Keywords</th>
                <th>Checked at</th>
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
