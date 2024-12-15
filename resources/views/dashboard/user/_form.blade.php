@csrf
<label for="">Name</label>
<input class="form-control" name="name" type="text" value="{{ old('name', $user->name) }}"><br>
<label for="">Email</label>
<input class="form-control" name="email" type="email" value="{{ old('email', $user->email) }}"><br>
<label for="">Password</label>
<input class="form-control" name="password" type="password"><br>
<label for="">Password confirm</label>
<input class="form-control" name="password_confirmation" type="password"><br>
<button type="submit" class="btn btn-success mt-2">Enviar</button>
