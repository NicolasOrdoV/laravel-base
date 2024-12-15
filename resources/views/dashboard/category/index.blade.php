@extends('dashboard.layout')

@section('contact')
    @can('editor.category.create')
        <a href="{{ route('category.create') }}" class="btn btn-success mt-3"> Crear + </a>
    @endcan
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
                        @can('editor.category.update')
                            <a href="{{ route('category.edit', $c->id) }}" class="btn btn-warning mt-2"> Editar </a>
                        @endcan
                        <a href="{{ route('category.show', $c->id) }}" class="btn btn-primary mt-2"> Show </a>
                        @can('editor.category.delete')
                            <form method="post" action="{{ route('category.destroy', $c->id) }}">
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
        {{ $categories->links() }}
    </div>
@endsection
