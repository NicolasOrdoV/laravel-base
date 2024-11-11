@extends('dashboard.layout')

@section('contact')
    @include('dashboard.fragment._errors-form')

    <h1>{{ $category->title }}</h1>
@endsection
