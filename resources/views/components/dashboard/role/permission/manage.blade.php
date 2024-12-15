<div>
    <h3>Permissions</h3>
    <ul id="permissionListRol">
        @foreach ($permissionsRole as $p)
            {{-- <form action="{{ route('role.delete.permission', $role->id) }}" method="post">
                @csrf
                @method('delete') --}}
            <li class="per_{{ $p->id }}">
                {{ $p->name }}
                <input type="hidden" name="permission" value="{{ $p->id }}">
                <button type="button" class="btn btn-danger" data-per-id="{{ $p->id }}">Delete</button>
                {{-- </form> --}}
            </li>
        @endforeach
    </ul>
    <h3>Assign</h3>
    {{-- <form action="{{ route('role.assign.permission', $role->id) }}" method="post"> --}}
    @csrf
    <select name="permission">
        @foreach ($permissions as $p)
            <option value="{{ $p->id }}">{{ $p->name }}</option>
        @endforeach
    </select>
    <button type="button" id='buttonAsignPermission'>Send</button>
    {{-- </form> --}}
</div>
<script>
    document.getElementById('buttonAsignPermission').addEventListener('click', function() {
        assingPermissionToRol({{ $role->id }})
    })

    function setListenerToDeletePermission() {
        document.querySelectorAll("#permissionListRol button").forEach(b => {
            b.addEventListener('click', function() {
                let perId = b.getAttribute('data-per-id')
                axios.post('{{ route('role.delete.permission', $role->id) }}', {
                    'permission': perId
                }).then((res) => {
                    document.querySelector('.per_' + perId).remove()
                })
            })
        })
    }

    setListenerToDeletePermission()

    function assingPermissionToRol(roleId) {

        const perId = document.querySelector('select[name="permission"]').value
        if(document.querySelector('.per_' + perId) !== null) {
            return alert("permiso repetido")
        }

        axios.post('{{ route('role.assign.permission', $role->id) }}', {
            'permission': perId
        }).then((res) => {
            document.querySelector("#permissionListRol").innerHTML +=
                ` <li class="per_${ res.data.id }">${ res.data.name }</li><button type="button" class="btn btn-danger" data-per-id="${ res.data.id }">Delete</button> `
            setListenerToDeletePermission()
        })
    }
</script>
