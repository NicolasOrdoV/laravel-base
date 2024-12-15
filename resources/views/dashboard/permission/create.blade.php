@extends('dashboard.layout')

@section('contact')

    @include('dashboard.fragment._errors-form')

    <form action="{{ route('permission.store') }}" method="post">
        @csrf
        @include('dashboard.permission._form')
    </form>
@endsection
