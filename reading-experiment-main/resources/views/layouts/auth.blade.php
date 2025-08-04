<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title')
    </title>
    <link rel="stylesheet" href="{{asset('/bootstrap/css/bootstrap.min.css')}}">


    <style>

        @font-face {
            font-family: 'Roboto';
            src: url('{{asset('/')}}fonts/Roboto-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body, h1, p, label {
            font-family: 'Roboto', sans-serif;
        }



    </style>

    @stack('styles')


</head>
<body>

@yield('body')

<script src="{{asset('/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/bootstrap/js/jquery.min.js')}}"></script>

@stack('scripts')
</body>
</html>
