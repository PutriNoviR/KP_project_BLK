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
                        <th style="width: 5%; text-align: center;">No</th>
                        <th style="width: 35%; text-align: center;">Peserta</th>
                        <th style="width: 20%; text-align: center;">Telepon</th>
                        <th style="width: 15%; text-align: center;">Tempat Tanggal Lahir</th>
                        <th style="width: 5%; text-align: center;">Usia</th>
                        <th style="width: 4%; text-align: center;">Pendidikan</th>
                        <th style="width: 5%; text-align: center;">Kota Domisili</th>
                        <th style="width: 25%; text-align: center;">Hasil</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp

                    @foreach($user as $u)
             
                    <tr style="border-top: 1px solid rgba(0, 0, 0, 0.3)">
                        <td data-th="No" style="text-align: center;">
                            {{$no}}
                        </td>

                        <td data-th="Peserta">
                            <div class="row">
                                <div class="col-sm-6 hidden-xs"><br>       
                                    {{$u['nama_depan']}} {{$u['nama_belakang']}}
                                </div>
                            </div>
                        </td>
                        <td data-th="Telepon" style="text-align: center;">
                            {{$u['No.Hp']}}
                        </td>

                        <td data-th='Tempat Tanggal Lahir' style="text-align: center;">
                            <small>
                                {{$u['tempat_lahir'] ?? '-'}}
                                        
                                @php
                                    if($u['tempat_lahir'] != null){
                                        echo ', ';
                                    }
                                    echo date('d-m-Y', strtotime($u['tanggal_lahir']));
                                @endphp  
                            </small>
                        </td>
                        <td data-th="Usia" style="text-align: center">
                            {{$u['usia']}}
                        </td>

                        <td data-th="Pendidikan" style="text-align: center">
                            {{$u['pendidikan']}} <br> ({{$u['konsentrasi'] ?? '-'}})
                        </td>
                     
                        <td data-th="Kota Domisili" style="text-align: center;">
                            {{$u['kota']}}
                        </td>
                        <td data-th="hasil" style="text-align: center;">
                           <p>Klaster: {{$u['klaster']}}</p><br>

                           <p>Kategori: {{$u['kategori']}}</p>
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
