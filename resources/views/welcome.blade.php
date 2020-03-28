@extends('layouts.app')

@section('content')
    <form action="{{ route('domains.store') }}" class="form-inline" METHOD="POST">
        @csrf
        <input
            name="domain"
            type="url"
            class="form-control mb-2 mr-sm-2"
            id="domain-input"
            placeholder="https://www.example.com"
            required
            autocomplete>
        <button type="submit" class="btn btn-primary mb-2">Submit</button>
    </form>
@endsection
