@extends('dashboard.layout')

@section('contact')
    @can('editor.user.create')
        <a href="{{ route('user.create') }}" class="btn btn-success mt-3"> Crear + </a>
    @endcan
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->rol }}</td>
                    <td>
                        @can('editor.user.update')
                            <a href="{{ route('user.edit', $u->id) }}" class="btn btn-warning mt-2"> Editar </a>
                        @endcan
                        <a href="{{ route('user.show', $u->id) }}" class="btn btn-primary mt-2"> Show </a>
                        @can('editor.user.destroy')
                            <form method="post" action="{{ route('user.destroy', $u->id) }}">
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
        {{ $users->links() }}
    </div>
@endsection
