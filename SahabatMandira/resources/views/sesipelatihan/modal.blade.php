<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Edit Sesi Pelatihan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form method="POST" action="{{ route('sesiPelatihan.update',$sesiPelatihan->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="deskripsi" class="col-md-12 col-form-label">{{ __('Deskripsi Pelatihan') }}</label>
                <!-- <input type="text" class="col-md-12 col-form-label" name="deskripsi" value="{{ $sesiPelatihan->deskripsi}}"> -->
                <textarea name="deskripsi" class="form-control deskripsi" required cols="40" rows="10">{{ $sesiPelatihan->deskripsi}}</textarea>
            </div>
            <div class="form-group">
                <label for="fotoPelatihan" class="col-md-12 col-form-label">{{ __('Foto Pelatihan') }}</label>
                {{-- pake if kalo datanya ada, maka required nya hilang --}}
                <input type="file" id="fotoPelatihanInput" name='fotoPelatihan' class="defaults" accept="image/png, image/gif, image/jpeg" required>
            </div>

            <div id="previewFoto">
                <h5>Preview Foto Sebelumnya</h5>
                <img id="fotoPelatihan" src="{{ asset('storage/'.$sesiPelatihan->gambar_pelatihan) }}" alt="Preview Gambar Pelatihan" style="max-width: 200px; max-height: 200px;">
            </div>
            <br>
            <div id="previewFotoPelatihan">
                <img id="fotoPelatihanPreview" src="#" alt="Gambar Baru akan ditampilkan disini" style="max-width: 200px; max-height: 200px;">
            </div>

            <div class="form-group">
                <label for="tanggalBukaPendaftaran" class="col-md-12 col-form-label">{{ __('Tanggal Buka Pendaftaran') }}</label>
                <input type="datetime-local" class="col-md-12 col-form-label" name="tanggal_pendaftaran" value="<?php echo date('Y-m-d\TH:i:s', strtotime($sesiPelatihan->tanggal_pendaftaran)); ?>">

                <div class="col-md-12">

                    @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="tanggalTutupPendaftaran" class="col-md-12 col-form-label">{{ __('Tanggal Tutup Pendaftaran') }}</label>
                <input type="datetime-local" class="col-md-12 col-form-label" name="tanggal_tutup" value="<?php echo date('Y-m-d\TH:i:s', strtotime($sesiPelatihan->tanggal_tutup)); ?>">

                <div class="col-md-12">

                    @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>


            <div class="form-group">
                <label for="lokasi" class="col-md-12 col-form-label">{{ __('Lokasi') }}</label>
                <input type="text" class="col-md-12 col-form-label" name="lokasi" value="{{$sesiPelatihan->lokasi}}">
            </div>

            <div class="form-group">
                <label for="tanggalSeleksi" class="col-md-12 col-form-label">{{ __('Tanggal Seleksi') }}</label>
                <input type="datetime-local" class="col-md-12 col-form-label" name="tanggal_seleksi" value="<?php echo date('Y-m-d\TH:i:s', strtotime($sesiPelatihan->tanggal_seleksi)); ?>">

                <div class="col-md-12">

                    @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="tanggalMulaiDaftarUlang" class="col-md-12 col-form-label">{{ __('Tanggal Mulai Daftar Ulang') }}</label>
                <input type="datetime-local" class="col-md-12 col-form-label" name="tanggalMulaiDaftarUlang" value="{{$sesiPelatihan->tanggal_mulai_daftar_ulang}}">

                <div class="col-md-12">

                    @error('tanggalMulaiDaftarUlang')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="tanggalSelesaiDaftarUlang" class="col-md-12 col-form-label">{{ __('Tanggal Selesai Daftar Ulang') }}</label>
                <input type="datetime-local" class="col-md-12 col-form-label" name="tanggalSelesaiDaftarUlang" value="{{$sesiPelatihan->tanggal_selesai_daftar_ulang}}">

                <div class="col-md-12">

                    @error('tanggalSelesaiDaftarUlang')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="tanggalMulaiPelatihan" class="col-md-12 col-form-label">{{ __('Tanggal Mulai Pelatihan') }}</label>
                <input type="datetime-local" class="col-md-12 col-form-label" name="tanggal_mulai_pelatihan" value="<?php echo date('Y-m-d\TH:i:s', strtotime($sesiPelatihan->tanggal_mulai_pelatihan)); ?>">

                <div class="col-md-12">

                    @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="tanggalSelesaiPelatihan" class="col-md-12 col-form-label">{{ __('Tanggal Selesai Pelatihan') }}</label>
                <input type="datetime-local" class="col-md-12 col-form-label" name="tanggal_selesai_pelatihan" value="<?php echo date('Y-m-d\TH:i:s', strtotime($sesiPelatihan->tanggal_selesai_pelatihan)); ?>">

                <div class="col-md-12">

                    @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="sumberDana" class="col-md-12 col-form-label">{{ __('Sumber Dana') }}</label>
                <div class="col-md-12">
                    <select class="form-control" aria-label="Default select example" name="sumberDana" value="{{$sesiPelatihan->selectedSumberDana}}">
                        <option value="APBN">APBN</option>
                        <option value="APBD">APBD</option>
                        <option value="SWADANA">SWADANA</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="harga" class="col-md-12 col-form-label">{{ __('Harga') }}</label>
                <input type="text" class="col-md-12 col-form-label" name="harga" value="{{$sesiPelatihan->harga}}">
            </div>

            <div class="form-group">
                <label for="kuota" class="col-md-12 col-form-label">{{ __('Kuota Peserta Diterima') }}</label>
                <input type="text" class="col-md-12 col-form-label" name="kuota" value="{{$sesiPelatihan->kuota}}">
            </div>

            <div class="form-group">
                <label for="kuota_daftar" class="col-md-12 col-form-label">{{ __('Kuota Pendaftar') }}</label>
                <input type="text" class="col-md-12 col-form-label" name="kuota_daftar" value="{{$sesiPelatihan->kuota_daftar}}">
            </div>

            <div class="form-group">
                <label for="jamPelajaran" class="col-md-12 col-form-label">{{ __('Jam Pelajaran') }}</label>
                <input type="text" onkeypress="return /[0-9]/i.test(event.key)" class="col-md-12 col-form-label" name="jamPelajaran" value="{{$sesiPelatihan->jamPelajaran}}">
            </div>

            <div class="form-group">
                <label for="kuota" class="col-md-12 col-form-label">{{ __('Nomor Surat') }}</label>
                <input type="text" class="col-md-12 col-form-label" name="nomorSurat" value="{{$sesiPelatihan->nomorSurat}}">
            </div>

            <div class="form-group">
                <label for="tanggalSurat" class="col-md-12 col-form-label">{{ __('Tanggal Surat') }}</label>
                <input type="datetime-local" class="col-md-12 col-form-label" name="tanggalSurat" value="<?php echo date('Y-m-d\TH:i:s', strtotime($sesiPelatihan->tanggalSurat)); ?>">

                <div class="col-md-12">

                    @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="tanggalSertif" class="col-md-12 col-form-label">{{ __('Tanggal Sertifikat') }}</label>
                <input type="datetime-local" class="col-md-12 col-form-label" name="tanggalSertif" value="<?php echo date('Y-m-d\TH:i:s', strtotime($sesiPelatihan->tanggalSertif)); ?>">

                <div class="col-md-12">

                    @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="aktivitas" class="col-md-12 col-form-label">{{ __('Aktivitas') }}</label>
                <textarea class="col-md-12 col-form-label activity" rows="3" name="aktivitas">{{$sesiPelatihan->aktivitas}}</textarea>
                <input type="hidden" name="paket_program_id" class="col-md-12 col-form-label" value="{{$sesiPelatihan->paket_program_id}}">
            </div>

            <div class="form-group">
                <label for="harga" class="col-md-12 col-form-label">{{ __('Minimal Kelulusan') }}</label>
                <input type="number" class="col-md-12 col-form-label" name="nilaiMinimalLulus" value="">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
                <button type="submit" class="btn btn-primary">SIMPAN</button>
            </div>
        </form>
    </div>
</div>

<script>
// Ambil elemen input file
const fotoPelatihanInput = document.getElementById('fotoPelatihanInput');

// Ambil elemen img untuk preview gambar
const fotoPelatihanPreview = document.getElementById('fotoPelatihanPreview');

// Tambahkan event listener untuk input file
fotoPelatihanInput.addEventListener('change', function () {
    // Pastikan ada file yang dipilih
    if (fotoPelatihanInput.files && fotoPelatihanInput.files[0]) {
        const reader = new FileReader();

        // Saat file berhasil dibaca
        reader.onload = function (e) {
            // Tampilkan gambar pada elemen img
            fotoPelatihanPreview.src = e.target.result;
        };

        // Baca file yang dipilih
        reader.readAsDataURL(fotoPelatihanInput.files[0]);
    }
});
</script>