@extends('layouts.index',['menu' => $menu_role])

@section('title')
    Menu Soal
@endsection

@section('javascript')

<script>
    //$('#myTable').DataTable();

  function getEditForm(id){
    $.ajax({
      type:'POST',
      url:'{{ route("soal.edit")}}',
      data:{'_token':'<?php echo csrf_token() ?>',
            'id':id
          },
      success: function(data){
        // alert(data.msg);
        $('#modalContent').html(data.msg)
      }
    });
  }
  
  $('input[type=checkbox]').change(function(){
    //if(this.checked)
    // alert(this.value);
   // alert('dar');
    var old_id = $(this).attr('soal_id');
    var value = '0';

    if(this.checked){
      value ='1';
    }

    $.ajax({
      type:'POST',
      url:'{{ route("update.enable")}}',
      data:{'_token':'<?php echo csrf_token() ?>',
            'id':old_id,
            'value':value
          },
      success: function(data){
 
        if(value == 1){
          $(this).prop('checked', true);
        }
        else{
          $(this).prop('checked', false);
        }
      
      }
    });
  });

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
            <a href="{{route('soal.index')}}">Soal</a>
            <i class="fa fa-angle-right"></i>
        </li> 
    </ul>
@endsection



@section('contents')
<!-- List Soal, Tombol Tambah Soal dan Tombol Edit Soal sama lihat hasil tes -->
@if($message = Session::get('status'))
  <div class="alert alert-success">
    <li>{{$message}}</li>
  </div>
@endif

@if($message = Session::get('error'))
  <div class="alert alert-danger">
    <li>{{$message}}</li>
  </div>
@endif

<h4 class="text-center">List Soal</h4>

<a href="{{url('soal/create')}}" data-toggle='modal' class='btn btn-info'> Tambah Soal </a>
<a href="#modalImport" data-toggle='modal' class='btn btn-info'> Import Soal </a><br><br>


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
                      Pertanyaan
            </th>
            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                aria-label="Rendering engine: activate to sort column ascending" style="width: 129px;">
                      Soal Aktif
            </th>
            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                aria-label="Rendering engine: activate to sort column ascending" style="width: 129px;">
                      Detail
            </th>
            
            <th aria-controls="sample_1" tabindex="0" rowspan="1" colspan="1" style="width: 120px;">
                      Aksi
            </th>
            
          </tr>
        </thead>
        
        <tbody>
          @php 
            $no = 1;
          @endphp

          @foreach ($data as $key=>$item)
          {{-- <tr role="row" class="{{ ($key % 2 === 0) ? 'even' : 'odd' }}">--}}
          <tr role="row" class="{{ ($key % 2 === 0) ? 'active' : 'success' }}">
            <td class="">
                {{ $no }}
            </td>
            <td>

                {{ $item->pertanyaan }}
               
            </td>
            <td>
                {{--{{ $item->is_enable }}--}}
                {{--<input type='checkbox' name='is_enable' value='Tidak Aktif'/>--}}

                @if($item->is_enable == 0)
                  <input type='checkbox' name='is_enable' soal_id='{{$item->id}}'/>
                @elseif($item->is_enable == 1)
                  <input type='checkbox' name='is_enable' soal_id='{{$item->id}}' checked/>
                @endif
    
            </td>
            
            <td>
                  <a data-toggle='modal' data-target='#modal_{{$item->id}}' class="btn btn-default btn-xs btn-info"><i class="fa fa-eye"></i> View</a>
            </td>
            <td>
              {{-- Button Edit --}}
              <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-xs' onclick="getEditForm({{$item->id}})">
                  Edit
              </a>
              <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content" id='modalContent'></div>
                </div>
              </div> 

              

              {{-- Button Delete 2--}}
              <a class="btn btn-default btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal_{{$item->id}}">
                Delete
              </a>              
              <form method='POST' action="{{ url('soal/'.$item->id) }}">
                  @csrf
                  @method('DELETE')
                  <div id="deleteModal_{{$item->id}}" class="modal fade" tabindex="-1" role="basic">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-body" style="text-align: center;">
                                  <div style="width: 60px; height: 60px; margin: auto;">
                                      <i style="font-size: 46px; color: #8a6d3b; margin-top: 10px;" class="glyphicon glyphicon-warning-sign"></i>
                                  </div>
                                  <p>
                                      Apakah Anda yakin ingin menghapus soal no <b>{{$no}}</b>?
                                  </p>
                                  <input type="hidden" name="old_id" value="{{ $item->id }}">
                              </div>
                              <div style="border-top: none; text-align: center;" class="modal-footer">
                                  <button type="submit" class="btn btn-danger">Hapus</button>
                                  <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
                                  
                              </div>
                          </div>
                      </div>
                  </div>
              </form>
            </td>
          </tr>

          <div class="modal fade" id="modal_{{$item->id}}" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i style="font-size: 20px" class="fa fa-group"></i>Soal no {{$no}}</h4>  
                </div>

                <div class="modal-body">
                  <div class="form-group">
                    <label for="pertanyaan">Pertanyaan</label>
                    <textarea name="pertanyaan" class="form-control" disabled value='{{ $item->pertanyaan }}' rows="3" placeholder="Masukkan Pertanyaan" required>{{ $item->pertanyaan }}</textarea>
                  </div>
 
                  <div class="form-group">
                    <div class='row'>
                      <div class='col-md-8'>
                        <label for="jawaban">Jawaban</label>
                      </div>
                      <div class="col-md-4">
                        <label for="kejuruan">Klaster</label>
                      </div>
                    </div>

                    @php
                      $i = 0;
                    @endphp

                    @foreach($data2 as $d)
                    @if($d->question_id == $item->id)

                    <div class='row'>
                      <div class='col-md-8'>
                          <input type="text" class="form-control" disabled value='{{ $d->jawaban }}' id="jawaban" name="jawaban[{{ $i }}]" placeholder="Masukkan Pilihan {{ ($i+1) }}" required>
                      </div>
                      <div class="col-md-4">
                          <select class="form-control" name="kejuruan[{{ $i }}]" disabled required>
                       
                           @foreach($data3 as $e)
                              @if($e->id == $d->klaster_id)
                                <option value='{{ $d->klaster_id }}'>{{ $e->nama }}</option>
                              
                              @endif
                           @endforeach
                           
                            <!-- <option value=2 {{$d->kejuruans_id == 2? "selected":""}}>Kejuruan 2</option>
                            <option value=3 {{$d->kejuruans_id == 3? "selected":""}}>Kejuruan 3</option>
                            <option value=4 {{$d->kejuruans_id == 4? "selected":""}}>Kejuruan 4</option>
                            <option value=5 {{$d->kejuruans_id == 5? "selected":""}}>Kejuruan 5</option> -->
                          </select>
                      </div>
                    </div><br>
                    @php
                      $i++;
                    @endphp
                    @endif
                    @endforeach
                  </div>
                </div>
   
                <div style="border-top: none; text-align: center;" class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          @php
            $no++;
          @endphp

        @endforeach
      </tbody>
    </table>
    
  </div>
