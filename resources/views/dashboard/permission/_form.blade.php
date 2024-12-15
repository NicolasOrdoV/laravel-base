@csrf
<label for="">Name</label>
<input class="form-control" name="name" type="text" value="{{ old('name', $permission->name) }}"><br>
<button type="submit" class="btn btn-success mt-2">Enviar</button>
