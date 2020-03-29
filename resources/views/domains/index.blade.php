@extends('layouts.app')
@php
/**
 * @var \Illuminate\Support\Collection|stdClass[] $domains
 * @var \Illuminate\Support\Collection|stdClass[] $checks
 */
@endphp
@section('content')
    <table class="table table-borderless">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Code</th>
            <th scope="col">Last check</th>
        </tr>
        </thead>
        <tbody>
        @foreach($domains as $domain)
            <tr>
                <th>{{ $domain->id }}</th>
                <td><a href="{{ route('domains.show', $domain->id) }}">{{ $domain->name }}</a></td>
                <td>{{ optional($checks->get($domain->id))->status_code ?? "Unknown" }}</td>
                <td>{{ optional($checks->get($domain->id))->created_at ?? "Unknown" }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
