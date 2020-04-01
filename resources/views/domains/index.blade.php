@extends('layouts.app')
@php
/**
 * @var \Illuminate\Support\Collection|stdClass[] $domains
 * @var \Illuminate\Support\Collection|stdClass[] $checks
 * @var stdClass $nullCheck
 */
@endphp
@section('content')
    <table class="table table-borderless">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">@lang('name')</th>
            <th scope="col">@lang('status_code')</th>
            <th scope="col">@lang('last_check')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($domains as $domain)
            <tr>
                <th>{{ $domain->id }}</th>
                <td><a href="{{ route('domains.show', $domain->id) }}">{{ $domain->name }}</a></td>
                <td>{{ $checks->get($domain->id, $nullCheck)->status_code }}</td>
                <td>{{ $checks->get($domain->id, $nullCheck)->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
