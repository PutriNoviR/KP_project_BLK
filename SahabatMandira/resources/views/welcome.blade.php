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
    
    @extends('layouts.index')

    @section('title')
            Dashboard
    @endsection

    @section('page-bar')
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="http://127.0.0.1:8000/">Dashboard</a>
                <i class="fa fa-angle-right"></i>
            </li>
        </ul>
    @endsection

    @section('contents')
          
    @endsection
    {{--</body>
</html>--}}
