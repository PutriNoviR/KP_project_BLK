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
            <a href="{{route('riwayat_tes.user')}}">Riwayat Tes</a>
            <i class="fa fa-angle-right"></i>
        </li>
    </ul>
@endsection
@section('contents')
<h4 class="text-center">Riwayat Tes</h4>

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
              aria-label="Browser: activate to sort column ascending" style="width: 15%;">
                      Mulai Tes
            </th>
            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1"
                aria-label="Rendering engine: activate to sort column ascending" style="width: 15%;">
                      Selesai Tes
            </th>

            <th aria-controls="sample_1" tabindex="0" rowspan="1" colspan="1">
                      Rekomendasi Klaster
            </th>
            <th aria-controls="sample_1" tabindex="0" rowspan="1" colspan="1">
                      Rekomendasi Kategori
            </th>
            <th aria-controls="sample_1" tabindex="0" rowspan="1" colspan="1">Detail Tes</th>

          </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach($daftarRiwayat as $key=>$data)

            <tr role="row" class="{{ ($key % 2 === 0) ? 'active' : 'success' }}">
                <td class="">
                    {{ $no }}
                </td>


                    <td>
                        {{$data->tanggal_mulai }}
                    </td>
                    <td>
                        {{$data->tanggal_selesai }}
                    </td>
                @if($settingValidasi[0]->value == 1)
                    @if($data->is_validate == 0)
                        <td >Mohon diitunggu sampai admin memvalidasi tes kamu</td>
                        <td></td>
                    @elseif($data->is_validate == 2)
                        <td >Maaf tes kamu tidak valid</td>
                        <td></td>
                    @endif
                @endif
                @if($settingValidasi[0]->value == 0 || $data->is_validate == 1)
                    <td>
                        {{-- {{$data->klaster->nama }} --}}
                        @foreach($dataKlaster as $d)
                            @if($data->klaster_id == $d->id)
                                {{ $d->nama }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                    {{--    @foreach($data->find($data->id)->hasilRekomAkhir as $d)
                            {{$d->nama}}

                            @if(!$loop->last)
                                ,
                            @endif
                        @endforeach     --}}

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
                    <td>
                    <a href='{{ route("review_soal",["idsesi"=>$data->id,"email"=>$data->users_email]) }}' class='btn btn-xs btn-info'>Review Attempt</a>
                </td>
                @endif
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
