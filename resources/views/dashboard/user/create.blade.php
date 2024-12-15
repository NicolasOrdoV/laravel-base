@extends('dashboard.layout')

@section('contact')

    @include('dashboard.fragment._errors-form')

    <form action="{{ route('user.store') }}" method="post">
        @csrf
        @include('dashboard.user._form')
    </form>
@endsection
