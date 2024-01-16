@extends('layouts.adminlte')

@section('javascript')
    <script>
        @if (count($errors) > 0)
            $('#daftarLowonganModal').modal('show');
        @endif
        @foreach ($dokumenLowongan as $dokumen)
            $('#{{ str_replace(' ', '_', $dokumen->nama) }}').on('change', function() {
                //get the file name
                var fileName = $(this).val().replace('C:\\fakepath\\', " ");
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            });
        @endforeach

        $(document).ready(function() {
            $("#jenisGaji").change(function() {
                if ($(this).val() === "gajiPokok") {
                    $("#inputGajiPokok").show();
                    $("#inputRentangGaji").hide();
                } else if ($(this).val() === "rentangGaji") {
                    $("#inputGajiPokok").hide();
                    $("#inputRentangGaji").show();
                }
            });
        });

        var currentStep = 1;
        var updateProgressBar;

        function displayStep(stepNumber) {
            if (stepNumber >= 1 && stepNumber <= 2) {
                $(".step-" + currentStep).hide();
                $(".step-" + stepNumber).show();
                currentStep = stepNumber;
                updateProgressBar();
            }
        }

        $(document).ready(function() {
            $('#multi-step-form').find('.step').slice(1).hide();

            $(".next-step").click(function() {
                
                    if (currentStep < 2) {
                        $(".step-" + currentStep).addClass("animate__animated animate__fadeOutLeft");
                        currentStep++;
                        setTimeout(function() {
                            $(".step").removeClass("animate__animated animate__fadeOutLeft").hide();
                            $(".step-" + currentStep).show().addClass(
                                "animate__animated animate__fadeInRight");
                            updateProgressBar();
                        }, 500);
                    }
            });

            $(".prev-step").click(function() {
                if (currentStep > 1) {
                    $(".step-" + currentStep).addClass("animate__animated animate__fadeOutRight");
                    currentStep--;
                    setTimeout(function() {
                        $(".step").removeClass("animate__animated animate__fadeOutRight").hide();
                        $(".step-" + currentStep).show().addClass(
                            "animate__animated animate__fadeInLeft");
                        updateProgressBar();
                    }, 500);
                }
            });

            updateProgressBar = function() {
                var progressPercentage = ((currentStep - 1)) * 100;
                $(".progress-bar").css("width", progressPercentage + "%");
            }
        });

        $("#jenisGaji").change(function() {
            if ($(this).val() === "gajiPokok") {
                $("#inputGajiPokok").show();
                $("#inputRentangGaji").hide();
            } else if ($(this).val() === "rentangGaji") {
                $("#inputGajiPokok").hide();
                $("#inputRentangGaji").show();
            }
        });
        
        // Pengecekan profil udah lengkap atau tidak
        function pengecekan() {

            console.log('{{ Auth::user()->tanggal_lahir }}');

            if ('{{ Auth::user()->pendidikan_terakhir }}' == '' || '{{ Auth::user()->tanggal_lahir }}' == '' ||
                '{{ Auth::user()->jenis_kelamin }}' == '') {

                Swal.fire({
                    icon: 'info', // Ganti dengan 'success', 'error', 'warning', atau 'info' sesuai kebutuhan Anda
                    title: 'Data diri belum lengkap',
                    text: 'Harap lengkapi data diri anda supaya anda bisa melakukan pendaftaran',
                    // timer: 3000, // Waktu penutupan dalam milidetik (3000ms = 3 detik)
                    showConfirmButton: true, // Menampilkan tombol "Oke"
                    // showCancelButton: true, // Menampilkan tombol "Tutup"
                    confirmButtonText: 'Oke', // Teks pada tombol "Oke"
                    // cancelButtonText: 'Tutup', // Teks pada tombol "Tutup"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Aksi yang akan diambil jika tombol "Oke" diklik
                        // console.log('Tombol "Oke" diklik!');
                        // return redirect() - > route('/User/kangkung@gmail.com');
                        window.location.href = '/User/{{ Auth::user()->email }}';
                    } else if (result.dismiss === Swal.DismissReason.cancel) {

                        // console.log('SweetAlert ditutup atau tombol "Tutup" diklik!');
                    }
                });


            } else {
                var modal = document.getElementById('daftarLowonganModal');
                $(modal).modal('show');
            }
        }

        function formatRupiah(angka, inputElement) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/g);

            // Add a dot separator if the input is already in the thousands format
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;

            // Set the value of the input element with the formatted value
            inputElement.value = rupiah;
        }
    </script>
