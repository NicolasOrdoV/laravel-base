@extends('dashboard.layout')

@section('contact')
    <a href="{{ route('post.create') }}" class="btn btn-success my-3"> Crear + </a>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Posted</th>
                <th>Category</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->title }}</td>
                    <td>{{ $p->posted }}</td>
                    <td>{{ $p->category->title }}</td>
                    <td>
                        <a href="{{ route('post.edit', $p->id) }}" class="btn btn-warning mt-2"> Editar </a>
                        <a href="{{ route('post.show', $p->id) }}" class="btn btn-primary mt-2"> Show </a>
                        <form method="post" action="{{route('post.destroy', $p->id)}}">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger mt-2">Eliminar</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-2">
        {{ $posts->links() }}
    </div>
@endsection
