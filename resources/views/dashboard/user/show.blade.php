@extends('dashboard.layout')

@section('contact')
    @include('dashboard.fragment._errors-form')

    <h1>{{ $user->name }}</h1>
    <x-dashboard.user.role.permission.manage :user="$user" />
@endsection
