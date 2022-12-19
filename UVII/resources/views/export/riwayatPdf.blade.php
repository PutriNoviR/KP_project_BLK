<div class="portlet">
    <h1>RIWAYAT TES PESERTA</h1>

    <div class="portlet-title">
        <b>Jumlah Peserta: {{ $totalPeserta }}</b><br><br>
        <strong>Jumlah Keseluruhan Data: {{$data->count()}}</strong><br><br>
    </div>

    <div class="portlet-body">
        <div class="row">
            <table id='sample_1' class="table table-striped table-bordered table-hover dataTable no-footer display responsive" style="border-collapse: collapse; width:100%;">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">Nama Lengkap</th>
                        <th style="text-align: center;">Email</th>
                        <th style="text-align: center;">Mulai Tes</th>
                        <th style="text-align: center;">Selesai Tes</th>
                        <th style="text-align: center;">Rekom Klaster</th>
                        <th style="text-align:center;">Rekom Kategori</th>
                    </tr>
                </thead>
                <tbody>
                 
                    @foreach($data as $riwayat)
                    <tr>
                        <td data-th="Kode" style="text-align: center; margin: 0 auto;">
                            {{$riwayat['no']}}
                        </td>

                        <td data-th="Nama Lengkap">   
                            {{$riwayat['nama']}}
                        </td>
                        <td data-th="Email" style="text-align:center; width: 10%">           
                            <small>{{$riwayat['email']}}</small>
                            
                        </td>

                        <td data-th="Mulai Tes"> 
                            <small>{{$riwayat['mulai test']}}</small>
                        </td>
                        <td data-th="Selesai Tes">
                            <small>{{$riwayat['selesai test'] ?? 'Belum'}}</small>
                        </td>
   
                        <td data-th="Rekom Klaster" style="text-align: center;">
                            {{ $riwayat['rekomendasi klaster'] }}
                        </td>
                        
                        <td data-th="Rekom Kategori" style="text-align: center; width: 35%">
                            {{ $riwayat['rekomendasi kategori'] }}
                        </td>
                    
                    </tr><br>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
