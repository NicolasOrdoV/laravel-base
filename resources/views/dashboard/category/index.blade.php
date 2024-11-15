@extends('dashboard.layout')

@section('contact')
    <a href="{{ route('category.create') }}" class="btn btn-success mt-3"> Crear + </a>
    <table class="table">
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
                        <a href="{{ route('category.edit', $c->id) }}" class="btn btn-warning mt-2"> Editar </a>
                        <a href="{{ route('category.show', $c->id) }}" class="btn btn-primary mt-2"> Show </a>
                        <form method="post" action="{{route('category.destroy', $c->id)}}">
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
        {{ $categories->links() }}
    </div>

@endsection
