@extends('dashboard.layout')

@section('contact')
    @can('editor.post.create')
        <a href="{{ route('post.create') }}" class="btn btn-success my-3"> Crear + </a>
    @endcan

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
                        @can('editor.post.update')
                            <a href="{{ route('post.edit', $p->id) }}" class="btn btn-warning mt-2"> Editar </a>
                        @endcan
                        <a href="{{ route('post.show', $p->id) }}" class="btn btn-primary mt-2"> Show </a>
                        @can('editor.post.delete')
                            <form method="post" action="{{ route('post.destroy', $p->id) }}">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger mt-2">Eliminar</button>
                            </form>
                        @endcan

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-2">
        {{ $posts->links() }}
    </div>
@endsection
