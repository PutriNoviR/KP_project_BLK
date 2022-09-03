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
            <a href="{{route('riwayat_tes_global.user')}}">Validate Peserta</a>
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
            <th></th>

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
                    <button class='btn btn-primary btn-validate' value='{{$data->nama_depan}}'> validate</button>
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

<!-- modal tampil foto:start -->
    <div id='modalValidate' class="modal" tabindex="-1" role="basic">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style="text-align: center;">
                    <div id='imgAwal' style="width: 60px; height: 60px; margin: auto;">
                        <img  src="" alt="">
                    </div>
                    <div id='imgAkhir' style="width: 60px; height: 60px; margin: auto;">
                        <img id='imgAkhir' src="" alt="">
                    </div>
                </div>
                <div style="border-top: none; text-align: center;" class="modal-footer">
                    <button type="button" class="btn btn-secondary mdl-close" data-bs-dismiss="modal">Close</button>
                    <button type='button' class="btn btn-primary" id='btn-validate'>Validate</button>
                </div>
            </div>
        </div>
    </div>
<!-- modal tampil foto:end -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $('.btn-validate').on('click', function(){
        let nama = $(this).val();
        $('#imgAwal').html(`<img  src="{{asset('camera/awal/`+nama+`.png')}}" alt="">`);
        $('#imgAkhir').html(`<img  src="{{asset('camera/akhir/`+nama+`.png')}}" alt="">`);
        // $('#imgAkhir').attr('src',"{{asset('camera/akhir"+nama+".png')}}");
        $('#modalValidate').modal('toggle');
    })
</script>

@endsection
