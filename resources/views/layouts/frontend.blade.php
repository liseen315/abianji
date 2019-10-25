<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="Abianji">
    <meta name="description" content="Abianji">
    <title>Abianji</title>
    <link href="{{ mix('css/frontend/abianji.css') }}" rel="stylesheet">
</head>
<body>
<main class="content">
    @yield('content')
    <footer class="footer">
        <div class="outer">
            <div class="float-right"></div>
            <ul class="list-inline">
                <li>$copy;</li>
                <li>Powered by</li>
                <li>Theme Ocean</li>
            </ul>
        </div>
    </footer>
</main>
</body>
</html>
