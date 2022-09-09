@extends('layouts.index',['menu' => $menu_role])

@section('title')
    Riwayat Tes
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

<div class="portlet">
  <div class="portlet-body">
  <table class="table table-striped table-bordered table-hover dataTable no-footer" id="sample_1" role="grid" aria-describedby="sample_1_info">
        <thead>
          <tr role="row">
            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                aria-label="Rendering engine: activate to sort column ascending" style="width: 129px;">
                      No
            </th>
            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
              aria-label="Browser: activate to sort column ascending" style="width: 250px;">
                      Peserta
            </th>
            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
              aria-label="Browser: activate to sort column ascending" style="width: 250px;">
                      Mulai Tes
            </th>
            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                aria-label="Rendering engine: activate to sort column ascending" style="width: 129px;">
                      Selesai Tes
            </th>
            
            <th aria-controls="sample_1" tabindex="0" rowspan="1" colspan="1" style="width: 120px;">
                      Rekomendasi Klaster
            </th>
            <th aria-controls="sample_1" tabindex="0" rowspan="1" colspan="1" style="width: 120px;">
                      Rekomendasi Kategori
            </th>
            
          </tr>
        </thead>
        <tbody>
            @php 
                $no = 1;
            @endphp
            @foreach($riwayat_tes as $key=>$data)
            <tr role="row" class="{{ ($key % 2 === 0) ? 'active' : 'success' }}">
                <td class="">
                    {{ $no }}
                </td>
                <td>
                    {{$data->users_email }}
                </td>
                <td>
                    {{$data->tanggal_mulai }}
                </td>
                <td>
                    {{$data->tanggal_selesai }}
                </td>
                <td>
                  {{--  {{$data->rekomendasi_klaster }} --}}
                 {{-- {{$data->klaster->nama}} --}}

                  @foreach($dataKlaster as $d)
                        @if($data->klaster_id == $d->id)
                            {{ $d->nama }}
                        @endif
                    @endforeach
                </td>
                <td>
               {{--     @foreach($data->find($data->id)->hasilRekomAkhir as $d)
                        {{$d->kode}}

                        @if(!$loop->last)
                            ,
                        @endif
                        
                    @endforeach  --}}
                    
                    @if($dataKategori[$data->id] != null)
                        @foreach($dataKategori[$data->id] as $d)
                       
                            {{ $d }}
                            @if(!$loop->last)
                                ,
                            @endif
                       
                        @endforeach
                    @else
                        Belum tes
                    @endif
                </td>
            </tr>
            @php
                $no++;
            @endphp
            @endforeach


        </tbody>
    </table>
 </div>
</div>

@endsection