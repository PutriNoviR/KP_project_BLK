@extends('layouts.index',['menu' => $menu_role])

@section('title')
   Hasil Tes Tahap 2
@endsection

@section('contents')
    <div class="card-page">
        <div class="card-header">
        <p><b>Hasil Tes Tahap 2</b></p>
        </div>
        <div class="card-body">
            <div class='row'>
                <div class='col-md-8'>
                    <label for="kejuruan"><b>Peringkat</b></label>
                </div>
                <div class="col-md-4">
                    <label for="score"><b>Kategori</b></label>
                </div>
                        
            </div>
            @foreach($hasil_Tes_2 as $data)
                        
            <div class='row'>
                <div class='col-md-8'>
                                
                    <p for="peringkat"><b>{{ $data->peringkat }}</b></p>
                                
                </div>
                <div class="col-md-4">
                            
                    <p for="kategori">{{$data->nama}}</p>
                            
                </div>
            </div>       

            @endforeach
            
        </div>
    </div>

@endsection