@extends('dashboard.layout')

@section('contact')
    @include('dashboard.fragment._errors-form')

    <h1>{{ $post->title }}</h1>
    <div>
        {{ $post->content }}
    </div>
    <div>
        {{ $post->description }}
    </div><br>
    <span>
        <img src="/upload/post/{{ $post->image }}" style="width: 250px" alt="{{ $post->description }}">
    </span>
@endsection
