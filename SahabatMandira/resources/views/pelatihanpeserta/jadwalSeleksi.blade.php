@extends('layouts.adminlte')

@section('title')
PELATIHAN PESERTA
@endsection

@section('javascript')
<script>
    function printDiv(divName){
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;

    }
</script>
@endsection

@section('contents')
<div class="col-sm-12 text-center">
    <h2 class="m-0 text-dark">Bukti Pendaftaran Seleksi</h2><br>
</div>

<div class="col-sm-6 mx-auto text-center">
    <div class="card-body">
        <button class="btn btn-info" onclick="printDiv('print-area');"><i class="fa fa-print"></i> CETAK</button>
    </div>
    <div class="card card-success">
        <div class="card-header">
            <h3 class="mx-auto"><b>PENDAFTARAN BERHASIL</b></h3>
        </div>

        <div class="card-body">
            <h2>Nama Peserta :</h2>
            <h4><b>{{$data->nama }}</b></h4>
            {{-- <h2>Jadwal Seleksi :</h2> --}}
            @php
                function tgl_indo($tanggal){
                    $bulan = array (
                        1 =>   'Januari',
                        'Februari',
                        'Maret',
                        'April',
                        'Mei',
                        'Juni',
                        'Juli',
                        'Agustus',
                        'September',
                        'Oktober',
                        'November',
                        'Desember'
                    );
                    $split = explode('-', $tanggal);
                
                    return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
                }

                $tgl_mulai = explode(' ',$data->mulai)[0];
                $tgl_selesai = explode(' ',$data->selesai)[0];
            @endphp

            {{--
            <h4><b>{{ tgl_indo($date) }}</b></h4>
            <h4><b>{{ $time.' WIB' }}</b></h4>
             --}}
        </div>
        <div class="card-body">
            <h2>BLK Penyelenggara :</h2>
            <h4><b>{{ $data->blk}}</b></h4>
        </div>
        <div class="card-body">
            <h2>Kejuruan :</h2>
            <h4><b>{{ $data->kejuruan}}</b></h4>
        </div>
        <div class="card-body">
            <h2>Sub-kejuruan :</h2>
            <h4><b>{{ $data->subkejuruan}}</b></h4>
        </div>
        <div class="card-body">
            <h2>Periode Pelatihan :</h2>
            <h4><b>{{ tgl_indo($tgl_mulai) }}</b> s.d <b>{{ tgl_indo($tgl_selesai) }}</b></h4>
        </div>
        <div class="card-body">
            <h2>Alamat Seleksi :</h2>
            <h4><b>{{ $data->lokasi}}</b></h4>
        </div>
    </div>
</div>

<div style="visibility: hidden" id="print-area">
    <br><br>
    <center>
        <h2>BUKTI PENDAFTARAN</h2>
        <hr width="80%">
        <h3>PENDAFTARAN BERHASIL</h3>
        <br>
        <h4>Nama Peserta :</h4>
        <h5><b>{{$data->nama }}</b></h5>
        <br>
        <h4>BLK Penyelenggara :</h4>
        <h5><b>{{ $data->blk}}</b></h5>
        <br>
        <h4>Kejuruan :</h4>
        <h5><b>{{ $data->kejuruan}}</b></h5>
        <br>
        <h4>Sub-kejuruan :</h4>
        <h5><b>{{ $data->subkejuruan}}</b></h5>
        <br>
        <h4>Periode Pelatihan :</h4>
        <h5><b>{{ tgl_indo($tgl_mulai) }}</b> s.d <b>{{ tgl_indo($tgl_selesai) }}</b></h5>
        <br>
        <h4>Alamat Seleksi :</h4>
        <h5><b>{{ $data->lokasi}}</b></h5>
    </center>

</div>

@endsection
