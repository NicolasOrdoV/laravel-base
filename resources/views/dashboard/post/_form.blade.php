@csrf
<label for="">Title</label>
<input class="form-control" name="title" type="text" value="{{ old('title', $post->title) }}"><br>
<label for="">Slug</label>
<input class="form-control" name="slug" type="text" value="{{ old('slug', $post->slug) }}"><br>
<label for="">Content</label>
<textarea class="form-control" name="content">{{ $post->content }}</textarea><br>

<label for="">Category</label>
<select class="form-control" name="category_id">
    @foreach ($categories as $title => $id)
        <option value="{{ $id }}" {{ old('category_id', $post->category_id) == $id ? 'selected' : '' }}>
            {{ $title }}
        </option>
    @endforeach
</select><br>
<label for="">Description</label>
<textarea class="form-control" name="description">{{ old('description', $post->description) }}</textarea><br>
<label for="">Posted</label>
<select class="form-control" name="posted">
    <option {{ old('posted', $post->posted) == 'yes' ? 'selected' : '' }} value="yes">yes</option>
    <option {{ old('posted', $post->posted) == 'not' ? 'selected' : '' }} value="not">not</option>
</select><br>
@if (isset($task) && $task == 'edit')
    <label for="">Image</label>
    <input class="form-control" type="file" name="image"><br>
@endif
<button type="submit" class="btn btn-success mt-2">Enviar</button>
