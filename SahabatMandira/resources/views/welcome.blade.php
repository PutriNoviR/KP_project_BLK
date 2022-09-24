<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sahabat Mandira</title>
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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500&display=swap');

        * {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

    </style>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top p-2" id="mainNav">
        <div class="container">
            <a class="navbar-brand p-0" href="#page-top">
                <p class="m-0"><img src="{{ asset('landingpage/assets/img/logos/sahabatmandira.png') }}"
                        style="height: 50px;" alt=""></p>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link text" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link btn-danger rounded-3 px-3" href="{{ route('login') }}"
                            id="btnlogin">Login</a></li>
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
    <section class="page-section pt-5 " id="tentang">
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
                            <p class="text-muted">Mendapatkan talenta terbaik dengan efektif dan efisien dan sumber sumber pengetahuan bagi pengembangan human capital perusahaan</p>
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
                            <p class="text-muted">Wadah untuk sharing pengalaman, pengetahuan dan keterampilan serta untuk peningkatan reputasi mentor</p>
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
                <div class="col-lg-6 info-section rounded mb-5 p-5  title-informasi-pelatihan d-flex flex-column align-items-center"
                    id="pelatihanditerima">
                    <p class="text-start">Peserta pelatihan yang diterima</p>
                    <span>{{ floor($persentase) }}%</span>
                </div>
            </div>
        </div>
    </section>
    <!-- Clients-->
    <div class="py-5 bg-info">
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
                    <a href="http:://www.ubaya.ac.id"><img class="img-fluid  d-block mx-auto"
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
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('landingpage/js/scripts.js') }}"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>
