<style>
    .ck-editor__editable_inline {
        min-height: 200px;
    }
</style>

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


    $('body').on('click', '.btndeleterow', function() {
        $(this).parent().parent().remove();
    })

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

    $("#jenisGaji").change(function() {
        if ($(this).val() === "gajiPokok") {
            $("#inputGajiPokok").show();
            $("#inputRentangGaji").hide();
        } else if ($(this).val() === "rentangGaji") {
            $("#inputGajiPokok").hide();
            $("#inputRentangGaji").show();
        }
    });

    document.getElementById("pendidikan").value = "{{ $lowongan->pendidikan_terakhir }}";
    document.getElementById("sistem_kerja").value = "{{ $lowongan->sistem_kerja }}";
    document.getElementById("kota").value = "{{ $lowongan->kota }}";
    $("#kota").select2();
    var gaji = "{{ $lowongan->gaji }}";
    var split = gaji.split("-");

    if (!split[1]) {
        document.getElementById('jenisGaji').value = 'gajiPokok';
        $("#inputGajiPokok").show();
        $("#gajiPokok").val(gaji);
    } else {
        document.getElementById('jenisGaji').value = 'rentangGaji';
        $("#inputRentangGaji").show();
        $("#minimalGaji").val(split[0]);
        $("#maksimalGaji").val(split[1]);
    }
