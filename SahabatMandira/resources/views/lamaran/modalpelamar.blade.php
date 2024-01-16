<style>
    .info-label {
        width: 120px;
        /* Lebar label */
        display: inline-block;
    }
</style>
<script>
    function manual(value) {
        // console.log(value);
        $('#manualCheckbox').val(value);
    }
</script>
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalEditPelamar">Kandidat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        @php
            $tanggal_lahir = $user->tanggal_lahir;
            $tanggal_sekarang = date('Y-m-d'); // Tanggal hari ini
            $umur = date_diff(date_create($tanggal_lahir), date_create($tanggal_sekarang))->y;

            //seleksi jenis kelamin
            $seleksi = '';
            if ($lamaran->lowongan->jenis_kelamin == 'Semua') {
                $seleksi = 'Sesuai Kriteria';
            } else {
                if ($user->jenis_kelamin == $lamaran->lowongan->jenis_kelamin) {
                    $seleksi = 'Sesuai Kriteria';
                } else {
                    $seleksi = 'Tidak Sesuai Kriteria';
                }
            }

            //Seleksi Usia
            $usia_lowongan = $lamaran->lowongan->usia;
            $usia_selec = '';

            if (strpos($usia_lowongan, '-') !== false) {
                $result = explode('-', $usia_lowongan);
                if ($umur >= $result[0] && $umur <= $result[1]) {
                    $usia_selec = 'Sesuai Kriteria';
                } else {
                    $usia_selec = 'Tidak Sesuai Kriteria';
                }
            } else {
                if ($umur >= $usia_lowongan) {
                    $usia_selec = 'Sesuai Kriteria';
                }
            }
        @endphp
        <label for="">Info Pelamar</label>
        <div class="row ml-5">
            <div class="col-md-12">
                <p><span class="info-label">Email</span> : {{ $user->email }}</p>
                <p><span class="info-label">Jenis Kelamin</span> : {{ $user->jenis_kelamin }}
                    <strong>({{ $seleksi }})</strong>
                </p>
                <p><span class="info-label">Umur</span> : {{ $umur }} tahun
                    <strong>({{ $usia_selec }})</strong>
                </p>
                <p><span class="info-label">Status Lamaran </span> : {{ $lamaran->status }}</p>
            </div>
        </div>
        <hr>

        <div class="form-group">
            <label for="">Dokumen Persyaratan</label>
            <ul class="list-unstyled">
                @foreach ($dokumenLamaran as $dokumen)
                    <li>
                        <a href="{{ asset('storage/' . $dokumen->value) }}" class="btn-link text-secondary"><i
                                class="far fa-fw fa-file-word"></i>
                            {{ $dokumen->dokumenlowongan->nama }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        @if ($lamaran->status == 'Diterima' || $lamaran->status == 'Tidak Lolos Seleksi')
            <hr>
            @php
                $keterangan = $lamaran->keterangan;
                $kList = null;

                // Memeriksa apakah keterangan mengandung tanda koma
                if (strpos($keterangan, ',') !== false) {
                    // Jika ya, maka pisahkan nilai-nilai dengan tanda koma
                    $kList = explode(',', $keterangan);
                } else {
                    // Jika tidak, gunakan nilai keterangan langsung (tidak perlu explode)
                    $kList = [$keterangan]; // Masukkan dalam array untuk konsistensi
                }
            @endphp

            <div class="container mt-4">
                <label for="">Keterangan</label>

                <ul class="list-group list-group-flush">
                    @for ($i = 0; $i < count($kList); $i++)
                        <li class="list-group-item">{{ $kList[$i] }}</li>
                    @endfor
                </ul>
            </div>

            <div class="form-group">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        @else
            {{-- JIKA BELUM SELESAI ATAU DITOLAK --}}

            <form method="post" action="{{ route('lamaran.update', $lamaran->lowongans_id) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="users_email" value="{{ $lamaran->users_email }}">
                {{-- {{ $lamaran }} --}}
                <div class="form-group">
                    <select class="form-control" name="status" id="statusSelec"
                        onchange="onChangeStatus(this.value , '{{ $lamaran->status }}')" required>
                        @if ($lamaran->status == 'Terdaftar')
                            <option value="" selected>Pilih Status</option>
                            <option value="Tahap Seleksi">Seleksi</option>
                            <option value="Tidak Lolos Seleksi">Tolak</option>
                        @elseif($lamaran->status == 'Tahap Seleksi')
                            <option value="" selected>Pilih Status</option>
                            <option value="Diterima">Terima</option>
                            <option value="Tidak Lolos Seleksi">Tolak</option>
                        @elseif($lamaran->status == 'Diterima')
                            <option value="" selected>Pilih Status</option>
                            <option value="Diterima">Terima</option>
                        @endif
                    </select>
                </div>


                @if ($lamaran->status == 'Tahap Seleksi')
                    <div class="form-group" id="keteranganSeleksi">
                        <label for="">Keterangan peniliaian yang kurang</label>
                        <div class="container mt-2">
                            <div class="form-check">
                                <input class="form-check-input" name="keterangan[]" type="checkbox"
                                    value="Kemampuan dan komunikasi kurang bagus." id="exampleCheckbox1">
                                <label class="form-check-label" for="exampleCheckbox1">
                                    Kemampuan dan komunikasi kurang bagus.
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="keterangan[]" type="checkbox"
                                    value="Tidak berpenampilan rapi dan tidak antusias." id="exampleCheckbox2">
                                <label class="form-check-label" for="exampleCheckbox2">
                                    Tidak berpenampilan rapi dan tidak antusias.
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="keterangan[]" type="checkbox"
                                    value="Tidak cocok terhadap budaya perusahaan." id="exampleCheckbox3">
                                <label class="form-check-label" for="exampleCheckbox3">
                                    Tidak cocok terhadap budaya perusahaan.
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="keterangan[]" type="checkbox"
                                    value="Tidak fleksibel dalam belajar." id="exampleCheckbox3">
                                <label class="form-check-label" for="exampleCheckbox3">
                                    Tidak fleksibel dalam belajar.
                                </label>


                            </div>
                            <!-- Checkbox with Manual Input -->
                            <div class="form-check">
                                <input class="form-check-input" name="keterangan[]" type="checkbox" value=""
                                    id="manualCheckbox">
                                <label class="form-check-label" for="manualCheckbox">
                                    <input type="text" class="form-control" id="manualInput" placeholder="Lainnya"
                                        onchange="manual(this.value)">
                                </label>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="form-group" id="hideKet" hidden>
                        <label for="">Keterangan peniliaian yang kurang</label>
                        <div class="form-check">
                            <input class="form-check-input" name="keterangan[]" type="checkbox"
                                value=" Pendidikan Tidak Sesuai Kriteria." id="exampleCheckbox1">
                            <label class="form-check-label" for="exampleCheckbox1">
                                Pendidikan Tidak Sesuai Kriteria
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="keterangan[]" type="checkbox"
                                value="Tidak Mengikuti Pelatihan (Tidak Kompeten)." id="exampleCheckbox2">
                            <label class="form-check-label" for="exampleCheckbox2">
                                Tidak Mengikuti Pelatihan (Tidak Kompeten)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="keterangan[]" type="checkbox"
                                value=" Usia Tidak Sesuai Kriteria." id="exampleCheckbox3">
                            <label class="form-check-label" for="exampleCheckbox3">
                                Usia Tidak Sesuai Kriteria
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="keterangan[]" type="checkbox"
                                value=" Gender Tidak Sesuai Kriteria." id="exampleCheckbox3">
                            <label class="form-check-label" for="exampleCheckbox3">
                                Gender Tidak Sesuai Kriteria
                            </label>


                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>

<script>
    var keteranganSeleksi = document.getElementById("keteranganSeleksi");
    if (keteranganSeleksi !== null) {
        keteranganSeleksi.style.display = "none";
    } else {
        console.log("Element with ID 'keteranganSeleksi' does not exist.");
    }
</script>
