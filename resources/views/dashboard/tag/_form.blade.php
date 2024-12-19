@csrf
<label for="">Name</label>
<input class="form-control" name="name" type="text" value="{{ old('name', $tag->name) }}"><br>
<button type="submit" class="btn btn-success mt-2">Enviar</button>
