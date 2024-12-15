@extends('dashboard.layout')

@section('contact')

    @include('dashboard.fragment._errors-form')

    <form action="{{ route('role.store') }}" method="post">
        @csrf
        @include('dashboard.role._form')
    </form>
@endsection
