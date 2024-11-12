<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Soy el maestro</title>
</head>

<body>
    @session('key')
        <h1>{{ $value }}</h1>
    @endsession
    @if (session('status'))
        {{ session('status') }}
    @endif
    <br>
    @yield('contact')
    <section>
        @yield('morecontact')
    </section>
</body>

</html>
