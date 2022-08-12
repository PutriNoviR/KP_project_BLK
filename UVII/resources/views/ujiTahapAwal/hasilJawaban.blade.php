@extends('layouts.index')

@section('title')
   Hasil Jawaban
@endsection

@section('page-bar')

<div class="container">
    <div class="body_hasil">
        <h1> Hasil Tes Minat Peserta </h1><br><br><br>
        <p>Analisa Tes Minat Bakat:</p>
        <div class='row'>
            <div class='col-md-8'>
                <label for="kejuruan">Nama Kejuruan</label>
            </div>
            <div class="col-md-4">
                <label for="score">Score</label>
            </div>
            
        </div>

        @foreach($dataHasil as $data)
        <div class='row'>
            <div class='col-md-8'>
                <li type="text" class="form-control" id="kejuruan">{{ $data->kejuruan }}</li>
            </div>
            <div class="col-md-4">
                <li for="score">{{$data->score}}</li>
            </div>
        </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Lanjut</button>


    </div>
</div>
@endsection

