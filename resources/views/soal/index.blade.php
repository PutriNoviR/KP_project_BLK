@extends('layouts.index')

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
</script>

@endsection

@section('page-bar')
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="http://127.0.0.1:8000/">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>

        <li>
            <a href="http://127.0.0.1:8000/soal">Soal</a>
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

<h4 class="text-center">List Soal</h4>

<a href="{{url('soal/create')}}" data-toggle='modal' class='btn btn-info'> Tambah Soal </a><br><br>

<div class="table-responsive">
    <table id="myTable" class="table">
      <thead>
          <tr>
              <th> ID </th>
              <th> Pertanyaan </th> 
              <th> Aksi </th>  
          </tr>
      </thead>
      <tbody>
          @foreach ($data as $key=>$item)
          <tr class="{{ ($key % 2 === 0) ? 'active' : 'success' }}">
            <td>{{ $item->id }}</td>
            
            <td>{{ $item->pertanyaan}}</td>
            
            {{-- <td>
                 <a class='btn btn-xs btn-info' data-toggle='modal' data-target='#myModal' onclick='showProducts({{ $item->id }})'>Show Pertanyaan</a>
              <ul>
                @foreach($item->jawaban as $value )
                  <li>{{ $value->jawaban }}</li>
                @endforeach
              </ul>
            </td>--}}
          
          <td>
            <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-xs' onclick="getEditForm({{$item->id}})">
              Edit
            </a>
            <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content" id='modalContent'></div>
              </div>
            </div> 

            {{-- Button Delete 1--}}
            <form method='POST' action="{{ url('soal/'.$item->id) }}">
              @csrf
              @method('DELETE')
              <input type="hidden" name="old_id" value="{{ $item->id }}">
              <input type="submit" value="delete" class='btn btn-danger btn-xs' onclick="if(!confirm('are you sure to delete this record ?')) return false;">
            </form>

            <a class="btn btn-default btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal_{{$item->id}}">
              Hapus
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
                                    Apakah Anda yakin ingin menghapus soal no <b>{{$item->id}}</b>?
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
        @endforeach
      </tbody>
  </table>
</div>

@endsection
<!-- <form method="POST" action="{{route('soal.store')}}">
    @csrf
  <div class="form-group">
    <label for="pertanyaan">Pertanyaan</label>
    <input type="text" class="form-control" id="pertanyaan" placeholder="Pertanyaan">
  </div>
  <div class="form-group">
    <label for="jawaban">Jawaban</label>
    <input type="text" class="form-control" id="jawaban" placeholder="Jawaban">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form> -->
