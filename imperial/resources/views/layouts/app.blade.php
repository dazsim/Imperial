<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Focal Strategy Technical Challenge - @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #ddf;
                color: #202020;
                font-family: 'Tahoma', sans-serif;
                
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #808080;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .grid { width:900px; }
            .grid div  { float: left; height: 100px; }
            .col100    { width: 100px; }
            .col200    { width: 200px; }
            .col300    { width: 300px; }
            .grey      { background-color: #cccccc; }
            .red       { background-color: #e14e32; }
            .clear     { clear: both; }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            


            <div class="content">
                @yield('content')
                
            </div>
        </div>
    </body>
</html>
