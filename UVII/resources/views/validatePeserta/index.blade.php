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
            <a href="{{route('admin.validate')}}">Validate Peserta</a>
            <i class="fa fa-angle-right"></i>
        </li>
    </ul>
@endsection
@section('contents')
<h4 class="text-center">Validasi Tes Semua Peserta</h4>
<div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="setting" <?php if($settingValidasi[0]->value == 1){ echo"checked "; } echo"value='".$settingValidasi[0]->value."'";?>>
        <label class="form-check-label" for="flexSwitchCheckDefault">Validasi Foto Peserta</label>
    </div>
</div>
<div class="portlet">
  <div class="portlet-body">
    <table class="table table-striped table-bordered table-hover dataTable no-footer display responsive" id="sample_1" role="grid" aria-describedby="sample_1_info" style="width:100%">
        <thead>
          <tr role="row">
            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1"
                aria-label="Rendering engine: activate to sort column ascending" width="5%">
                      No
            </th>
            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1"
              aria-label="Browser: activate to sort column ascending" width="10%">
                      Peserta
            </th>
            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1"
              aria-label="Browser: activate to sort column ascending">
                      Mulai Tes
            </th>
            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1"
                aria-label="Rendering engine: activate to sort column ascending">
                      Selesai Tes
            </th>
            <th></th>

          </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
           {{-- @foreach($riwayat_tes as $key=>$data) --}}
           @foreach($data_akhir as $key=>$data)
            <tr role="row" class="{{ ($key % 2 === 0) ? 'active' : 'success' }}">
                <td class="">
                   
                    {{ $no }}
                </td>
                <td>
                    {{ $data['users_email'] }}
                </td>
                <td>
                    {{ $data['tanggal_mulai'] }}
                </td>
                <td>
                    {{ $data['tanggal_selesai'] }}
                </td>
                <td>
                    @if($data['is_validate'] == 2)
                    <button type='button' class='btn btn-error'>Tidak valid</button>
                    @elseif($data['is_validate'] == 1)
                    <button type='button' class='btn btn-success'>Valid</button>
                    @else
                    <button class='btn btn-primary btn-validate' usrId='{{$data["id"] }}' value='{{$data["nama_depan"]}} {{$data["nama_belakang"]}}'> validate</button>
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

<!-- modal tampil foto:start -->
    <div id='modalValidate' class="modal" tabindex="-1" role="basic">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style="text-align: center;">
                    <div class='container'>
                        <div class='row align-items-start'>
                            <div class='col'>
                                <div id='imgAwal' style="width: 30%; height: 30%; ">
                                </div>
                                <p>Awal</p>
                            </div>
                            <div class='col'>
                                <div id='imgAkhir' style="width: 30%; height: 30%;">
                                </div>
                                <p>Akhir</p>
                            </div>
                        </div>
                    </div>
                    <!-- <div id='imgAwal' style="width: 60px; height: 60px; margin: auto;">
                        <img  src="" alt="">
                    </div>
                    <div id='imgAkhir' style="width: 60px; height: 60px; margin: auto;">
                        <img id='imgAkhir' src="" alt="">
                    </div> -->
                </div>
                <div style="border-top: none; text-align: center;" class="modal-footer">
                    <button type="button" class="btn btn-secondary mdl-close" id='btn-close' data-bs-dismiss="modal">Close</button>
                    <button type='button' class="btn btn-primary btn-validasi" usrId='' value='1' >Valid</button>
                    <button type='button' class="btn btn-error btn-validasi" usrId='' value='2' >Tidak valid</button>
                </div>
            </div>
        </div>
    </div>
<!-- modal tampil foto:end -->

<!-- modal info:start -->
<div id='modalSetting' class="modal" tabindex="-1" role="basic">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style="text-align: center;">
                    <div>
                        <p>apakah kamu yakin untuk <span id='setting-mode'></span> validasi peserta?</p>
                    </div>
                </div>
                <div style="border-top: none; text-align: center;" class="modal-footer">
                    <button type='button' class="btn btn-primary" value="" id='btn-ubah'>Save</button>
                    <button type="button" class="btn btn-secondary mdl-close" data-bs-dismiss="modal" id='btn-close'>Close</button>
                </div>
            </div>
        </div>
    </div>
<!-- modal info:end -->

<!-- modal info:start -->
<div id='modalInfo' class="modal" tabindex="-1" role="basic">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style="text-align: center;">
                    <div id='info'>

                    </div>
                </div>
                <div style="border-top: none; text-align: center;" class="modal-footer">
                    <button type="button" class="btn btn-secondary mdl-close" val='' id='btn-close-info' data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<!-- modal info:end -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $('.btn-validate').on('click', function(){
        let nama = $(this).val();
        let id = $(this).attr('usrId');
        $('#imgAwal').html(`<img  src="{{asset('camera/awal/`+nama+`.png')}}" alt="">`);
        $('#imgAkhir').html(`<img  src="{{asset('camera/akhir/`+nama+`.png')}}" alt="">`);
        $('.btn-validasi').attr('usrId',id);
        // $('#imgAkhir').attr('src',"{{asset('camera/akhir"+nama+".png')}}");
        $('#modalValidate').show();
    })
    $('.btn-validasi').on('click',function(){
        let id = $(this).attr('usrId');
        let val = $(this).val();
        $.ajax({
            type:'POST',
            url:'{{route("validatePeserta")}}',
            data:{
                '_token': '<?php echo csrf_token() ?>',
                'id': id,
                'val':val
            },
            success:function(data){
                $('#modalValidate').hide();
                $('#info').html(data.info);
                $('#btn-close-info').val(data.resCode);
                $('#modalInfo').show();
            }
        });
    })

    $('#btn-close').on('click', function(){
        $('#modalValidate').hide();
    });

    $('#btn-close-info').on('click',function(){
        let respond = $(this).val();
        if(respond == '200'){
            location.reload();
        }
    })

    $('#setting').on('click',function(){
        let val = $(this).val();
        let pesan = 'mematikan';
        if(val == 0){
            pesan = 'menghidupkan'
        }
        $('#setting-mode').text(pesan)
        $('#btn-ubah').val(val)
        $('#modalSetting').modal('toggle');
    })

    $('#btn-ubah').on('click',function(){
        let val = $(this).val();
        $.ajax({
            type:'POST',
            url:'{{route("validateSetting")}}',
            data:{
                '_token': '<?php echo csrf_token() ?>',
                'val':val
            },
            success:function(data){
                $('#modalSetting').modal('hide');
                console.log(data.info)
                $('#info').html(data.info);
                $('#btn-close-info').val(data.resCode);
                $('#modalInfo').modal('toggle');
            }
        });
    })
</script>

@endsection
