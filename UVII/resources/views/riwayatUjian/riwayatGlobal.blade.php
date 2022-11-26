@extends('layouts.index',['menu' => $menu_role])

@section('title')
    Riwayat Tes
@endsection
@section('javascript')

<script>
    //$('#myTable').DataTable();

  function getRiwayat(){
    var data= $('#btnData').html();

    if(data=='Data Valid'){
        
        $('#btnData').attr('href','{{route("riwayat_tes_global.user")}}');
                
    }else{
        
        $('#btnData').attr('href','{{route("dat.rill")}}');
        
    }
        
  }
 

</script>

@endsection

@section('page-bar')
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{route('home')}}">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('riwayat_tes_global.user')}}">Riwayat Tes Global</a>
            <i class="fa fa-angle-right"></i>
        </li>
    </ul>
@endsection
@section('contents')
<h4 class="text-center">Riwayat Tes Semua Peserta</h4>

<a href="{{route('export')}}" class='btn btn-xs btn-success'><i class="fa fa-print"></i> Export to Excel</a>
{{--<a href="{{route('riwayat_tes_global.cetak')}}" class='btn btn-xs btn-danger'><i class="fa fa-print"></i> Export to PDF</a><br><br>--}}
<a href="{{route('export.cetakRiwayatPeserta')}}" target=_blank class='btn btn-xs btn-danger'><i class="fa fa-print"></i> Export to PDF</a><br><br>
<a href="{{route('dat.rill')}}" id='btnData' class='btn btn-xs btn-success' onclick="getRiwayat()">{{$dataRill}}</a>


<div class="portlet">
  <div class="portlet-body">
    <table class="table table-striped table-bordered table-hover dataTable no-footer display responsive" id="sample_1" role="grid" aria-describedby="sample_1_info" style="width:100%">
        <thead>
          <tr role="row">
            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                aria-label="Rendering engine: activate to sort column ascending">
                      No
            </th>
            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
              aria-label="Browser: activate to sort column ascending">
                      Email
            </th>
            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
              aria-label="Browser: activate to sort column ascending">
                      Nama Lengkap
            </th> 
            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
              aria-label="Browser: activate to sort column ascending">
                      Usia
            </th>
            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
              aria-label="Browser: activate to sort column ascending" style="width: 15%;">
                      Mulai Tes
            </th>
            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                aria-label="Rendering engine: activate to sort column ascending" style="width: 15%;">
                      Selesai Tes
            </th>
            
            <th aria-controls="sample_1" tabindex="0" rowspan="1" colspan="1">
                      Rekomendasi Klaster Terakhir
            </th>
            <th aria-controls="sample_1" tabindex="0" rowspan="1" colspan="1">
                      Rekomendasi Kategori Terakhir
            </th>
            <th aria-controls="sample_1" tabindex="0" rowspan="1" colspan="1">Detail Tes</th>
          </tr>
        </thead>
        <tbody>
          
            @foreach($hasil_final as $key=>$data)
            <tr role="row" class="{{ ($key % 2 === 0) ? 'active' : 'success' }}">
                <td class="">
                    {{ $data['no'] }}
                </td>
                <td>
                    {{$data['email'] }}
                </td>
                <td>
                    {{$data['nama'] }}
                </td>
                <td>
                    {{$data['usia'] }}
                </td>
                <td>
                    {{$data['mulai test'] }}
                </td>
                <td>
                    {{$data['selesai test'] }}
                </td>
                <td>
                 
                    {{ $data['rekomendasi klaster'] }}
                   
                </td>
                <td>
                    {{ $data['rekomendasi kategori'] }}
                </td>
                <td>
                    @php 
                        $id = $data['id tes'];
                        $email = $data['email'];
                    @endphp
                    <a href='{{ route("review_soal",["idsesi"=>$id,"email"=>$email]) }}' class='btn btn-xs btn-info'>Review Attempt</a>
                </td>
            </tr>
          
            @endforeach


        </tbody>
    </table>
 </div>
</div>

@endsection