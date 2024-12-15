@extends('dashboard.layout')

@section('contact')
    <a href="{{ route('permission.create') }}" class="btn btn-success mt-3"> Crear + </a>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->name }}</td>
                    <td>
                        <a href="{{ route('permission.edit', $p->id) }}" class="btn btn-warning mt-2"> Editar </a>
                        <a href="{{ route('permission.show', $p->id) }}" class="btn btn-primary mt-2"> Show </a>
                        <form method="post" action="{{route('permission.destroy', $p->id)}}">
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
        {{ $permissions->links() }}
    </div>

@endsection
