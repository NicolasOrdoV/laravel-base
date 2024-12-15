@extends('dashboard.layout')

@section('contact')
    @include('dashboard.fragment._errors-form')

    <form action="{{ route('role.update', $role->id) }}" method="post" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @include('dashboard.role._form')
    </form>
@endsection
