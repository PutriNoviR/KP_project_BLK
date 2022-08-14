@extends('layouts.index')

@section('title')
    Setting
@endsection

@section('contents')
<form method="POST" action="{{route('soal.setting.save')}}">
  @csrf
  <div class="card-page">
    <div class="card-header">
    <h3 for="setting"><b>Setting Soal</b></h3>
    </div>
  <div class="card-body">
  <div class="body-content">
 
  <div class="form-group">
    <div class='row'>
      <div class='col-md-8'>
        <label for="setting">Menit:</label>
        <input type="hidden" name='key[]' value="durasi">
        <input type="time" name='value[]' placeholder="dalam menit">
        <!-- <label for="setting">Detik:</label>
        <input type="hidden" name='key[]' value="durasi">
        <input type="text" name='value[]' placeholder="dalam menit"> -->
        
      </div>
    </div><br>
    <div class='row'>
    <div class="col-md-6">
        <label for="setting">Jumlah soal yang akan ditampilkan :</label>
        <input type="hidden" name='key[]' value="jmlSoal">
        <input type="number" name='value[]' min=0>
      </div>
    </div><br>
    <div class='row'>
    <div class="col-md-6">
        <label for="setting">Soal per halaman :</label>
        <input type="hidden" name='key[]' value="soal_perHalaman">
        <input type="number" name='value[]' min=0>
      </div>
    </div>
  </div>
 
  <button type="submit" class="btn btn-primary">Simpan</button>
</div>
</div>
</div>
</form>
@endsection