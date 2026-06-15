<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Error')
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body
    style="
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#f5f7fb;
    padding:20px;
    ">

    <div
        style="
        width:100%;
        max-width:700px;
        ">

        @yield('content')

    </div>

</body>

</html>