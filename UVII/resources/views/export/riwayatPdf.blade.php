<div class="portlet">
    <h1>RIWAYAT TES PESERTA</h1>

    <div class="portlet-title">
        <b>Jumlah Peserta: {{ $totalPeserta }}</b><br><br>
        <strong>Jumlah Keseluruhan Data: {{$riwayat_tes->count()}}</strong><br><br>
    </div>

    <div class="portlet-body">
        <div class="row">
            <table id='sample_1' class="table table-striped table-bordered table-hover dataTable no-footer display responsive" style="border-collapse: collapse; width:100%;">
                <thead>
                    <tr>
                        <th style="text-align: center;">Kode</th>
                        <th style="text-align: center;">Nama Lengkap</th>
                        <th style="text-align: center;">Email</th>
                        <!-- <th>Pendidikan</th>
                        <th>Konsentrasi/Keahlian</th>
                        <th>Kota Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Kota Domisili</th> -->
                        <th style="text-align: center;">Mulai Tes</th>
                        <th style="text-align: center;">Selesai Tes</th>
                        <th style="text-align: center;">Rekom Klaster</th>
                        <th style="text-align:left;">Rekom Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp

                    @foreach($riwayat_tes as $riwayat)
                    <tr>
                        <td data-th="Kode" style="text-align: center; margin: 0 auto;">
                            {{$no}}
                        </td>

                        @foreach($user as $u)
                            @if($riwayat->users_email == $u->email)
                                <td data-th="Nama Lengkap">
                                    <!-- <div class="row"> -->
                                        <!-- <div class="col-sm-6 hidden-xs"> -->
                                            
                                            {{$u->nama_depan}} {{$u->nama_belakang}}
                                           
                                        <!-- </div> -->
                                        
                                        <!-- <div class="col-sm-6 hidden-xs"> -->
                                </td>
                                <td data-th="Email" style="text-align:center">           
                                            <small>{{$u->email}}</small>
                                            
                                        <!-- </div> -->
                                    <!-- </div> -->
                                </td>

                                {{-- <td data-th="Pendidikan">
                                    {{$u->pendidikan_terakhir}}
                                </td>
                               
                                <td data-th="Konsentrasi/Keahlian">
                                    {{$u->konsentrasi_pendidikan}}
                                </td>
                                
                                <td data-th="Kota Lahir">
                                    {{$u->tempat_lahir}}
                                </td>
                                
                                <td data-th="Tanggal Lahir">
                                    {{$u->tanggal_lahir}}
                                </td>
                                
                                <td data-th="Kota Domisili">
                                    {{$u->kota}}
                                </td> --}}
                            @endif

                        @endforeach

                        <td data-th="Mulai Tes"> 
                            <!-- <div class="row"> -->
                                <!-- <div class="col-sm-6 hidden-xs"> -->
                                   <small>{{$riwayat->tanggal_mulai}}</small>
                        </td>
                        <td data-th="Selesai Tes">
                                <!-- </div><br> -->
                                <!-- <div class="col-sm-6"> -->
                                    <small>{{$riwayat->tanggal_selesai ?? '-'}}</small>
                                <!-- </div> -->
                            <!-- </div> -->
                        </td>
   
                        <td data-th="Rekom Klaster" style="text-align: center;">
                            @foreach($dataKlaster as $d)
                                @if($riwayat->klaster_id == $d->id)
                                   {{ $d->nama }}
                                @endif
                            @endforeach
                        </td>
                        
                        <td data-th="Rekom Kategori" style="text-align: center;">
                            @if($dataKategori[$riwayat->id] != null)
                                @foreach($dataKategori[$riwayat->id] as $d)
                                
                                    {{ $d }}
                                
                                    @if(!$loop->last)
                                        ,
                                    @endif
                                
                                @endforeach
                            @else
                                Belum tes
                            @endif
                        </td>
                        @php
                            $no++;
                        @endphp
                    </tr><br>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
