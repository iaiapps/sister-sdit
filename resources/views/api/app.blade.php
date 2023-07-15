<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Api Page</title>

    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }

        .bgimg {
            height: 100%;
            position: relative;
            background-color: #f2f2f2;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 25px;
        }

        .middle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        hr {
            margin: auto;
            width: 50%;
        }

        .card {
            background-color: rgb(255, 255, 255);
            padding: 20px;
            box-shadow: 0px 0px 20px rgb(202, 202, 202);
            border-radius: 10px
        }
    </style>
</head>

<body>
    <div class="bgimg">
        <div class="middle">
            <div class="card">
                <p>restricted area</p>
                <hr>
                <h3>Anda tidak boleh mengakses halaman ini !</h3>
            </div>
        </div>
    </div>
</body>

</html>
