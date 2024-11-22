@extends('blog.layout')

@section('content')
    <x-blog.post.index :posts='$posts'>

        @slot('header')
        Post list
        @endslot
        @slot('footer')
            Footer
        @endslot
        @slot('extra', 'Extra')
    </x-blog.post.index>
@endsection
