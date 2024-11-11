@extends('dashboard.layout')

@section('contact')
    <a href="{{ route('post.create') }}"> Crear + </a>
    <table>
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
                        <a href="{{ route('post.edit', $p->id) }}"> Editar </a>
                        <a href="{{ route('post.show', $p->id) }}"> Show </a>
                        <form method="post" action="{{route('post.destroy', $p->id)}}">
                            @method('delete')
                            @csrf
                            <button type="submit">Eliminar</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $posts->links() }}
@endsection
