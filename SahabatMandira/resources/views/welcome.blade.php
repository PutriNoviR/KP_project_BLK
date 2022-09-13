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
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('landingpage/css/styles.css') }}" rel="stylesheet" />
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
                    <li class="nav-item"><a class="nav-link btn-info rounded-3 px-3"
                            href="{{ route('login') }}">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading">Sahabat <span class="text-info">MANDIRA</span> </div>
            <div class="masthead-heading mb-0">Melanjutkan masa depan yang</div>
            <div class="masthead-heading"><span class="text-info">Mandiri dan
                    Sejahtera</span></div>
            <a class="btn btn-info btn-xl text-uppercase" href="#tentang">Tentang Kami</a>
        </div>
    </header>
    <!-- Services-->
    <section class="page-section" id="tentang">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">VISI MISI</h2>
                <h3 class="section-subheading text-muted"></h3>
            </div>
            <div class="row justify-content-around">
                <div class="col-md-6">
                    <img src="{{ asset('landingpage/assets/img/hands2.jpg')}}" class="rounded w-100" alt="...">
                </div>
                <div class="col-md-6 d-flex align-items-center p-5">
                    <p class="text-wrap text-center section-subheading">"Adalah bentuk kepedulian terhadap tenaga kerja
                        potensial
                        Indonesia dengan memberikan kesempatan meningkatkan kompetensi dan mempertemukan dengan
                        tenaga kerja."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- About-->
    <section class="page-section" id="about">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Kenapa Sahabat mandira?</h2>
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
                                motiviasi untuk berwirausaha</p>
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
                            <p class="text-muted">Memberi pelatihan kepada para pencari kerja untuk persiapan sebelum
                                memasuki dunia kerja</p>
                        </div>
                    </div>
                    <div class="timeline-panel  float-end text-start">
                        <div class="timeline-heading">
                            <h4 class="subheading">Wadah</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Sebagai wadah untuk mempertemukan pencari kerja, mentor dan partner
                                industri penyedia lowongan pekerja</p>
                        </div>
                    </div>
                </li>
                <li class="timeline-inverted">
                    <div class="timeline-image">
                        <a class="text-decoration-none text-dark" href="{{ route('register') }}">
                            <h4>
                                Mari
                                <br />
                                Bergabung!
                                <br />
                            </h4>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <!-- Statistik -->
    <section class="page-section bg-light" id="statistik">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">informasi</h2>
                <h3 class="section-subheading text-muted"></h3>
            </div>
            <div class="row justify-content-center text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <img src="{{ asset('landingpage/assets/img/statistik/mentor.svg')}}" class="rounded w-100 h-100"
                            alt="">
                    </span>
                    <h4 class="my-3">125 Mentor</h4>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <img src="{{ asset('landingpage/assets/img/statistik/kerja.svg')}}" class="rounded w-100 h-100"
                            alt="">
                    </span>
                    <h4 class="my-3">125 Pencari Kerja</h4>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <img src="{{ asset('landingpage/assets/img/statistik/mitra.svg')}}" class="rounded w-100 h-100"
                            alt="">
                    </span>
                    <h4 class="my-3">125 Mitra</h4>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <img src="{{ asset('landingpage/assets/img/statistik/pelatihan.svg')}}"
                            class="rounded w-100 h-100" alt="">
                    </span>
                    <h4 class="my-3">125 Pelatihan</h4>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <img src="{{ asset('landingpage/assets/img/statistik/peserta.svg')}}"
                            class="rounded w-100 h-100" alt="">
                    </span>
                    <h4 class="my-3">125 Peserta Pelatihan Yang Diterima</h4>
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
