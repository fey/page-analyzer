@extends('layouts.app')
@php
/**
 * @var stdClass $domain
 */
@endphp
@section('content')
    <h5 class="card-title">{{ $domain->name }}</h5>
    <p class="card-text">
        Added at: {{ $domain->created_at }}<br>
        Last check: {{ $lastCheck }}
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
                <th scope="col">ID</th>
                <th scope="col">Checked at</th>
            </tr>
            </thead>
            <tbody>
            @foreach($checks as $check)
                <tr>
                    <th>{{ $check->id }}</th>
                    <td>{{ $check->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        @endif
    </table>
@endsection
