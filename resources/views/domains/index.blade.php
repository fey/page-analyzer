@extends('layouts.app')
@php
/**
 * @var array[]|stdClass $domains
 */
@endphp
@section('content')
    <table class="table table-borderless">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach($domains as $domain)
            <tr>
                <th>{{ $domain->id }}</th>
                <td><a href="{{ route('domains.show', $domain->id) }}">{{ $domain->name }}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
