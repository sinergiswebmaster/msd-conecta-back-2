<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>


        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@700&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/b7074781c0.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://d9k6yqqw2th8h.cloudfront.net/kjs/kaltura-ovp-player.js"></script>

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

    </head>
    <body>

        @yield('content')

    </body>
</html>