<div class="card card-white">
    {{-- {{ $changeTitle() }} --}}
    {{-- {{ $titulo }} --}}
    <h1>{{ $post->title }}</h1>
    <span>{{ $post->category->title }}</span>
    {{ $attributes->filter((fn($value, $key) => $key == 'data-id')) }}
    <hr>
    <p>{{ $post->content }}</p>
</div>