@endsection

@section('contents')
    <style>
        #container {
            max-width: 550px;
        }

        .step-container {
            position: relative;
            text-align: center;
            transform: translateY(-43%);
        }

        .step-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #fff;
            border: 2px solid #007bff;
            line-height: 30px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            cursor: pointer;
            /* Added cursor pointer */
        }

        .step-line {
            position: absolute;
            top: 16px;
            left: 50px;
            width: calc(100% - 100px);
            height: 2px;
            background-color: #007bff;
            z-index: -1;
        }

        #multi-step-form {
            overflow-x: hidden;
        }
    </style>
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $lowongan->posisi }}</h3>
            </div>
            <div class="card-body">
                @if (\Session::has('success'))
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                    <script>
                        Swal.fire({
                            icon: 'success', // Ganti dengan 'success', 'error', 'warning', atau 'info' sesuai kebutuhan Anda
                            title: 'Berhasil !',
                            text:'{!! \Session::get('success') !!}'
                        });
                    </script>
                @endif
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <div class="d-flex ">
                            <img src="{{ asset('storage/' . $lowongan->perusahaan->logo) }}" class="img-thumbnail"
                                alt="...">
                            <div class="mx-auto d-flex flex-column justify-content-between py-4">
                                <div>
                                    <h1>{{ $lowongan->posisi }}</h1>
                                    <p class="FontComic display-5 text-primary">{{ $lowongan->perusahaan->nama }}</p>
                                    <p class="display-5">{{ $lowongan->bidang_kerja->nama_bidang }} - {{ $lowongan->bidang_kerja->keterangan }}</p>
                                    <p class="display-5">{{ $lowongan->perusahaan->alamat }}</p>
                                </div>
                                @if ($lamaran != null && $lamaran->users_email == Auth::user()->email && $lamaran->lowongans_id == $lowongan->id)
                                    <div>
                                        @if ($lamaran->status == 'Terdaftar')
                                            <button type="button"
                                                class="btn btn-outline-success btn-lg disabled">{{ $lamaran->status }}</button>
                                        @elseif ($lamaran->status == 'Tahap Seleksi')
                                            <button type="button"
                                                class="btn btn-outline-warning btn-lg disabled">{{ $lamaran->status }}</button>
                                        @elseif ($lamaran->status == 'Diterima')
                                            <button type="button"
                                                class="btn btn-outline-success btn-lg disabled">{{ $lamaran->status }}</button>
                                        @else
                                            <button type="button"
                                                class="btn btn-outline-danger btn-lg disabled">{{ $lamaran->status }}</button>
                                        @endif
                                    </div>
                                @else
                                    <div>
                                        <button type="button" class="btn btn-primary px-5 "
                                            onclick="pengecekan()">Daftar</button>
                                    </div>
                                @endif

                            </div>
                        </div>

                        <div class="post clearfix"></div>
                        <div class="post clearfix">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="user-block">
                                        <b>Penempatan Kerja</b>
                                        <p>
                                            {{ $lowongan->kota }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="user-block">
                                        <b>Sistem Kerja</b>
                                        <p>
                                            {{ $lowongan->sistem_kerja }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="user-block">
                                        <b>Minimal Pendidikan Terakhir</b>
                                        <p>
                                            {{ $lowongan->pendidikan_terakhir }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="user-block">
                                        <b>Gaji</b>
                                        <p>
                                            @php
                                                $ep = explode('-', $lowongan->gaji);
                                            @endphp

                                            @if (count($ep) > 1)
                                                {{'Rp ' . number_format($ep[0], 2, ',', '.') . ' - ' . 'Rp ' . number_format($ep[1], 2, ',', '.') }} per Bulan
                                            @else
                                                {{'Rp ' . number_format($lowongan->gaji, 2, ',', '.') }} per Bulan
                                            @endif

                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="user-block">
                                        <b>Minimal Usia</b>
                                        <p>
                                            {{  $lowongan->usia  }} Tahun
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="user-block">
                                        <b>Jenis Kelamin</b>
                                        <p>
                                            {{ $lowongan->jenis_kelamin  }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post clearfix">
                            <div class="user-block">
                                <b>Kualifikasi Minimal</b>
                            </div>
                            <p>
                                {!! $lowongan->kualifikasi_minimal !!}
                            </p>

                        </div>
                        <div class="post clearfix">
                            <div class="user-block">
                                <b>Deskripsi Pekerjaan</b>
                            </div>
                            <p>
                                {!! $lowongan->deskripsi_kerja !!}
                            </p>
                        </div>
                        <div class="post clearfix">
                            <div class="user-block">
                                <b>Tentang Perusahaan</b>
                            </div>
                            <p>
                                {{ $lowongan->perusahaan->tentang_perusahaan }}
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                        <h3 class="text-primary"><i class="fas fa-paint-brush"></i> {{ $lowongan->perusahaan->nama }}</h3>
                        <p class="text-muted">{!! $lowongan->perusahaan->tentang_perusahaan !!}</p>
                        <h5 class="mt-5 ">Dokumen Persyaratan</h5>
                        <ul class="list-unstyled">
                            @foreach ($dokumenLowongan as $dl)
                                <li>
                                    <span href="" class="btn-link text-secondary"><i
                                            class="far fa-fw fa-file-word"></i>
                                        {{ $dl->nama }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>

    <!-- Modal Daftar lowongan-->
    <div class="modal fade" id="daftarLowonganModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" class="modal-title" id="exampleModalLabel">
                    <div id="container" class="container mt-5">
                        <div class="progress px-1" style="height: 3px;">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="step-container d-flex justify-content-between">
                            <div class="step-circle" onclick="displayStep(1)">1</div>
                            <div class="step-circle" onclick="displayStep(2)">2</div>
                        </div>

                        {{-- 
                        <form id="multi-step-form"> --}}
                        <form id="multi-step-form" method="POST" action="{{ route('lamaran.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="step step-1">
                                <!-- Step 1 form fields here -->
                                <h3>Persyaratan 1</h3>
                                <div class="mb-3">
                                    <div class="col-md-12">
                                        <label for="jenisGaji" class="form-label">Gaji</label>
                                        <select id="jenisGaji" class="form-control" aria-label="Default select example"
                                            name="jenisGaji" required="required">
                                            <option value="">Pilih Jenis Gaji</option>
                                            <option value="gajiPokok">Gaji Pokok</option>
                                            <option value="rentangGaji">Rentang Gaji</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group" id="inputGajiPokok" style="display: none;">
                                            <br>
                                            <label for="gajiPokok">Gaji Pokok:</label>
                                            <input type="text" class="form-control" id="gajiPokok" name="gajiPokok"
                                                onkeyup="formatRupiah(this.value, this)">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row g-3" id="inputRentangGaji" style="display: none;">
                                            <div class="col-md-6">
                                                <br>
                                                <label for="minimalGaji">Minimal Gaji:</label>
                                                <input type="text" class="form-control" id="minimalGaji"
                                                    name="minimalGaji" onkeyup="formatRupiah(this.value, this)">
                                            </div>
                                            <div class="col-md-6">
                                                <br>
                                                <label for="maksimalGaji">Maksimal Gaji:</label>
                                                <input type="text" class="form-control" id="maksimalGaji"
                                                    name="maksimalGaji" onkeyup="formatRupiah(this.value, this)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary next-step" id="buttonNext">Next</button>
                            </div>
                            <div class="step step-2">
                                <!-- Step 2 form fields here -->
                                <h3>Dokumen Persyaratan</h3>
                                <div class="mb-3">
                                    @if (count($errors) > 0)
                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-danger">
                                                <li>{{ $error }}</li>
                                            </div>
                                        @endforeach
                                    @endif

                                    @foreach ($dokumenLowongan as $dokumen)
                                        <input type="hidden" value="{{ $lowongan->id }}" name="id_lowongan">
                                        <div class="form-group">
                                            <label for="" class="form-label">{{ $dokumen->nama }}</label>
                                            <div class="custom-file">
                                                <input type="file" name="{{ str_replace(' ', '_', $dokumen->nama) }}"
                                                    class="custom-file-input"
                                                    id="{{ str_replace(' ', '_', $dokumen->nama) }}">
                                                <label class="custom-file-label" for="inputGroupFile02"
                                                    aria-describedby="inputGroupFileAddon02">Choose file</label>
                                            </div>
                                            <p class="text-muted text-sm">Jenis dokumen yang mendukung : pdf,png,jpg
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-primary prev-step">Previous</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
