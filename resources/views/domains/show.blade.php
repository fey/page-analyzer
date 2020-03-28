@extends('layouts.app')
@php
/**
 * @var stdClass $domain
 */
@endphp
@section('content')
    <h5 class="card-title">{{ $domain->name }}</h5>
@endsection
