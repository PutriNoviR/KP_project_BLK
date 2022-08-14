@extends('layouts.index')

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
            <a href="http://127.0.0.1:8000/">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>

        <li>
            <a href="http://127.0.0.1:8000/soal">Soal</a>
            <i class="fa fa-angle-right"></i>
        </li> 

        <li>
            <a href="http://127.0.0.1:8000/soal/create">Tambah Soal</a>
            <i class="fa fa-angle-right"></i>
        </li> 
    </ul>
@endsection

@section('contents')
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
      <div class="col-md-4">
        <label for="kejuruan">Kejuruan</label>
      </div>
    </div>

    @for($i = 0; $i<=4; $i++)
      <div class='row'>
        <div class='col-md-8'>
          <input type="text" class="form-control" id="jawaban" name="jawaban[{{ $i }}]" placeholder="Masukkan Pilihan {{ ($i+1) }}" required>
        </div>
        <div class="col-md-4">
          <select class="form-control" name="kejuruan[{{ $i }}]" required>
          {{-- Belum fix. Tinggal di looping lagi sesuai table kejuruans --}}
            <option value="">-Pilih Kejuruan-</option>
            <option value=1>Kejuruan 1</option>
            <option value=2>Kejuruan 2</option>
            <option value=3>Kejuruan 3</option>
            <option value=4>Kejuruan 4</option>
            <option value=5>Kejuruan 5</option>
          </select>
        </div>
      </div><br>
    @endfor
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection