@extends('dashboard.layout')

@section('contact')
    @include('dashboard.fragment._errors-form')

    <form action="{{ route('permission.update', $permission->id) }}" method="post" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @include('dashboard.permission._form')
    </form>
@endsection
