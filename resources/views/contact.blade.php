@extends('layout')

@section('contact')
    <h1>Contact 1</h1>
    @foreach ($post as $item)
        {{ $item }}
    @endforeach
    {{-- @if ($name != 'andres')
        Tu nombre no es Andres
    @else
        Tu nombre es andres
    @endif

    {{-- <ul>
        @foreach ([1, 2, 3, 4, 5] as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul> --}}
@endsection
