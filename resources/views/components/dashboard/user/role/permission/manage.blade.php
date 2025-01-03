<div>
    <h3>Users roles</h3>
    <ul id="rolesListUser">
        @foreach ($user->roles as $r)
            {{-- <form action="{{ route('role.delete.permission', $role->id) }}" method="post">
                @csrf
                @method('delete') --}}
            <li class="role_{{ $r->id }}">
                {{ $r->name }}
                <button type="button" class="btn btn-danger" data-role-id="{{ $r->id }}">Delete</button>
                {{-- </form> --}}
            </li>
        @endforeach
    </ul>
    <h3>Assign's roles</h3>
    <select name="role">
        @foreach ($roles as $r)
            <option value="{{ $r->id }}">{{ $r->name }}</option>
        @endforeach
    </select>
    <button type="button" id='buttonAsignRole'>Send</button>
    <hr class="my-3">
    <h3>User permissions</h3>
    <ul id="permissionListUser">
        @foreach ($user->permissions as $p)
            <li class="permission_{{ $p->id }}">
                {{ $p->name }}
                <button type="button" class="btn btn-danger" data-per-id="{{ $p->id }}">Delete</button>
            </li>
        @endforeach
    </ul>
    <h3>Assign permission</h3>
    <select name="permission">
        @foreach ($permissions as $p)
            <option value="{{ $p->id }}">{{ $p->name }}</option>
        @endforeach
    </select>
    <button type="button" id='buttonAsignPermission'>Send</button>
</div>
{{-- --permiso admin Admin-- --}}
<script>
    document.getElementById('buttonAsignPermission').addEventListener('click', function() {
        assignPermissionsToUser()
    })

    function setListenerToDeletePermission() {
        document.querySelectorAll("#permissionListUser button").forEach(b => {
            b.addEventListener('click', function() {
                let perId = b.getAttribute('data-per-id')
                axios.post('{{ route('user.delete.permission', $user->id) }}', {
                    'permission': perId
                }).then((res) => {
                    document.querySelector('.permission_' + perId).remove()
                })
            })
        })
    }

    setListenerToDeletePermission()

    function assignPermissionsToUser() {

        const rolId = document.querySelector('select[name="permission"]').value
        if (document.querySelector('.role_' + rolId) !== null) {
            return alert("rol repetido")
        }

        axios.post('{{ route('user.assign.permission', $user->id) }}', {
            'permission': rolId
        }).then((res) => {
            document.querySelector("#permissionListUser").innerHTML +=
                ` <li class="permission_${ res.data.id }">${ res.data.name }</li><button type="button" class="btn btn-danger" data-per-id="${ res.data.id }">Delete</button> `
                setListenerToDeletePermission()
        })
    }
</script>
{{-- --Role Admin-- --}}
<script>
    document.getElementById('buttonAsignRole').addEventListener('click', function() {
        assignRoleToUser()
    })

    function assignRoleToUser() {

        const roleId = document.querySelector('select[name="role"]').value
        if (document.querySelector('.role_' + roleId) !== null) {
            return alert('Role already assigned')
        }

        axios.post('{{ route('user.assign.role', $user->id) }}', {
            'role': roleId
        }).then((res) => {
            document.querySelector('#rolesListUser').innerHTML += `
            <li class="role_${ res.data.id } item-list">
                ${res.data.name}
                <button type="button" data-role-id="${ res.data.id }" class='btn-sm btn-danger'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </button>
            </li>
        `

            setListenerToDeleteRole()
        })
    }

    function setListenerToDeleteRole() {
        document.querySelectorAll('#rolesListUser button').forEach(b => {
            b.addEventListener('click', function() {
                let roleId = b.getAttribute('data-role-id')

                axios.post('{{ route('user.delete.role', $user->id) }}', {
                    'role': roleId
                }).then((res) => {
                    document.querySelector('.role_' + roleId).remove()
                })
            })
        });
    }

    setListenerToDeleteRole()
</script>
