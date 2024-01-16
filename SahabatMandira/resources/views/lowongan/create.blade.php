@extends('layouts.adminlte')

@section('title')
    Lowongan
@endsection

@section('style')
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }
    </style>
@endsection

@section('page-bar')
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Tambah Lowongan</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                                                                                                                    <li class="breadcrumb-item active">Lowongan</li> -->
        </ol>
    </div><!-- /.col -->
@endsection

@section('javascript')
    <script>
        ClassicEditor
            .create(document.querySelector('#deskripsi_pekerjaan'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '200px';
            })
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#kualifikasi_minimal'))
            .catch(error => {
                console.error(error);
            });
        // $('.editor').each(function () {
        //     CKEDITOR.replace($(this).prop('id'));
        // });

        $('#btnSimpanDokumen').click(function() {
            const nama = $('#namadokumen').val();
            $('#tbody').append(`<tr>
            <td style="width:90%">${nama}</td>
            <input type="hidden" name="dokumen[]" value="${nama}">
            <td style="width:10%"><button type="button"  class="btndeleterow btn btn-danger">
            <i class="fas fa-trash"></i></button></td>
        </tr>`);
            $('#tambahDokumenModal').modal('hide');
        });

        $('body').on('click', '.btndeleterow', function() {
            $(this).parent().parent().remove();
        })

        $(document).ready(function() {
            // var todayDate = new Date().toISOString().slice(0, 10);
            var todayDate = new Date().toISOString().slice(0, 16);
            console.log(todayDate);

            // $("#tanggal_pemasangan").val(todayDate);
            var dateInput = document.getElementById("tanggal_pemasangan");
            var datePenutupan = document.getElementById("tanggal_kadaluarsa");
            var datePenetapan = document.getElementById("tanggal_penetapan");
            dateInput.min = todayDate;
            datePenutupan.min = todayDate;
            dateInput.value = todayDate;

            $("#jenisGaji").change(function() {
                if ($(this).val() === "gajiPokok") {
                    $("#inputGajiPokok").show();
                    $("#inputRentangGaji").hide();
                } else if ($(this).val() === "rentangGaji") {
                    $("#inputGajiPokok").hide();
                    $("#inputRentangGaji").show();
                }
            });

            datePenutupan.addEventListener("change", function() {
                
                // Convert the string value to a Date object
                var selectedDate = new Date(datePenutupan.value);

                // Add three days to the selected date
                selectedDate.setDate(selectedDate.getDate() + 3);

                // Format the new date as YYYY-MM-DD
                var threeDaysLater = selectedDate.toISOString().slice(0, 16);

                // Set the minimum date for datePenutupan
                document.getElementById("tanggal_penetapan").min = threeDaysLater;
            });
        });

        function formatOption(option) {
            if (!option.id) {
                return option.text;
            }

            var optionInfo = $(option.element).data('info');

            var $option = $(
                '<span>' + option.text + '<br><small  style="color: gray">' + optionInfo + '</small></span>'
            );

            return $option;
        }


        $('#bidang').select2({
            templateResult: formatOption // Fungsi untuk menampilkan opsi dan keterangan
        });

        $("#kota").select2();

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
    <script>
        function toggleInput() {
            var usiaOption = document.getElementById("usiaOption").value;
            var usiaMinimal = document.getElementById("usiaMinimal");
            var inputRentangUsia = document.getElementById("inputRentangUsia");

            if (usiaOption === "usiaMinimal") {
                usiaMinimal.style.display = "block";
                inputRentangUsia.style.display = "none";
            } else {
                usiaMinimal.style.display = "none";
                inputRentangUsia.style.display = "block";
            }
        }
    </script>
