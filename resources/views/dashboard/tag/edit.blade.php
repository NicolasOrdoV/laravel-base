@extends('dashboard.layout')

@section('contact')
    @include('dashboard.fragment._errors-form')

    <form action="{{ route('tag.update', $tag->id) }}" method="post" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @include('dashboard.tag._form')
    </form>
@endsection
