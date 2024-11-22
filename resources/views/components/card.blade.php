{{-- <div {{$attributes->merge(['class' => 'w-full boder shadow-md rounded-md p-5 bg-white'])}}> --}}

@props(['type' => 'info', 'bg' => true])

<div {{ $attributes->class(['w-full boder shadow-md rounded-md p-5 bg-white', 'bg-white' => $bg]) }}>
    {{ $slot }}
    {{-- <h3>{{ $title }}</h3> --}}
    {{ $type }}
    {{ $attributes }}

</div>
