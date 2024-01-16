<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalEditLowongan">View Lowongan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <div class="container">
            <div class="card">
                <div class="card-body">
                    <p class="card-text"><b>Nama Lowongan:</b> {{ $lowongan->nama }}</p>
                    <p class="card-text"><b>Bidang Kerja:</b> {{ $lowongan->bidang_kerja->nama_bidang }}</p>
                    <p class="card-text"><b>Posisi:</b> {{ $lowongan->posisi }}</p>
                    <p class="card-text"><b>Penempatan Kerja:</b> {{ $lowongan->kota }}</p>
                    <p class="card-text"><b>Sistem Kerja:</b> {{ $lowongan->sistem_kerja }}</p>
                    <p class="card-text"><b>Tanggal Pemasangan:</b> <?php echo date('Y-m-d', strtotime($lowongan->tanggal_pemasangan)); ?></p>
                    <p class="card-text"><b>Tanggal Kadaluarsa:</b> <?php echo date('Y-m-d', strtotime($lowongan->tanggal_kadaluarsa)); ?></p>
                    <p class="card-text"><b>Tanggal Penetapan:</b> <?php echo date('Y-m-d', strtotime($lowongan->tanggal_penetapan)); ?></p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label class="card-text" for="deskripsi_pekerjaan">{{ __('Deskripsi Pekerjaan:') }}</label>
                        {!! $lowongan->deskripsi_kerja !!}
                        @error('deskripsiPekerjaan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="card-text" for="gaji">{{ __('Gaji:') }}</label>
                        {!! $lowongan->gaji !!}
                        @error('gaji')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="card-text" for="pendidikan_terakhir">{{ __('Pendidikan Terakhir:') }}</label>
                        {!! $lowongan->pendidikan_terakhir !!}
                        @error('pendidikan_terakhir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="card-text" for="usia">{{ __('Usia:') }}</label>
                        {!! $lowongan->usia !!}
                        @error('usia')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="card-text" for="jenis_kelamin">{{ __('Jenis Kelamin:') }}</label>
                        {!! $lowongan->jenis_kelamin !!}
                        @error('jenis_kelamin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kualifikasi_minimal" class="card-text">{{ __('Kualifikasi Minimal:') }}</label>
                        {!! $lowongan->kualifikasi_minimal !!}
                        @error('kualifikasi_minimal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Dokumen Persyaratan</label>
                        {{-- <div id="dokumen_perusahaan" class="row flex-column" style="min-height: 150px"> --}}
                            @foreach ($dokumenLowongan as $dl)
                                <p class="card-text"> {{ $dl->nama }}</p>
                            @endforeach
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- <div id="tambah_dokumen" class="p-3 border rounded">
                <button type="button" id="btntambah" class="btn btn-primary btn-block" data-toggle="modal"
                    data-target="#tambahDokumenModal">Tambah Dokumen Persyaratan</button>
            </div> --}}
        <input type="hidden" name="perusahaans_id" value="{{ Auth::user()->perusahaans_id_admin }}">
        <div class="form-group mt-3 rata_tengah">
            <div class="col-md-12 offset-manual">

                <br>
            </div>
        </div>
    </div>
</div>
