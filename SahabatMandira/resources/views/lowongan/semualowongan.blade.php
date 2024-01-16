@extends('layouts.adminlte')

@section('javascript')
    <script>
        function formatOption(option) // Fungsi untuk nampilkan select bidang kerja
        {
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
        $('#kota').select2();

        // Ambil data berdasarkan Id di 'Cari'
        const searchInput = document.getElementById('searchInput');
        // Fungsi akan dijalankan jika value berubah
        searchInput.addEventListener('input', function(event) {
            const searchTerm = event.target.value.trim(); // Dapatkan teks yang dimasukkan pengguna

            // Ubah filter gaji, bidang, kota jika 'cari' dijalankan
            $('#rangeGaji').val('');
            $('#bidang').val('').trigger('change');
            $('#kota').val('').trigger('change');
            //

            $.ajax({
                url: '{{ route('search') }}',
                method: 'GET',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'searchTerm': searchTerm
                },
                success: function(response) {
                    // console.log(response);
                    $('#isiKonten').html(response.msg);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        //function untuk mengirimkan pencarian ke controller
        function cariData() {
            var gaji = $('#rangeGaji').val();
            var bidang = $('#bidang').val();
            var kota = $('#kota').val();

        // untuk mengirimkan pencarian ke controller
            $.ajax({
                url: '{{ route('filterLowongan') }}',
                method: 'POST',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'gaji': gaji,
                    'bidang': bidang,
                    'kota': kota
                },
                success: function(response) {
                    // isiKonten = id card lowongan
                    $('#isiKonten').html(response.msg);
                },
                error: function(error) {
                    console.log(error);
                }
            });

            // console.log(gaji);
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
        function bersihkan(){
            var gaji = $('#rangeGaji').val('');
            $('#bidang').val('').trigger('change');
            $('#kota').val('').trigger('change');

            cariData();
        }
    </script>
@endsection

@section('contents')
    <section class="content">

        <form action="/semua-lowongan/filter" method="POST">
            @csrf
            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="form-group fload-right">
                        <label class="col-md-4 col-form-label"> Cari </label>
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari..." aria-label="Cari..."
                            aria-describedby="button-addon2">
                    </div>

                    <div class="form-group p-3 border rounded">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="col-md-12 col-form-label"> Gaji </label>
                                <select name="gaji" class="form-control" id="rangeGaji">
                                    <option value="">Pilih Gaji</option>
                                    <option value="<4">Kurang dari 4 Juta/Bulan</option>
                                    <option value="4-8">4-8 Juta/Bulan</option>
                                    <option value="8-15">8-15 Juta/Bulan</option>
                                    <option value="15-25">15-25 Juta/Bulan</option>
                                    <option value="25-40">25-40 Juta/Bulan</option>
                                    <option value=">40">40 Juta+ /Bulan</option>
                                </select>
                            </div>
                            {{-- Bidang Kerja --}}
                            <div class="col-md-4">
                                <label for="bidang" class="col-md-12 col-form-label">{{ __('Bidang Kerja') }}</label>
                                <select name="bidang" id="bidang" class="form-control">
                                    <option value="">Pilih Bidang Pekerjaan</option>
                                    @foreach ($bidang as $bidang)
                                        <option value="{{ $bidang->id }}" data-info="{{ $bidang->keterangan }}">
                                            {{ $bidang->nama_bidang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Kota --}}
                            <div class="col-md-4">
                                <label for="kota" class="col-md-12 col-form-label">{{ __('Kota') }}</label>
                                <select name="kota" id="kota" class="form-control">
                                    <option value="">Pilih Kota</option>
                                    @foreach ($kota as $kota)
                                        @if ($kota['periode_update'] == 'Tahun 2022')
                                            <option value="{{ $kota['kabupaten_kota'] }}">{{ $kota['kabupaten_kota'] }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Cari Button --}}
                        <div class="col-md-12 text-right mt-3">
                            <button type="button" class="btn btn-secondary" onclick="bersihkan()">Bersihkan Filter</button>
                            <button type="button" class="btn btn-primary" onclick="cariData()">Cari</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body pb-0">
                <div class="row d-flex align-items-stretch" id="isiKonten">
                    @foreach ($lowongans as $lowongan)
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                            <div class="card bg-light w-100">
                                <div class="card-header border-bottom-0 text-primary">
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-7">
                                            <h1 class="lead"><b>{{ $lowongan->posisi }}</b></h1>
                                            <h6 class="text-muted">{{ $lowongan->perusahaan->nama }}</h6>
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li class="small"><span class="fa-li">
                                                        <i class="fas fa-briefcase"></i></span> Bidang:
                                                    {{ $lowongan->bidang_kerja->nama_bidang }} -
                                                    {{ $lowongan->bidang_kerja->keterangan }}</li>
                                            </ul>
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li class="small"><span class="fa-li"><i
                                                            class="fas fa-lg fa-building"></i></span> Kota:
                                                    {{ $lowongan->kota }}</li>
                                            </ul>

                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                {{-- Pemisah '-' --}}
                                                <li class="small"><span class="fa-li"><b>Rp</b></span> Gaji:
                                                    @php
                                                    $ep = explode('-', $lowongan->gaji);
                                                @endphp
    
                                                @if (count($ep) > 1)
                                                    {!! number_format($ep[0], 2, ',', '.') . ' - ' . number_format($ep[1], 2, ',', '.') !!}
                                                @else
                                                    {!! number_format($lowongan->gaji, 2, ',', '.') !!}
                                                @endif
                                            </ul>


                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li class="small"><span class="fa-li"><i
                                                            class="fa fa-calendar"></i></span> Tanggal Dibuat:
                                                    {{ $lowongan->tanggal_pemasangan }}</li>
                                            </ul>

                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li class="small"><span class="fa-li"><i class="fa fa-user"></i></span>
                                                    Jumlah Pelamar:
                                                    {{ count($lowongan->lamaran) }}</li>
                                            </ul>
                                        </div>
                                        <div class="col-5 text-center">
                                            <img src="{{ asset('storage/' . $lowongan->perusahaan->logo) }} "
                                                alt="" class="img-circle img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <a href="{{ route('lowongan.show', $lowongan->id) }}"
                                            class="btn btn-sm btn-primary">
                                            Apply
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <nav aria-label="Contacts Page Navigation">
                </nav>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->

    </section>
@endsection