@endsection

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-register">
                <div class="card-header">
                    <h4>Lowongan</h4>
                </div>
                @if (\Session::has('success'))
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                    <script>
                        Swal.fire({
                            icon: 'success', // Ganti dengan 'success', 'error', 'warning', atau 'info' sesuai kebutuhan Anda
                            title: 'Tambah Lowongan Berhasil',
                            text: 'Anda berhasil menambahkan lowongan baru',
                            showConfirmButton: true, // Menampilkan tombol "Oke"
                            showCancelButton: true, // Menampilkan tombol "Tutup"
                            confirmButtonText: 'Oke', // Teks pada tombol "Oke"
                            cancelButtonText: 'Tutup', // Teks pada tombol "Tutup"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Aksi yang akan diambil jika tombol "Oke" diklik
                                console.log('Tombol "Oke" diklik!');
                                // return redirect() - > route('/User/kangkung@gmail.com');
                                window.location.href = '/menu/lowongan';
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                console.log('SweetAlert ditutup atau tombol "Tutup" diklik!');
                            }
                        });
                    </script>
                @endif
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            <li>{{ $error }}</li>
                        </div>
                    @endforeach
                @endif

                {{-- {{ Auth::user()->perusahaan}} --}}

                <div class="card-body">
                    <form method="POST" action="{{ route('lowongan.store') }}">
                        @csrf
                        <div class="form-group p-3 border rounded">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Lowongan') }}</label>
                            <div class="col-md-12">
                                <input id="nama" type="text" class="form-control" name="nama"
                                    placeholder="Masukkan nama lowongan" required>
                            </div>
                        </div>
                        {{-- BIDANG KERJA --}}
                        <div class="form-group p-3 border rounded">
                            <label for="bidang" class="col-md-12 col-form-label">{{ __('Bidang Kerja') }}</label>
                            <div class="col-md-12">
                                <select name="bidang" id="bidang" class="form-control"
                                    placeholder="Masukkan bidang kerja" required>
                                    <option value="">Pilih Bidang Pekerjaan</option>
                                    @foreach ($bidang as $bidang)
                                        <option value="{{ $bidang->id }}"data-info="{{ $bidang->keterangan }}">
                                            {{ $bidang->nama_bidang }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- --- --}}
                        <div class="form-group p-3 border rounded">
                            <label for="posisi" class="col-md-12 col-form-label">{{ __('Posisi') }}</label>
                            <div class="col-md-12">
                                <input id="posisi" type="text" class="form-control" name="posisi"
                                    placeholder="Masukkan posisi kerja" required>
                            </div>
                        </div>
                        <div class="form-group p-3 border rounded">
                            <label for="kota"
                                class="col-md-12 col-form-label">{{ __('Penempatan Kerja (Kota)') }}</label>
                            <div class="col-md-12">
                                {{-- <input id="kota" type="text" class="form-control" name="kota"> --}}
                                <select name="kota" id="kota" class="form-control" required>
                                    <option value="">Pilih Kota</option>
                                    @foreach ($cities as $kota)
                                        @if ($kota['periode_update'] == 'Tahun 2022')
                                            <option value="{{ $kota['kabupaten_kota'] }}">{{ $kota['kabupaten_kota'] }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group p-3 border rounded">
                            <label for="sistem_kerja" class="col-md-12 col-form-label">{{ __('Sistem Kerja') }}</label>
                            <div class="col-md-12">
                                <select class="form-control" aria-label="Default select example" name="sistem_kerja"
                                    placeholder="Masukkan sistem kerja" required>
                                    <option value="Remote/Di Rumah">Remote/Di Rumah</option>
                                    <option value="Di Kantor">Di Kantor</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group p-3 border rounded">
                            <label for="tanggal_pemasangan"
                                class="col-md-12 col-form-label">{{ __('Tanggal Pemasangan') }}</label>
                            <div class="col-md-12">

                                <input type="datetime-local" id="tanggal_pemasangan" name="tanggal_pemasangan"
                                    class="form-control" required />
                            </div>
                        </div>
                        <div class="form-group p-3 border rounded">
                            <label for="tanggal_kadaluarsa"
                                class="col-md-12 col-form-label">{{ __('Tanggal Penutupan') }}</label>
                            <div class="col-md-12">
                                <input id="tanggal_kadaluarsa" type="datetime-local" class="form-control"
                                    name="tanggal_kadaluarsa" required>
                            </div>
                        </div>
                        <div class="form-group p-3 border rounded">
                            <label for="tanggal_penetapan"
                                class="col-md-12 col-form-label">{{ __('Tanggal Penetapan') }}</label>
                            <div class="col-md-12">
                                <input id="tanggal_penetapan" type="datetime-local" class="form-control"
                                    name="tanggal_penetapan" required>
                            </div>
                        </div>
                        <div class="form-group p-3 border rounded">
                            <label for="deskripsi_pekerjaan"
                                class="col-md-12 col-form-label">{{ __('Deskripsi Pekerjaan') }}</label>

                            <div class="col-md-12">
                                <textarea name="deskripsi_kerja" id="deskripsi_pekerjaan" class="form-control editor" rows="40"
                                    placeholder="Masukkan deskripsi kerja"></textarea>

                                @error('deskripsiPekerjaan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group p-3 border rounded">
                            <label for="pendidikan_terakhir"
                                class="col-md-12 col-form-label">{{ __('Pendidikan Terakhir') }}</label>
                            <div class="col-md-12">
                                <select class="form-control" aria-label="Default select example"
                                    name="pendidikan_terakhir" required="required">

                                    <option value="">Pilih Pendidikan</option>
                                    <option value="SD Sederajat">SD Sederajat</option>
                                    <option value="SMP Sederajat">SMP Sederajat</option>
                                    <option value="SMA Sederajat">SMA Sederajat</option>
                                    <option value="D1/D2/D3/D4">D1/D2/D3/D4</option>
                                    <option value="Sarjana(Strata-1)">Sarjana(Strata-1)</option>
                                    <option value="Pasca Sarjana">Pasca Sarjana</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group p-3 border rounded">
                            <label for="jenisKelamin" class="col-md-12 col-form-label">{{ __('Jenis Kelamin') }}</label>
                            <div class="col-md-12">
                                <select class="form-control" aria-label="Default select example" name="jenis_kelamin"
                                    required="required">

                                    <option value="Semua" selected>Semua</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group p-3 border rounded">
                            <label for="usiaOption" class="col-md-12 col-form-label">{{ __('Usia (Tahun)') }}</label>
                            <div class="col-md-12">
                                <select class="form-control" name="usiaOption" id="usiaOption" onchange="toggleInput()"
                                    required="required">
                                    <option value="usiaMinimal">Usia Minimal</option>
                                    <option value="rentangUsia" selected>Rentang Usia</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" id="usiaMinimal" style="display: none;">
                                    <br>
                                    <label for="inputUsiaMinimal">Usia Minimal:</label>
                                    <input type="number" class="form-control" name="usia_minimal" id="inputUsiaMinimal"
                                        placeholder="Masukkan usia minimal">
                                </div>
                            </div>
                            <div class="container" id="inputRentangUsia" style="display: none;">
                                <div class="row">
                                    <div class="col-sm">
                                        <br>
                                        <label for="inputUsiaAwal">Usia Minimal:</label>
                                        <input type="number" class="form-control" name="rentang_minimal"
                                            id="inputUsiaAwal" placeholder="Masukkan usia awal">
                                    </div>
                                    <div class="col-sm">
                                        <br>
                                        <label for="inputUsiaAkhir">Usia Maksimal:</label>
                                        <input type="number" class="form-control" name="rentang_maksimal"
                                            id="inputUsiaAkhir" placeholder="Masukkan usia akhir">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group p-3 border rounded">
                            <label for="kualifikasi_minimal"
                                class="col-md-12 col-form-label">{{ __('Kualifikasi Minimal') }}</label>

                            <div class="col-md-12">
                                <textarea name="kualifikasi_minimal" class="form-control editor" id="kualifikasi_minimal" cols="30"
                                    rows="10" placeholder="Masukkan kualifikasi minimal kerja"></textarea>

                                @error('kualifikasi_minimal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group p-3 border rounded">
                            <label for="jenisGaji" class="col-md-12 col-form-label">{{ __('Jenis Gaji') }}</label>
                            <div class="col-md-12">
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
                                    <input type="text" class="form-control" onkeyup="formatRupiah(this.value, this)"
                                        id="gajiPokok" name="gajiPokok">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row g-3" id="inputRentangGaji" style="display: none;">
                                    <div class="col-md-6">
                                        <br>
                                        <label for="minimalGaji">Minimal Gaji:</label>
                                        <input type="text" onkeyup="formatRupiah(this.value, this)"
                                            class="form-control" id="minimalGaji" name="minimalGaji">
                                    </div>
                                    <div class="col-md-6">
                                        <br>
                                        <label for="maksimalGaji">Maksimal Gaji:</label>
                                        <input type="text" onkeyup="formatRupiah(this.value, this)"
                                            class="form-control" id="maksimalGaji" name="maksimalGaji">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group p-3 border rounded">
                            <label class="form-label">Dokumen Persyaratan</label>
                            <div id="dokumen_perusahaan" class="row flex-column" style="min-height: 150px">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 90%">Nama</th>
                                            <th style="width: 10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="tambah_dokumen" class="p-3 border rounded">
                            <button type="button" id="btntambah" class="btn btn-primary btn-block" data-toggle="modal"
                                data-target="#tambahDokumenModal">Tambah Dokumen
                                Persyaratan</button>
                        </div>
                        <input type="hidden" name="perusahaans_id" value="{{ Auth::user()->perusahaans_id_admin }}">
                        <div class="form-group mt-3 rata_tengah">
                            <div class="col-md-12 offset-manual">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('SIMPAN') }}
                                </button>
                                <br>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="tambahDokumenModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Dokumen Persyaratan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="form-label">Nama Dokumen</label>
                        <input type="text" class="form-control" id="namadokumen">
                        <p class="text-muted text-sm">Jenis dokumen yang mendukung : pdf,png,jpg</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="btnSimpanDokumen">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
