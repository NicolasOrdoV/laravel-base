@extends('dashboard.layout')

@section('contact')

    @include('dashboard.fragment._errors-form')

    <form action="{{ route('tag.store') }}" method="post">
        @csrf
        @include('dashboard.tag._form')
    </form>
@endsection
