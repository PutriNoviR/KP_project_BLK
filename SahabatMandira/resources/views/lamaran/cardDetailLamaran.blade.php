@if ($lamaran->status == 'Tahap Seleksi')
<div class="bg-primary rounded-top pt-3 pl-5 pb-2">
    <h2 class="text-white ">Kamu sedang dalam seleksi</h2>
    <p class="text-white text-sm">Periksa email kamu (termasuk folder spam) secara berkala untuk informasi
        proses seleksi selanjutnya, ya!</p>
</div>
@elseif ($lamaran->status == 'Terdaftar')
<div class="bg-warning rounded-top pt-3 pl-5 pb-2">
    <h2 class="text-white ">Kamu sudah terdaftar dalam lowongan ini</h2>
    <p class="text-white text-sm">Periksa email kamu (termasuk folder spam) secara berkala untuk informasi selanjutnya,
        ya!</p>
</div>
@elseif ($lamaran->status == 'Diterima')
<div class="bg-success rounded-top pt-3 pl-5 pb-2">
    <h2 class="text-white ">Selamat kamu sudah diterima</h2>
    <p class="text-white text-sm">Periksa email kamu (termasuk folder spam) secara berkala untuk informasi selanjutnya,
        ya!</p>
</div>
@elseif ($lamaran->status == 'Tidak Lolos Seleksi')
<div class="bg-danger rounded-top pt-3 pl-5 pb-2">
    <h2 class="text-white ">Mohon maaf sepertinya kamu belum lolos</h2>
    <p class="text-white text-sm">Periksa email kamu (termasuk folder spam) secara berkala untuk informasi selanjutnya,
        ya!</p>
</div>
@endif

<div id="informasi_pendaftaran" class=" pt-3 pl-5">
    <h4 class="font-weight-bold">Informasi Pendaftaran</h4>
    <span class=" text-muted text-sm">Tanggal Pendaftaran</span>
    <p class="p-0 m-0 mt-1">{{ date('d M Y', strtotime($lamaran->tanggal_pelamaran)) }}</p>
</div>
<hr>
<div id="detail_lamaran" class=" pl-5">
    <h5 class="font-weight-bold">Detail Lamaran</h5>
    <div class="row h-100">
        <div class="col-6">
            <img src="{{ asset('storage/'.$lamaran->lowongan->perusahaan->logo) }}" class="rounded d-block mt-3"
                style="height: 50px; width: 50px">
            <h4 class="font-weight-bold mt-3">{{ $lamaran->lowongan->nama }}</h4>
            <p>{{ $lamaran->lowongan->perusahaan->nama }}</p>
            <p class="text-muted">{{ $lamaran->lowongan->perusahaan->alamat }}</p>
        </div>
        <div class="col-6">
            <h5 class="font-weight-bolder">Dokumen Persyaratan</h5>
            <ul class="list-unstyled">
                @foreach ($dokumenLamarans as $dl)
                <li>
                    <a href="{{ asset('storage/'.$dl->value) }}" class="btn-link text-secondary"><i
                            class="far fa-fw fa-file-word"></i>
                        {{ $dl->dokumenlowongan->nama }}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