</div>
<a href="#modalSetting" data-toggle='modal' class='btn btn-info'> Setting Soal </a>

{{--<a href="#" class='btn btn-info'> view Soal </a><br><br>--}}


<div class="modal fade" id="modalSetting" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Setting Soal</h4>  
        </div>

        <form method="POST" action="{{route('soal.setting.save')}}">
          @csrf
            <div class="modal-body">
         
              <div class="form-group row">
              
                  <label for="setting" class="col-md-6">Waktu (Menit):</label>
                  <div class="col-md-4">
                    <input type="hidden" name='key[]' value="durasi">
                    <input type="time" class='form-control' name='value[]' placeholder="dalam menit" value="{{ $durasi }}">
                  </div>
                
              </div>
              <div class='form-group row'>
                <!-- <div class="row col-md-12"> -->
                    <label for="setting" class="col-md-6">Jumlah soal yang akan ditampilkan :</label>
                    <div class="col-md-4">
                      <input type="hidden" name='key[]' value="jmlSoal">
                      <input type="number" class='form-control' name='value[]' min=0 value="{{ $soal }}">
                    </div>
                <!-- </div> -->
              </div>
                  
              <div class='form-group row'>
                
                  <!-- <div class="row col-md-12">     -->
                      <label for="setting" class="col-md-6">Soal per halaman :</label>
                      <div class="col-md-4">
                        <input type="hidden" name='key[]' value="soal_perHalaman">
                        <input type="number" class='form-control' name='value[]' min=0 value="{{ $halaman }}">
                      </div>
                  <!-- </div> -->
              
              </div>
            </div>

            <div class="modal-footer" style="border-top: none; text-align: center;">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>
             
        </form>
        
      </div>
    </div>
  </div>
  {{-- Import--}}
<div class="modal fade" id="modalImport" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Import Soal</h4>  
        </div>
        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="form-control">
                <br>
                <p>Ketentuan:</p>
                <li>Data Pertanyaan Tidak Boleh sama</li>
                <li>Berikut adalah contoh format excel<a href="https://docs.google.com/spreadsheets/d/1r7dULIlybheTXoe-WzzEDqr5WUpCJ3diMcZ46fSgOuc/edit?usp=sharing"> contoh.xlsx</a></li>

            <button class="btn btn-success">Import Soal</button>
        </form>
</div>
</div>
</div>

@endsection
