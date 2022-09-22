<div class="portlet">
    <h1>DAFTAR PESERTA</h1>

    <div class="portlet-title">
        <b>Jumlah Peserta: {{ count($user) }}</b><br><br>
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
                        <th style="width: 28%; text-align: left;">Pendidikan dan Konsentrasi/Keahlian</th>
                        <th style="width: 18%; text-align: center;">Kota Domisili</th>
                        <th style="width: 25%; text-align: center;">Hasil Klaster</th>
                        <th style="width: 28%; text-align: center;">Hasil Kategori</th>
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
                                    {{$u['nama_depan']}} {{$u['nama_belakang']}}
                                </div>
                                <div class="col-sm-6 hidden-xs">
                                    <small>Email: {{$u['email']}}</small><br><br>
                                    <small>Telepon: {{$u['nomer_hp'] ?? '-'}}</small><br><br>
                                    <small>Alamat: {{$u['alamat'] ?? '-'}}</small><br><br>
                                    <small>Tempat Tanggal Lahir:<br>
                                        {{$u['tempat_lahir'] ?? '-'}}
                                        
                                        @php
                                            if($u['tempat_lahir'] != null){
                                                echo ', ';
                                            }

                                            echo date('d-m-Y', strtotime($u['tanggal_lahir']));
                                        @endphp
                               
                                    </small>
                                </div>
                            </div>
                        </td>

                        <td data-th="Pendidikan dan Konsentrasi/Keahlian">
                          
                            <div class="row">
                                <div class="col-sm-6 hidden-xs">
                                    <small>Pendidikan: {{$u['pendidikan']}}</small><br><br>
                                </div>
                                <div class="col-sm-6 hidden-xs">
                                    <small>Konsentrasi/Keahlian: {{$u['konsentrasi']}}</small>
                                </div>
                            </div>
                        </td>
                        
                        <td data-th="Kota Domisili" style="text-align: center;">
                            {{$u['kota']}}
                        </td>

                        <td data-th="Hasil Klaster" style="text-align: center;">
                            {{$u['klaster']}}
                        </td>

                        <td data-th="Hasil Kategori">
                            {{$u['kategori']}}
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
