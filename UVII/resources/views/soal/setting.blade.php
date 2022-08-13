@extends('layouts.index')

@section('title')
    Setting
@endsection

@section('contents')
<form method="POST" action="{{route('soal.setting')}}">
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
        <label for="setting">Waktu:</label>
        <input type="text" name="menit" placeholder="dalam menit"/>
        
      </div>
    </div><br>
    <div class='row'>
    <div class="col-md-6">
        <label for="setting">Jumlah soal yang akan ditampilkan :</label>
        <input type="text" name="jmlSoal" placeholder="jumlah soal"/>
      </div>
    </div><br>
    <div class='row'>
    <div class="col-md-6">
        <label for="setting">Soal per halaman :</label>
        <input type="text" name="perHalaman" placeholder="soal per halaman"/>
      </div>
    </div>
  </div>
 
  <button type="submit" class="btn btn-primary">Simpan</button>
</div>
</div>
</div>
</form>
@endsection