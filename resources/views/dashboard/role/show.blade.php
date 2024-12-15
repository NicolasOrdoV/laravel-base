@extends('dashboard.layout')

@section('contact')
    @include('dashboard.fragment._errors-form')

    <h1>{{ $role->name }}</h1>
    <x-dashboard.role.permission.manage :role="$role">

    </x-dashboard.role.permission.manage>
@endsection
