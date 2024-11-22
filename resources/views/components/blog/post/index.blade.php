<div>
    <br>
    <h1>{{ $slot }}</h1>
    @if (isset($header))
        <h1>{{ $header }}</h1>
    @endif

    @foreach ($posts as $p)
        <div class="card card-white mt-2">
            <h3>{{ $p->title }}</h3>
            <a href="{{ route('blog.show', $p) }}">Ir</a>
            <p>{{ $p->description }}</p>
        </div>
    @endforeach
    <br>
    @if (isset($extra))
        <h1>{{ $extra }}</h1>
    @endif
    @if (isset($footer))
        <h1>{{ $footer }}</h1>
    @endif
    {{ $posts->links() }}
</div>
