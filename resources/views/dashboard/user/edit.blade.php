@extends('dashboard.layout')

@section('contact')
    @include('dashboard.fragment._errors-form')

    <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @include('dashboard.user._form')
    </form>
@endsection
