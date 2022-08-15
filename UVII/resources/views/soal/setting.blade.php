@extends('layouts.index')

@section('title')
    Setting
@endsection

@section('contents')
<form method="POST" action="{{route('soal.setting.save')}}">
  @csrf
  <div class="card-page">
    <div class="card-header">
      <p>Setting Soal</p>
    </div>
    
    <div class="card-body">
      <div class="body-content">
 
        <div class="form-group">
          <!-- <div class='row'> -->
            <div class='row col-md-12'>
              <label for="setting">Waktu (Menit):</label>
              <input type="hidden" name='key[]' value="durasi">
              <input type="time" class='form-control' name='value[]' placeholder="dalam menit">
              <!-- <label for="setting">Detik:</label>
              <input type="hidden" name='key[]' value="durasi">
              <input type="text" name='value[]' placeholder="dalam menit"> -->
              
            </div>
        </div>
        <div class='form-group'>
          <div class="row col-md-12">
              <label for="setting">Jumlah soal yang akan ditampilkan :</label>
              <input type="hidden" name='key[]' value="jmlSoal">
              <input type="number" class='form-control' name='value[]' min=0>
          </div>
        </div>
        
        <div class='form-group'>
          <!-- <div class="row"> -->
            <div class="row col-md-12">    
                <label for="setting">Soal per halaman :</label>
                <input type="hidden" name='key[]' value="soal_perHalaman">
                <input type="number" class='form-control' name='value[]' min=0>
            </div>
          <!-- </div> -->
        </div>
      </div>

      <div class="body-btn">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</form>
@endsection