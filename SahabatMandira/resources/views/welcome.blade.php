{{-- 
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="shortcut icon" href="favicon.ico">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        .content {
            text-align: center;
        }

        .titles {
            font-size: 84px;
        }


        .m-b-md {
            margin-bottom: 30px;
        }

    </style>
</head>

<body> --}}

    @extends('layouts.adminlte')

    @section('title')
    Dashboard
    @endsection

    @section('page-bar')
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard</h1>
    </div><!-- /.col -->
    @endsection

    @section('contents')

    @endsection
    {{--</body>
</html>--}}
