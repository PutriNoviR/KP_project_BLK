@extends('layouts.tesAwal')

@section('title')
    Uji Tahap Awal
@endsection

@section('contents')
<div class="container">
    <div class="timer" >
        <p>Time Left : 0:20:00</p>
    </div>

    <div class="body_test">

        <div class="soal">
           <li> Manakah aktivitas kerja Yang anda sukai ?</li>
            
        </div>

        <div class="row_pilihan">

            <div class="pilihan">
                
                <label>
                    <input type="radio" name="pilahan_soal_1" value="kejuruan_id"> 
                    Mengembangkan  website
                </label>
            </div>

            <div class="pilihan">
                <label>
                    <input type="radio" name="pilahan_soal_1" value="kujuruan_id"> 
                    Mengembangkan produk Virtual Reality
                </label>
            </div>

            <div class="pilihan">
                <label>
                    <input type="radio" name="pilahan_soal_1" value="kejuruan_id"> 
                    Menghitung proses distribusi barang
                </label>
            </div>
    
            <div class="pilihan">
                <label>
                    <input type="radio" class="form-check-input" name="pilahan_soal_1" value="kejuruan_id">
                    Mengkombinasikan elemen-elemen kimia
                </label>
            </div>
            
            <div class="pilihan">
                <label>
                    <input type="radio" name="pilahan_soal_1" value="kejuruan_id"> 
                    Merakit elemen-elemen elektronik
                </label>
            </div>
        </div>

    </div>

    <div class="tes-btn">
        <a href="{{ route('peserta.uji.tahap.awal') }}" class="button btn btn-primary">Previous</a>
        <a href="{{ route('peserta.uji.tahap.awal') }}" class="button btn btn-primary">NEXT</a>
        
    </div>

    <div class="navigation">
        <div class="nav-title" >
            <p>Test Navigation</p>
        </div>
        
        <div class="line"></div>

        <div class="row">
            @for($i=1; $i <= 20; $i++)
            <div class="box">
                <span>{{ $i }}</span>
            </div>
            @endfor
        </div>

        <div class="finish_attempt" >
            <p>Finish Attempt...</p>
        </div>
    </div>

</div>
@endsection

