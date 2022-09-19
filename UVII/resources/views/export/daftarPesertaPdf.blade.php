<div class="portlet">
    <h1>DAFTAR PESERTA</h1>

    <div class="portlet-title">
        <b>Jumlah Peserta: {{ $user->count() }}</b><br><br>
        <b>Jumlah Peserta yang Tes: {{ $totalPeserta }}</b><br><br>
    </div>

    <div class="portlet-body">
        <div class="row">
            <table id='sample_1' class="table table-striped table-bordered table-hover dataTable no-footer display responsive" style="border-collapse: collapse; width:100%;">
                <thead>
                    <tr>
                        <th style="width: 5%; text-align: left;">No</th>
                        <th style="width: 35%; text-align: center;">Peserta</th>
                        <!-- <th style="width: 15%; text-align: center;">Email</th> -->
                        <th style="width: 25%; text-align: left;">Pendidikan dan Konsentrasi/Keahlian</th>
                        <th style="width: 20%; text-align: left;">Kota dan Tanggal Lahir</th>
                        <th style="width: 15%; text-align: left;">Kota Domisili</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp

                    @foreach($user as $u)
             
                    <tr style="border-top: 1px solid rgba(0, 0, 0, 0.3)">
                        <td data-th="No">
                            {{$no}}
                        </td>

                        <td data-th="Peserta">
                            <div class="row">
                                <div class="col-sm-6 hidden-xs"><br>       
                                    {{$u->nama_depan}} {{$u->nama_belakang}}
                                </div>
                                <div class="col-sm-6 hidden-xs">
                                    <small>Email: {{$u->email}}</small><br><br>
                                    <small>Telepon: {{$u->nomer_hp ?? '-'}}</small><br><br>
                                    <small>Alamat: {{$u->alamat ?? '-'}}</small>
                                </div>
                            </div>
                        </td>

                        <td data-th="Pendidikan dan Konsentrasi/Keahlian">
                          
                            <div class="row">
                                <div class="col-sm-6 hidden-xs">
                                    <small>Pendidikan: {{$u->pendidikan_terakhir}}</small><br><br>
                                </div>
                                <div class="col-sm-6 hidden-xs">
                                    <small>Konsentrasi/Keahlian: {{$u->konsentrasi_pendidikan}}</small>
                                </div>
                            </div>
                        </td>
                        
                        <td data-th="Kota dan Tanggal Lahir">
                            <div class="row">
                                <div class="col-sm-6 hidden-xs">
                                    {{$u->tempat_lahir ?? '-'}}
                                    @php
                                        if($u->tempat_lahir != null){
                                            echo ', ';
                                        }
                                    @endphp
                                </div>
                                <div class="col-sm-6 hidden-xs">
                                    @php
                                       
                                        echo date('d-m-Y', strtotime($u->tanggal_lahir));
                                    
                                    @endphp
                                </div>
                            </div>
                        </td>
                        
                        <td data-th="Kota Domisili">
                            {{$u->kota}}
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
