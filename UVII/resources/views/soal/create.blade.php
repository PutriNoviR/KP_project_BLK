@extends('layouts.index',['menu' => $menu_role])

@section('title')
    Tambah Soal
@endsection

@section('javascript')
  <script>
    
    $('select').change(function(){
      var value_select = [];

      var value = $(this).val();

      $('select option[value="'+value+'"]').hide();
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

        <li>
            <a href="{{route('soal.create')}}">Tambah Soal</a>
            <i class="fa fa-angle-right"></i>
        </li> 
    </ul>
@endsection

@section('contents')
@if($message = Session::get('error'))
  <div class="alert alert-danger">
    <li>{{$message}}</li>
  </div>
@endif

<div class="card-kelengkapan">

    <div class="card-header">
        <p>Tambah Soal</p>
    </div>

    <div class="portlet-body form">
      <form method="POST" action="{{url('soal')}}">
        @csrf
        <div class="form-group">
          <label for="pertanyaan">Pertanyaan</label>
          <textarea name="pertanyaan" class="form-control" rows="3" placeholder="Masukkan Pertanyaan" required></textarea>
        </div>
      
        <div class="form-group">
          <div class='row'>
            <div class='col-md-8'>
              <label for="jawaban">Jawaban</label>
            </div>
            {{--<div class="col-md-4">
              <label for="kejuruan">Klaster</label>
            </div>--}}
          </div>
         
          @for($i = 0; $i<$jml_klaster; $i++)
            <div class='row'>
              <div class='col-md-8'>
                <input type="text" class="form-control" id="jawaban" name="jawaban[{{ $i }}]" placeholder="Masukkan Pilihan {{ ($i+1) }}" required>
              </div>
              <div class="col-md-4">
                <select class="form-control" name="kejuruan[{{ $i }}]" required>
                {{-- Tinggal di looping lagi sesuai table klaster --}}
                <option value="">-Pilih Klaster-</option>
                @foreach($namaKlaster as $data)
                  <option value='{{ $data->id }}'>{{$data->nama}}</option>
                @endforeach
                </select>
              </div>
            </div><br>
          @endfor
        
        </div>
      
        <div class="body-btn">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  
  </div>
@endsection