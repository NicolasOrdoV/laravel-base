@extends('dashboard.layout')

@section('contact')

    @include('dashboard.fragment._errors-form')

    <form action="{{ route('post.store') }}" method="post">
        @csrf
        @include('dashboard.post._form')
    </form>
@endsection
