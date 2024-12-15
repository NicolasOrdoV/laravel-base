@extends('dashboard.layout')

@section('contact')
    @include('dashboard.fragment._errors-form')

    <h1>{{ $permission->name }}</h1>
@endsection
