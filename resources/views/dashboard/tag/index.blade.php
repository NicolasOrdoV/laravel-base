@extends('dashboard.layout')

@section('contact')
    {{-- @can('editor.tag.create') --}}
        <a href="{{ route('tag.create') }}" class="btn btn-success mt-3"> Crear + </a>
    {{-- @endcan --}}
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $t)
                <tr>
                    <td>{{ $t->id }}</td>
                    <td>{{ $t->name }}</td>
                    <td>
                        {{-- @can('editor.tag.update') --}}
                            <a href="{{ route('tag.edit', $t->id) }}" class="btn btn-warning mt-2"> Editar </a>
                        {{-- @endcan --}}
                        <a href="{{ route('tag.show', $t->id) }}" class="btn btn-primary mt-2"> Show </a>
                        {{-- @can('editor.tag.delete') --}}
                            <form method="post" action="{{ route('tag.destroy', $t->id) }}">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger mt-2">Eliminar</button>
                            </form>
                        {{-- @endcan --}}

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-2">
        {{ $tags->links() }}
    </div>
@endsection
