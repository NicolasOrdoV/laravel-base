@csrf
<label for="">Title</label>
<input class="form-control" name="title" type="text" value="{{ old('title', $category->title) }}"><br>
<label for="">Slug</label>
<input class="form-control" name="slug" type="text" value="{{ old('slug', $category->slug) }}"><br>
<button type="submit" class="btn btn-success mt-2">Enviar</button>
