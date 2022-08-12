@extends('layouts.index')

@section('title')
    Setting
@endsection

@section('contents')
<form method="POST" action="{{route('soal.setting.save')}}">
  @csrf
    
    <h3 for="setting">Setting</h3>
 
  <div class="form-group">
    <div class='row'>
      <div class='col-md-8'>
        <label for="setting">menit</label>
        <input type="text" name="menit"/>
      </div>
      {{-- <div class='col-md-8'> --}}
       {{-- <label for="setting">detik</label> --}}
     {{--  <input type="text" name="detik"/>--}}
        {{--</div>--}
   
      <div class="col-md-4">
        <label for="setting">Soal per halaman :</label>
        <input type="text" name="perHalaman"/>
      </div>
    </div>
  </div>
 
  <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection