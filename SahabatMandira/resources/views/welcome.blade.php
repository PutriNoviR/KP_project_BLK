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

        .sahabat {
            width: 783px;
            height: 91px;
            left: 353px;
            top: 397px;
            font-style: normal;
            font-weight: 800;
            font-size: 96px;
            line-height: 80px;
            /* or 83% */

            letter-spacing: -0.05em;
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
                    <li class="nav-item"><a class="nav-link btn-danger rounded-3 px-3"
                            href="{{ route('login') }}">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            {{-- <div class="masthead-subheading">Sahabat <span class="text-info">MANDIRA</span> </div> --}}
            <div class="masthead-heading mb-0"><span class="sahabat" style="color: #313131">Sahabat</span><span
                    class="sahabat" style="color: #F06128"> Mandira</span></div>
            <div class="masthead-subheading"><span class="text-sm text-decoration-none"
                    style="color: #514040;">Melanjutkan Masa Depan
                    yang
                    Mandiri dan
                    Sejahtera</span></div>
            <a class="btn btn-info btn-xl text-uppercase" href="#tentang">Tentang Kami</a>
        </div>
    </header>
    <!-- Services-->
    <section class="page-section" id="tentang">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="text-center text-lg pt-5 mb-5">
                        <h1 class="text-color-black title-heading">VISI</h1>
                    </div>
                    <p class="title-subheading mb-5">
                        Menjadi suppport system terpadu yang unggul dalam meningkatkan kemandirian dan kesejahteraan
                        masyarakat
                    </p>
                    <div class="text-center">
                        <img src="{{ asset('landingpage/assets/img/visi.png') }}" class="visi-img img-thumbnail" alt="">
                    </div>
                </div>
                <div class="col-6">
                    <div class="misi-section p-5">
                        <div class="text-center mb-5">
                            <h1 class="title-heading text-color-black">MISI</h1>
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
                            <h4 class="subheading">Peluang Kerja</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Memberi peluang kerja bagi tenaga kerja</p>
                        </div>
                    </div>
                    <div class="timeline-panel float-end text-start">
                        <div class="timeline-heading">
                            <h4 class="subheading">Ketrampilan</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Menghasilkan tenaga kerja yang trampil, semangat dan memiliki
                                motiviasi untuk berwirausaha serta dapat mengikuti pelatihan-pelatihan yang ada</p>
                        </div>
                    </div>
                </li>
                <li class="timeline">
                    <div class="timeline-image"><img class="rounded-circle img-fluid"
                            src="{{ asset('landingpage/assets/img/about/3.jpg')}}" alt="..." /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="subheading">Keuntungan</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Mendapat peluang kerja </p>
                        </div>
                    </div>
                    <div class="timeline-panel  float-end text-start">
                        <div class="timeline-heading">
                            <h4 class="subheading">Mitra</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Mendapat karyawan yang kompeten bagi perusahaan</p>
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
                            <p class="text-muted">Menambah softskill dalam kegiatan mengajar</p>
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
                        <div class="timeline-image" style="border: 7px solid #A1CCED;">
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
                <div class="col-6 row justify-content-around">
                    <div class="col-6 info-section mb-3 p-3 rounded">
                        <p>Pencari Kerja</p>
                        <p></p>
                    </div>
                    <div class="col-6 info-section mb-3 p-3 rounded">
                        <p>Mentor</p>
                    </div>
                    <div class="col-6 info-section mb-3 p-3 rounded">
                        <p>Mitra</p>
                    </div>
                    <div class="col-6 info-section mb-3 p-3 rounded">
                        <p>Pelatihan</p>
                    </div>
                </div>
                <div class="col-6 info-section rounded mb-3 p-3">
                    <p>Peserta pelatihan yang diterima</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Clients-->
    <div class="py-5 bg-info">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-sm-6 my-3">
                    <a href="http:://www.ubaya.ac.id"><img class="img-fluid d-block mx-auto"
                            src="{{ asset('landingpage/assets/img/logos/ubaya.png')}}" aria-label="Ubaya Logo" /></a>
                </div>
                <div class="col-md-6 col-sm-6 my-3">
                    <a href="#!"><img class="img-fluid d-block mx-auto"
                            src="{{ asset('landingpage/assets/img/logos/disnaker.png')}}"
                            aria-label="Disnaker Logo" /></a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Footer-->
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-start">Copyright &copy; Sahabat Mandira 2022</div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i
                            class="fab fa-twitter"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i
                            class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i
                            class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                    <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
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
