@csrf
<label for="">Title</label>
<input name="title" type="text" value="{{ old('title', $category->title) }}"><br>
<label for="">Slug</label>
<input name="slug" type="text" value="{{ old('slug', $category->slug) }}"><br>
<button type="submit">Enviar</button>
