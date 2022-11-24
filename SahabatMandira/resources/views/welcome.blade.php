<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sahabat Mandira</title>

    {{-- Owl-Carousel Start --}}
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('carousel/css/owl.theme.default.min.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">
	<link rel="stylesheet" href="{{ asset('carousel/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('montana-master/css/style.css') }}">
    {{-- Owl-Carousel End --}}


    {{-- Custom Internal Carousel Instagram Start--}}
    <Style>
        .item.ig {
            height: 500px;
            overflow: auto;
        }
    </Style>
    {{-- Custom Internal Carousel Instagram End --}}


    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('landingpage/assets/favicon.ico')}}" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    {{-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" /> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500&display=swap" rel="stylesheet">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('landingpage/css/styles.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500&display=swap');

        * {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

    </style>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-light fixed-top p-2 bg-light" id="mainNav">
        <div class="container">
            <a class="navbar-brand p-0 d-none d-xl-block" href="#page-top">
                <p class="m-0">
                    <img src="{{ asset('landingpage/assets/img/logos/sahabatmandira.png') }}" style="height: 50px;" alt="">
                </p>   
            </a>
            <a class="navbar-brand p-0 d-none d-xl-block" href="//www.ubaya.ac.id" target="_blank">
                <p class="m-0">
                    <img src="{{ asset('landingpage/assets/img/logos/LogoUbaya.png')}}" style="height: 50px;" alt="">
                </p>   
            </a>
            <a class="navbar-brand p-0 d-none d-xl-block" href="//disnakertrans.jatimprov.go.id/" target="_blank">
                <p class="m-0">
                    <img src="{{ asset('landingpage/assets/img/logos/LogoDisnaker.png')}}" style="width: 50%; height: auto" alt="">
                </p>   
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <a class="nav-link btn-primary rounded-3 px-3" href="{{ route('login') }}" id="btnlogin">Masuk &nbsp;<i class="fa fa-sign-in"></i></a>
            <div class="navbar-collapse collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link text" href="#" style="color: #0A8AEA">Home</a></li>
                    <li class="nav-item"><a class="nav-link text" href="#blk" style="color: #0A8AEA">Pelatihan BLK</a></li>
                    <li class="nav-item"><a class="nav-link text" href="#seminar" style="color: #0A8AEA">Seminar dan Workshop</a></li>
                    <li class="nav-item"><a class="nav-link text" href="#uga" style="color: #0A8AEA">Pelatihan UGA</a></li>
                    <li class="nav-item"><a class="nav-link text" href="#tentang" style="color: #0A8AEA">Tentang</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead min-vh-100 pb-0">
        <div class="container d-flex flex-column h-100 justify-content-around d-sm-block">
            {{-- <div class="masthead-subheading">Sahabat <span class="text-info">MANDIRA</span> </div> --}}
            <div class="masthead-subheading pt-4">
                <span class="font-weight-bold" style="color: #2c5284; font-style: italic !important;">
                    <strong>Banyak Sahabat Banyak Peluang</strong>
                </span>
            </div>
            <div class="masthead-heading mb-0">
                <div class="">
                    <img src="{{ asset('landingpage/assets/img/logos/sahabatmandira.png') }}" class="mb-lg-5"
                        style="height: 100px;" alt="">
                    <div class="d-inline-block">
                        <span class="sahabat" style="color: #0A8AEA">
                            Sahabat
                        </span>
                        <span class="sahabat" style="color: #F06128"> Mandira</span>
                    </div>
                </div>
            </div>
            <div class="masthead-subheading pt-4">
                <span class="text-sm text-decoration-none font-weight-bold" style="color: #212529;">
                    Untuk Masa Depan yang Mandiri dan Sejahtera
                </span>
            </div>
            <div>
                <a class=" btn btn-info btn-xl text-uppercase" href="#tentang">Tentang Kami</a>
            </div>
        </div>
    </header>
    <!-- Services-->
    <section class="page-section pt-5 " style="background-image: linear-gradient(180deg,rgba(190,191,193,255), rgba(0, 0, 255, 0.315))" id="aktivitas">
        <div class="container">
            <div class="row">
                    <div class="text-center text-lg pt-0 pt-lg-5 mb-5">
                        <h1 class="text-black title-heading">Kegiatan kami</h1>
                    </div>
                    <div class="col-md-12">
                        <div class="ig-carousel owl-carousel">
                            <div class="item ig">
                                <blockquote class="instagram-media" data-instgrm-captioned data-instgrm-permalink="https://www.instagram.com/p/CkxXKUMvXPh/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                                    <div style="padding:16px;">
                                        <a href="https://www.instagram.com/p/CkxXKUMvXPh/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> 
                                            <div style=" display: flex; flex-direction: row; align-items: center;"> 
                                                <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> 
                                                <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> 
                                                    <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> 
                                                    <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div>
                                                </div>
                                            </div>
                                            <div style="padding: 19% 0;"></div> 
                                            <div style="display:block; height:50px; margin:0 auto 12px; width:50px;">
                                                <svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <g transform="translate(-511.000000, -20.000000)" fill="#000000">
                                                            <g>
                                                                <path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div style="padding-top: 8px;"> 
                                                <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div>
                                            </div>
                                            <div style="padding: 12.5% 0;"></div> 
                                            <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;">
                                                <div> 
                                                    <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> 
                                                    <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> 
                                                    <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div>
                                                </div>
                                                <div style="margin-left: 8px;"> 
                                                    <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> 
                                                    <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div>
                                                </div>
                                                <div style="margin-left: auto;">
                                                     <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div>
                                                     <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> 
                                                     <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div>
                                                </div>
                                            </div>
                                            <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> 
                                                <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> 
                                                <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div>
                                            </div>
                                        </a>
                                        <p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;">
                                            <a href="https://www.instagram.com/p/CkxXKUMvXPh/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by Mandira (@sahabatmandira)
                                            </a>
                                        </p>
                                    </div>
                                </blockquote> 
                                <script async src="//www.instagram.com/embed.js"></script>
                            </div>     

                            <div class="item ig">
                                <blockquote class="instagram-media" data-instgrm-captioned data-instgrm-permalink="https://www.instagram.com/p/Ckp3_QvPQ2S/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/p/Ckp3_QvPQ2S/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/p/Ckp3_QvPQ2S/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by Mandira (@sahabatmandira)</a></p></div></blockquote>
                            </div>

                            {{-- Add New Feed Here --}}


                        </div>
                    </div>
            </div>
        </div>
    </section>

    {{-- Carousel Slider Start --}}
    @if(count($sliderblk) > 0)
    <section id="blk" class="page-section pt-5" style="background-image: linear-gradient(180deg, rgba(0, 0, 255, 0.315), rgba(255, 166, 0, 0.37))">
        <div class="container">
            <div class="row">
                <div class="text-center text-lg pt-0 pt-lg-5 mb-5">
                    <h1 class="text-black title-heading">Pelatihan Balai Latihan Kerja(BLK)</h1>
                </div>
                <div class="col-md-12">
                    <div class="featured-carousel owl-carousel">
                        @foreach($sliderblk as $s)
                        <div class="item">
                            <div class="blog-entry" style="border-top-left-radius: 40px; border-bottom-right-radius: 40px;">
                                <a href="#" class="block-20 d-flex align-items-start" style="object-fit: cover; object-position: center; border-top-left-radius: 40px; background-image: url('{{ asset('storage/'.$s->gambar) }}')">
                                    {{-- <div class="meta-date text-center p-2">
                                        <span class="day">26</span>
                                        <span class="mos">Nov.</span>
                                        <span class="yr">2019</span>
                                    </div> --}}
                                </a>
                                <div class="text p-4">
                                    <center><b><p style="height: 50px;" class="text-muted"><a href="#">{{ $s->nama }}</a></p></b></center>
                                    <p style="height: 100px; overflow: auto;">{{ $s->deskripsi }}</p>
                                    
                                    <div class="d-flex align-items-center mt-4">
                                        <p class="mb-0"><a href="#" class="btn btn-primary">Detail <span class="ion-ios-arrow-round-forward"></span></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach        
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(count($slidermentor) > 0)
    <section id="seminar" class="page-section pt-5" style="background-image: linear-gradient(360deg, rgba(0, 0, 255, 0.315), rgba(255, 166, 0, 0.37))">
        <div class="container">
            <div class="row">
                <div class="text-center text-lg pt-0 pt-lg-5 mb-5">
                    <h1 class="text-black title-heading">Seminar, Webinar dan Workshop</h1>
                </div>
                <div class="col-md-12">
                    <div class="featured-carousel owl-carousel">
                        @foreach($slidermentor as $s)
                        <div class="item">
                            <div class="blog-entry" style="border-top-left-radius: 40px; border-bottom-right-radius: 40px;">
                                <a href="#" class="block-20 d-flex align-items-start" style="object-fit: cover; object-position: center; border-top-left-radius: 40px; background-image: url('{{ asset('storage/'.$s->gambar) }}')">
                                    {{-- <div class="meta-date text-center p-2">
                                        <span class="day">26</span>
                                        <span class="mos">Nov.</span>
                                        <span class="yr">2019</span>
                                    </div> --}}
                                </a>
                                <div class="text p-4">
                                    <center><b><p style="height: 50px;" class="text-muted"><a href="#">{{ $s->nama }}</a></h3></b></center>
                                    <p style="height: 100px; overflow: auto;">{{ $s->deskripsi }}</p>
                                    
                                    <div class="d-flex align-items-center mt-4">
                                        <p class="mb-0"><a href="#" class="btn btn-primary">Detail <span class="ion-ios-arrow-round-forward"></span></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach        
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(count($slidervendor) > 0)
    <section id="uga" class="page-section pt-5" style="background-image: linear-gradient(180deg,rgba(0, 0, 255, 0.315), rgba(255, 166, 0, 0.37))">
        <div class="container">
            <div class="row">
                <div class="text-center text-lg pt-0 pt-lg-5 mb-5">
                    <h1 class="text-black title-heading">Pelatihan Ubaya Global Academy(UGA)</h1>
                </div>
                <div class="col-md-12">
                    <div class="featured-carousel owl-carousel">
                        @foreach($slidervendor as $s)
                        <div class="item">
                            <div class="blog-entry" style="border-top-left-radius: 40px; border-bottom-right-radius: 40px;">
                                <a href="#" class="block-20 d-flex align-items-start" style="object-fit: cover; object-position: center; border-top-left-radius: 40px; background-image: url('{{ asset('storage/'.$s->gambar) }}')">
                                    {{-- <div class="meta-date text-center p-2">
                                        <span class="day">26</span>
                                        <span class="mos">Nov.</span>
                                        <span class="yr">2019</span>
                                    </div> --}}
                                </a>
                                <div class="text p-4">
                                    <center><b><p style="height: 50px;" class="text-muted"><a href="#">{{ $s->nama }}</a></h3></b></center>
                                    <p style="height: 100px; overflow: auto;">{{ $s->deskripsi }}</p>
                                    
                                    <div class="d-flex align-items-center mt-4">
                                        <p class="mb-0"><a href="#" class="btn btn-primary">Detail <span class="ion-ios-arrow-round-forward"></span></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach        
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    {{-- Carousel Slider End --}}

    <section class="page-section pt-5" style="background-image: linear-gradient(180deg,rgba(255, 166, 0, 0.37), #F2F2F2)" id="tentang">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="text-center text-lg pt-0 pt-lg-5 mb-5">
                        <h1 class="text-black title-heading">VISI</h1>
                    </div>
                    <p class="title-subheading mb-5">
                        Menjadi support system terpadu yang unggul dalam meningkatkan kemandirian dan kesejahteraan
                        masyarakat
                    </p>
                    <div class="w-50 mx-auto">
                        <img src="{{ asset('landingpage/assets/img/vision.png') }}" class="visi-img mx-auto rounded"
                            alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="misi-section p-5">
                        <div class="text-center mb-5">
                            <h1 class="title-heading text-white">MISI</h1>
                        </div>
                        <div class="d-flex paragraf mb-3">
                            <div>1.</div>
                            <div>
                                Menyediakan layanan informasi pelatihan dan sertifikasi secara berkelanjutan
                            </div>
                        </div>
                        <div class="d-flex paragraf mb-3">
                            <div>2.</div>
                            <div>
                                Menyediakan layanan informasi talenta pekerja bagi mitra
                            </div>
                        </div>
                        <div class="d-flex paragraf mb-3">
                            <div>3.</div>
                            <div>
                                Menyediakan layanan informasi lowongan kerja dan pengembangan karier
                            </div>
                        </div>
                        <div class="d-flex paragraf mb-3">
                            <div>4.</div>
                            <div>
                                Menyediakan layanan pelatihan dan pendampingan kewirausahaan yg praktis dan konkrit
                            </div>
                        </div>
                        <div class="d-flex paragraf mb-3">
                            <div>5.</div>
                            <div>
                                Menyediakan layanan pendukung kolaborasi komunitas antar sahabat mandira.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About-->
    <section class="page-section " style="background-color: #F2F2F2 !important" id="about">
        <div class="container">
            <div class="text-center">
                <h2 class="title-heading text-uppercase">Kenapa Sahabat mandira?</h2>
                <h3 class="section-subheading text-muted"></h3>
            </div>
            <ul class="timeline">
                <li>
                    <div class="timeline-image"><img class="rounded-circle img-fluid"
                            src="{{ asset('landingpage/assets/img/about/4.jpg')}}" alt="..." /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="subheading">Pekerja Professional</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Sebagai wadah pendukung pengembangan karir melalui pelatihan yang
                                lebih berkualitas dan jaringan persahabatan untuk berkolaborasi</p>
                        </div>
                    </div>
                    <div class="timeline-panel float-end text-start">
                        <div class="timeline-heading">
                            <h4 class="subheading">Mitra Perusahaan</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Mendapatkan talenta terbaik dengan efektif dan efisien dan sumber
                                sumber pengetahuan bagi pengembangan human capital perusahaan</p>
                        </div>
                    </div>
                </li>
                <li class="timeline">
                    <div class="timeline-image"><img class="rounded-circle img-fluid"
                            src="{{ asset('landingpage/assets/img/about/3.jpg')}}" alt="..." /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="subheading">Lembaga Pelatihan dan Sertifikasi</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Menjadi media informasi dan sumber peserta bagi kegiatan pelatihan dan
                                sertifikasi</p>
                        </div>
                    </div>
                    <div class="timeline-panel  float-end text-start">
                        <div class="timeline-heading">
                            <h4 class="subheading">Mitra Bisnis</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Mendapatkan calon-calon entrepeneur yang dapat dijadikan mitra dalam
                                pengembangan bisnis bersama</p>
                        </div>
                    </div>
                </li>
                <li class="timeline">
                    <div class="timeline-image"><img class="rounded-circle img-fluid"
                            src="{{ asset('landingpage/assets/img/about/5.jpg')}}" alt="..." /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="subheading">Mentor</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Wadah untuk sharing pengalaman, pengetahuan dan keterampilan serta
                                untuk peningkatan reputasi mentor</p>
                        </div>
                    </div>
                    <div class="timeline-panel  float-end text-start">
                        <div class="timeline-heading">
                            <h4 class="subheading">Pencari Kerja</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Mendapat informasi lengkap tentang pelatihan dan sertifikasi, lowongan
                                kerja dan komunitas profesional</p>
                        </div>
                    </div>
                </li>
                <li class="timeline-inverted">
                    <a class="text-decoration-none text-dark" href="{{ route('register') }}">
                        <div class="timeline-image" id="bergabung" style="border: 7px solid #A1CCED;">
                            <h4>
                                Mari
                                <br />
                                Bergabung!
                                <br />
                            </h4>
                        </div>
                    </a>
                </li>

            </ul>
        </div>
    </section>

    <section class="page-section pt-5" style="background-color: #F2F2F2 !important" id="galeri">
            <div class="text-center">
                <h2 class="title-heading text-uppercase">Galeri Kegiatan</h2>
                <h3 class="section-subheading text-muted"></h3>
            </div>
            
            <div class="instragram_area">
                <div class="single_instagram">
                    <img src="{{ asset('montana-master/img/instragram/1.png') }}" alt="">
                    <div class="ovrelay">
                        <a href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                <div class="single_instagram">
                    <img src="{{ asset('montana-master/img/instragram/2.png') }}" alt="">
                    <div class="ovrelay">
                        <a href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                <div class="single_instagram">
                    <img src="{{ asset('montana-master/img/instragram/3.png') }}" alt="">
                    <div class="ovrelay">
                        <a href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                <div class="single_instagram">
                    <img src="{{ asset('montana-master/img/instragram/4.png') }}" alt="">
                    <div class="ovrelay">
                        <a href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                <div class="single_instagram">
                    <img src="{{ asset('montana-master/img/instragram/5.png') }}" alt="">
                    <div class="ovrelay">
                        <a href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        <!-- instragram_area_start -->
        
        <!-- instragram_area_end -->
    </section>

    <!-- Statistik -->
    <section class="page-section bg-light" id="informasi">
        <div class="container">
            <div class="text-center">
                <h2 class="title-heading text-uppercase">informasi</h2>
                <h3 class="section-subheading text-muted"></h3>
            </div>
            <div class="row justify-content-around">
                <div class="col-lg-6 row justify-content-around">
                    <div
                        class="col-6 info-section mb-5 p-3 rounded title-informasi d-flex flex-column align-items-center">
                        <p>Pencari Kerja</p>
                        <span>{{ number_format($pencaker,0,"",".") }}</span>
                    </div>
                    <div
                        class="col-6 info-section mb-5 p-3 rounded title-informasi d-flex flex-column align-items-center">
                        <p>Mentor</p>
                        <span>{{ number_format($mentor,0,"",".") }}</span>
                    </div>
                    <div
                        class="col-6 info-section mb-5 p-3 rounded title-informasi d-flex flex-column align-items-center">
                        <p>Mitra</p>
                        <span>{{ number_format($mitra,0,"",".") }}</span>
                    </div>
                    <div
                        class="col-6 info-section mb-5 p-3 rounded title-informasi d-flex flex-column align-items-center">
                        <p>Pelatihan</p>
                        <span>{{ number_format($totalpelatihan,0,"",".") }}</span>
                    </div>
                </div>
                <!-- <div class="col-lg-6 info-section rounded mb-5 p-5  title-informasi-pelatihan d-flex flex-column align-items-center"
                    id="pelatihanditerima">
                    <p class="text-start">Peserta pelatihan yang diterima</p>
                    <span>{{ floor($persentase) }}%</span>
                </div> -->
            </div>
        </div>
    </section>
    <!-- Clients-->
    <div class="py-5" style="background-image: linear-gradient(to right, rgba(247, 139, 17, 0.486), rgba(12, 138, 241, 0.562))">
        <div class="mx-3">
            <div class="d-flex justify-content-around">
                <div class="my-3 d-flex align-items-center">
                    <a href="https://www.kemdikbud.go.id"><img class="img-fluid  d-block mx-auto"
                            src="{{ asset('landingpage/assets/img/logos/LogoKemendikbud.png')}}"
                            aria-label="Kemendikbud Logo" /></a>
                </div>
                <div class="my-3 d-flex align-items-center">
                    <a href="https://kampusmerdeka.kemdikbud.go.id/"><img class="img-fluid  d-block mx-auto"
                            src="{{ asset('landingpage/assets/img/logos/kampusmerdeka.png')}}"
                            aria-label="KampusMerdeka Logo" /></a>
                </div>
                <div class="my-3 d-flex align-items-center">
                    <a href="https://kedaireka.id/"><img class="img-fluid  d-block mx-auto"
                            src="{{ asset('landingpage/assets/img/logos/LogoKedaireka.png')}}"
                            aria-label="Kedaireka Logo" /></a>
                </div>
                <div class="my-3 d-flex align-items-center">
                    <a href="//www.ubaya.ac.id"><img class="img-fluid  d-block mx-auto"
                            src="{{ asset('landingpage/assets/img/logos/LogoUbaya.png')}}"
                            aria-label="Ubaya Logo" /></a>
                </div>
                <div class="my-3 d-flex align-items-center">
                    <a href="https://disnakertrans.jatimprov.go.id/"><img class="img-fluid  d-block mx-auto"
                            src="{{ asset('landingpage/assets/img/logos/LogoDisnaker.png')}}"
                            aria-label="Disnaker Logo" /></a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Footer-->
    <footer class="footer py-4 bg-color-black">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-start"><img
                        src="{{ asset('landingpage/assets/img/logos/sahabatmandira.png') }}" style="height: 50px;"
                        alt=""></div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i
                            class="fab fa-twitter"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i
                            class="fab fa-facebook-square"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i
                            class="fab fa-linkedin"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i
                            class="fab fa-instagram"></i></a>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a class="link-dark text-decoration-none me-3 text-white" href="#!">Privacy Policy</a>
                    <a class="link-dark text-decoration-none text-white" href="#!">Terms of Use</a>
                </div>
            </div>
        </div>
    </footer>
    <a href="https://api.whatsapp.com/send?phone=6281235597909" class="floating-whatsapp">
        <i class="fab fa-whatsapp my-float" style="margin-top: 16px;"></i>
    </a>

    <!-- Bootstrap core JS-->
    <script src="{{ asset('bantuan/js/jquery-3.5.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('landingpage/js/scripts.js') }}"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    
    {{-- Carousel JS Start --}}
    <script src="{{ asset('carousel/js/popper.js') }}"></script>
    <script src="{{ asset('carousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('carousel/js/main.js') }}"></script>
    {{-- Carousel JS End --}}

    {{-- IG Carousel Start --}}
    <script>
        $('.ig-carousel').owlCarousel({
	    loop:true,
	    autoplay: true,
	    margin:30,
	    animateOut: 'fadeOut',
		autoplayTimeout: 15000,
	    animateIn: 'fadeIn',
	    nav:true,
	    dots: true,
	    autoplayHoverPause: false,
	    items: 1,
	    navText : ["<span class='ion-ios-arrow-back'></span>","<span class='ion-ios-arrow-forward'></span>"],
	    responsive:{
	      0:{
	        items:1
	      },
	      600:{
	        items:2
	      },
	      1000:{
	        items:2
	      }
	    }
		});
    </script>
    {{-- IG Carousel End --}}
    
    <script>
        // const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
        // const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));

        var options = {
            html: true,
            // title: "Optional: HELLO(Will overide the default-the inline title)",
            //html element
            //content: $("#popover-content")
            content: $('[data-name="popover-content"]')
            //Doing below won't work. Shows title only
            //content: $("#popover-content").html()

        }
        var exampleEl = document.getElementById('example')
        var popover = new bootstrap.Popover(exampleEl, options)

        $('#carouselExampleIndicators').carousel({
            interval: 10000
        })


    </script>
</body>

</html>
