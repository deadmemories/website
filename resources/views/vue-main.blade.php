<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta id="token" name="token" value="{{csrf_token()}}">
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/bower_components/materialize/dist/css/materialize.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/fonts.css') }}">
    <title>Document</title>
</head>
<body>
    <div id="app">
         <router-view></router-view>
    </div>

    {{--<script src="//cdn.jsdelivr.net/alertifyjs/1.9.0/alertify.min.js"></script>--}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('/bower_components/jquery/dist/jquery.js') }}"></script>
    <script src="{{ asset('/bower_components/materialize/dist/js/materialize.js') }}"></script>
    <script src="{{ asset('js/for-materialize.js') }}"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.3/socket.io.js"></script>--}}
</body>
</html>
