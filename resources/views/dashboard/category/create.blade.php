@extends('dashboard.layout')

@section('contact')

    @include('dashboard.fragment._errors-form')

    <form action="{{ route('category.store') }}" method="post">
        @csrf
        @include('dashboard.category._form')
    </form>
@endsection
