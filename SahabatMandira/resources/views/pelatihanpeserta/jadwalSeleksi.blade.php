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
    <h2 class="m-0 text-dark">Jadwal dan Lokasi Seleksi</h2><br>
</div>

<div class="col-sm-6 mx-auto text-center">
    <div class="card card-success" id="print-area">
        <div class="card-header">
            <h3 class="mx-auto"><b>PENDAFTARAN BERHASIL</b></h3>
        </div>

        <div class="card-body">
            <h2>Jadwal Seleksi :</h2>
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

                $date = date('Y-m-d',strtotime($data->tanggal_seleksi));
                $time = date('H:i',strtotime($data->tanggal_seleksi));
            @endphp

            <h4><b>{{ tgl_indo($date) }}</b></h4>
            <h4><b>{{ $time.' WIB' }}</b></h4>
            
        </div>
        <div class="card-body">
            <h2>Alamat Seleksi :</h2>
            <h4><b>{{ $data->lokasi}}</b></h4>
        </div>
    </div>
    <div class="card-body">
        <button class="btn btn-info" onclick="printDiv('print-area');"><i class="fa fa-print"></i> CETAK</button>
    </div>
</div>

@endsection
