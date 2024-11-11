@extends('dashboard.layout')

@section('contact')
    <a href="{{ route('category.create') }}"> Crear + </a>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->title }}</td>
                    <td>
                        <a href="{{ route('category.edit', $c->id) }}"> Editar </a>
                        <a href="{{ route('category.show', $c->id) }}"> Show </a>
                        <form method="post" action="{{route('category.destroy', $c->id)}}">
                            @method('delete')
                            @csrf
                            <button type="submit">Eliminar</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}
@endsection