</script>
<script>
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
</script>
<script>
    $("#jenis_kelamin").val('{{ $lowongan->jenis_kelamin }}');
    var usiaMinimal = document.getElementById("usiaMinimal");
    var inputRentangUsia = document.getElementById("inputRentangUsia");
    var usia = '{{ $lowongan->usia }}';
    var split2 = usia.split("-");
    if (!split2[1]) {
        $('usiaOption').val('usiaMinimal');
        usiaMinimal.style.display = "block";
        inputRentangUsia.style.display = "none";

        $('#inputUsiaMinimal').val(usia);
    } else {
        $('usiaOption').val('rentangUsia');
        usiaMinimal.style.display = "none";
        inputRentangUsia.style.display = "block";
    }

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

    $(document).ready(function() {
        // var todayDate = new Date().toISOString().slice(0, 10);
        var todayDate = new Date().toISOString().slice(0, 16);
        // console.log(todayDate);

        // $("#tanggal_pemasangan").val(todayDate);
        var dateInput = document.getElementById("tanggal_pemasangan");
        var datePenutupan = document.getElementById("tanggal_kadaluarsa");
        var datePenetapan = document.getElementById("tanggal_penetapan");
        dateInput.min = todayDate;
        datePenutupan.min = todayDate;
        dateInput.value = todayDate;
        //
        // Convert the string value to a Date object
        var selectedDate = new Date(datePenutupan.value);

        // Add three days to the selected date
        selectedDate.setDate(selectedDate.getDate() + 3);

        // Format the new date as YYYY-MM-DD
        var threeDaysLater = selectedDate.toISOString().slice(0, 16);

        // Set the minimum date for datePenutupan
        document.getElementById("tanggal_penetapan").min = threeDaysLater;

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
</script>


<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalEditLowongan">Edit Lowongan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form method="POST" action="{{ route('lowongan.update', $lowongan->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col px-0">
                <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Lowongan') }}</label>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="nama" value="{{ $lowongan->nama }}" required>
                </div>
            </div>

            <div class="col px-0">
                <label for="bidang" class="col-md-12 col-form-label">{{ __('Bidang Kerja') }}</label>
                <div class="col-md-12">
                    <select name="bidang" id="bidang" class="form-control" required>
                        <option value="">Pilih Bidang Pekerjaan</option>
                        @foreach ($bidang as $bidang)
                            @php
                                $selected = '';

                                if ($bidang->id == $lowongan->bidang_kerja_id) {
                                    $selected = 'selected';
                                }
                            @endphp
                            <option value="{{ $bidang->id }}"data-info="{{ $bidang->keterangan }}"
                                {{ $selected }}>
                                {{ $bidang->nama_bidang }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col px-0">
                <label for="posisi" class="col-md-12 col-form-label">{{ __('Posisi') }}</label>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="posisi" value="{{ $lowongan->posisi }}" required>
                </div>
            </div>
            <div class="col px-0">
                <label for="kota" class="col-md-12 col-form-label">{{ __('Tempat Kerja') }}</label>
                <div class="col-md-12">
                    <select name="kota" id="kota" class="form-control" required>
                        <option value="">Pilih Kota</option>
                        @foreach ($kota as $kota)
                            @if ($kota['periode_update'] == 'Tahun 2022')
                                <option value="{{ $kota['kabupaten_kota'] }}">{{ $kota['kabupaten_kota'] }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    {{-- <input type="text" class="form-control" name="kota" value="{{ $lowongan->kota }}" required> --}}
                </div>
            </div>
            <div class="col px-0">
                <label for="sistem_kerja" class="col-md-12 col-form-label">{{ __('Sistem Kerja') }}</label>
                <div class="col-md-12">
                    <select class="form-control" aria-label="Default select example" id="sistem_kerja"
                        name="sistem_kerja" required="required">
                        <option value="Remote/Di Rumah">Remote/Di Rumah</option>
                        <option value="Di Kantor">Di Kantor</option>
                    </select>
                    {{-- <input type="text" class="form-control" name="sistem_kerja" value="{{ $lowongan->sistem_kerja }}" required> --}}
                </div>
            </div>
            <div class="col px-0">
                <label for="tanggal_pemasangan" class="col-md-12 col-form-label">{{ __('Tanggal Pemasangan') }}</label>
                <div class="col-md-12">
                    <input id="tanggal_pemasangan" type="datetime-local" class="form-control" name="tanggal_pemasangan"
                        value="<?php echo date('Y-m-d\TH:i:s', strtotime($lowongan->tanggal_pemasangan)); ?>" readonly>
                    <div class="col-md-12">

                        @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="col px-0">
                <label for="tanggal_kadaluarsa" class="col-md-12 col-form-label">{{ __('Tanggal Penutupan') }}</label>
                <div class="col-md-12">
                    <input id="tanggal_kadaluarsa" type="datetime-local" class="form-control" name="tanggal_kadaluarsa"
                        value="<?php echo date('Y-m-d\TH:i:s', strtotime($lowongan->tanggal_kadaluarsa)); ?>" required>
                    <div class="col-md-12">

                        @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col px-0">
                <label for="tanggal_penetapan" class="col-md-12 col-form-label">{{ __('Tanggal Penetapan') }}</label>
                <div class="col-md-12">
                    <input id="tanggal_penetapan" type="datetime-local" class="form-control" name="tanggal_penetapan"
                        value="<?php echo date('Y-m-d\TH:i:s', strtotime($lowongan->tanggal_penetapan)); ?>" required>
                    <div class="col-md-12">

                        @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col px-0">
                <label for="pendidikan_terakhir" class="col-md-12 col-form-label">Pendidikan Terakhir</label>
                <div class="col-md-12">
                    <select class="form-control" aria-label="Default select example" name="pendidikan_terakhir"
                        id="pendidikan" required="required">
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
            {{-- JENIS KELAMIN --}}
            {{-- <div class="col-md-12">
                <div class="row g-3">
                    <div class="col-md-6">
                        <br>
                        <label for="usiaOption">Usia:</label>
                        <select class="form-control" name="usiaOption" id="usiaOption" onchange="toggleInput()">
                            <option value="usiaMinimal">Usia Minimal</option>
                            <option value="rentangUsia">Rentang Usia</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="usiaMinimal" style="display:none;">
                            <br><label for="inputUsiaMinimal">Usia Minimal:</label>
                            <input type="number" class="form-control" name="usia_minimal" id="inputUsiaMinimal"
                                placeholder="Masukkan usia minimal">
                        </div>

                        <div class="form-group" id="inputRentangUsia">
                            <br><label for="inputUsiaAwal">Usia Minimal:</label>
                            <input type="number" class="form-control" name="rentang_minimal" id="inputUsiaAwal"
                                placeholder="Masukkan usia awal"><br>
                            <label for="inputUsiaAkhir">Usia Maksimal:</label>
                            <input type="number" class="form-control" name="rentang_maksimal" id="inputUsiaAkhir"
                                placeholder="Masukkan usia akhir">
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col px-0">
                <label for="usiaOption" class="col-md-12 col-form-label">Usia:</label>
                <div class="col-md-12">
                    <select class="form-control" name="usiaOption" id="usiaOption" onchange="toggleInput()"
                        required="required">
                        <option value="usiaMinimal">Usia Minimal</option>
                        <option value="rentangUsia">Rentang Usia</option>
                    </select>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group" id="usiaMinimal" style="display:none;">
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
                        <input type="number" class="form-control" name="rentang_minimal" id="inputUsiaAwal"
                            placeholder="Masukkan usia awal">
                    </div>
                    <div class="col-sm">
                        <br>
                        <label for="inputUsiaAkhir">Usia Maksimal:</label>
                        <input type="number" class="form-control" name="rentang_maksimal" id="inputUsiaAkhir"
                            placeholder="Masukkan usia akhir">
                    </div>
                </div>
            </div>
            <div class="col px-0">
                <label for="jenisKelamin" class="col-md-12 col-form-label">Jenis Kelamin</label>
                <div class="col-md-12">
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                        <option value="Semua" selected>Semua</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="col px-0">
                <label for="jenisGaji" class="col-md-12 col-form-label">Jenis Gaji</label>
                <div class="col-md-12">
                    <select id="jenisGaji" class="form-control" aria-label="Default select example" name="jenisGaji"
                        required="required">
                        <option value="">Pilih Jenis Gaji</option>
                        <option value="gajiPokok">Gaji Pokok</option>
                        <option value="rentangGaji">Rentang Gaji</option>
                    </select>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group" id="inputGajiPokok" style="display: none;">
                    <br>
                    <label for="gajiPokok">Gaji Pokok:</label>
                    <input type="text" class="form-control" id="gajiPokok" name="gajiPokok">
                </div>
            </div>
            <div class="col-md-12">
                <div class="row g-3" id="inputRentangGaji" style="display: none;">
                    <div class="col-md-6">
                        <br>
                        <label for="minimalGaji">Minimal Gaji:</label>
                        <input type="text" class="form-control" id="minimalGaji" name="minimalGaji">
                    </div>
                    <div class="col-md-6">
                        <br>
                        <label for="maksimalGaji">Maksimal Gaji:</label>
                        <input type="text" class="form-control" id="maksimalGaji" name="maksimalGaji">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="deskripsi_pekerjaan"
                    class="col-md-12 col-form-label">{{ __('Deskripsi Pekerjaan') }}</label>

                <div class="col-md-12">
                    <textarea name="deskripsi_kerja" id="deskripsi_pekerjaan" class="form-control editor" cols="30"
                        rows="10">{{ $lowongan->deskripsi_kerja }}</textarea>

                    @error('deskripsiPekerjaan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="kualifikasi_minimal"
                    class="col-md-12 col-form-label">{{ __('Kualifikasi Minimal') }}</label>

                <div class="col-md-12">
                    <textarea name="kualifikasi_minimal" class="form-control editor" id="kualifikasi_minimal" cols="30"
                        rows="10">{{ $lowongan->kualifikasi_minimal }}</textarea>

                    @error('kualifikasi_minimal')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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
                            @foreach ($dokumenLowongan as $dl)
                                <tr>
                                    <td style="width:90%">{{ $dl->nama }}</td>
                                    <td style="width:10%"><button type="button" class="btndeleterow btn btn-danger">
                                            <i class="fas fa-trash"></i></button></td>
                                </tr>
                            @endforeach
                        </thead>
                        <tbody id="tbody">
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="tambah_dokumen" class="p-3 border rounded">
                <button type="button" id="btntambah" class="btn btn-primary btn-block" data-toggle="modal"
                    data-target="#tambahDokumenModal">Tambah Dokumen Persyaratan</button>
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

<!-- Modal Tambah Dokumen-->
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
