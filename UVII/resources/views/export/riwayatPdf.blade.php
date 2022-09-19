<div class="portlet">
    <h1>RIWAYAT TES PESERTA</h1>

    <div class="portlet-title">
        <b>Jumlah Peserta: {{ $totalPeserta }}</b><br><br>
    </div>

    <div class="portlet-body">
        <div class="row">
            <table id='sample_1' class="table table-striped table-bordered table-hover dataTable no-footer display responsive" style="border-collapse: collapse; width:100%;">
                <thead>
                    <tr>
                        <th style="width: 2%; text-align: left;">Kode</th>
                        <th style="width: 15%; text-align: left;">Peserta</th>
                        <!-- <th style="width: 15%;">Email</th> -->
                        <!-- <th>Pendidikan</th>
                        <th>Konsentrasi/Keahlian</th>
                        <th>Kota Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Kota Domisili</th> -->
                        <th style="width: 30%; text-align: left;">Tanggal Tes</th>
                        <!-- <th style="width: 30%;">Selesai Tes</th> -->
                        <th style="width: 30%; text-align: center;">Rekom Klaster</th>
                        <th style="width: 50%; text-align:left;">Rekom Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayat_tes as $riwayat)
                    <tr style="border-top: 1px solid rgba(0, 0, 0, 0.3)">
                        <td data-th="Kode">
                            {{$riwayat->id}}
                        </td>

                        @foreach($user as $u)
                            @if($riwayat->users_email == $u->email)
                                <td data-th="Peserta">
                                    <div class="row">
                                        <div class="col-sm-6 hidden-xs">
                                            
                                            {{$u->nama_depan}} {{$u->nama_belakang}}
                                           
                                        </div>
                                        
                                        <div class="col-sm-6 hidden-xs">
                                           
                                            <small>Email: {{$u->email}}</small>
                                            
                                        </div>
                                    </div>
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

                        <td data-th="Tanggal Tes"> 
                            <div class="row">
                                <div class="col-sm-6 hidden-xs">
                                   <small>Mulai: {{$riwayat->tanggal_mulai}}</small>
                                </div><br>
                                <div class="col-sm-6">
                                    <small>Selesai: {{$riwayat->tanggal_selesai ?? '-'}}</small>
                                </div>
                            </div>
                        </td>
   
                        <td data-th="Rekom Klaster" style="text-align: center;">
                            @foreach($dataKlaster as $d)
                                @if($riwayat->klaster_id == $d->id)
                                    {{ $d->nama }}
                                @endif
                            @endforeach
                        </td>
                        
                        <td data-th="Rekom Kategori">
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
                
                        <td class="actions" data-th="">
                        </td>
                    </tr><br>
                    @endforeach
                </tbody>

                <strong>Jumlah Keseluruhan Data: {{$riwayat_tes->count()}}</strong>
               
            </table>
        </div>
    </div>
</div>
