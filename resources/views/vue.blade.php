<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>

<body>
    @if (Auth::check())
        <script>
            window.Laravel = {!! json_encode([
                'isLoggedIn' => true,
                'user' => Auth::user(),
                'token' => session('token'),
            ]) !!}
        </script>
    @else
        <script>
            window.Laravel = {!! json_encode([
                'isLoggedIn' => false
            ]) !!}
        </script>
    @endif
    <div class="container mx-auto">
        <div id="app"></div>
    </div>
    @vite(['resources/js/vue/main.js'])
</body>

</html>
