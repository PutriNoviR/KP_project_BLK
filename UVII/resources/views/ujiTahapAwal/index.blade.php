@extends('layouts.index',['menu' => $menu_role])

@section('title')
    Tes Tahap 1
@endsection

@section('javascript')
    <script>
        function show(){
            $('#modalTes').css('display', 'block');   
            $('#page').css('filter', 'blur(4px)');
        }

        function unshow(){
            $('#modalTes').css('display', 'none');   
            $('#page').css('filter', 'blur(0)');
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
            <a href="http://127.0.0.1:8000/menu/tes">Tes Tahap 1</a>
            <i class="fa fa-angle-right"></i>
        </li>
    </ul>
@endsection

@section('contents')
        <div class="card-page">
            <div id="page">
                <div class="card-header">
                    <p>Tes Minat Bakat</p>
                </div>

                <div class="card-body">
                    <div class="body-title" >
                        <p>Hal Penting tentang Tes Minat Bakat:</p>
                    </div>
                    <div class="body-content">
                        <ul class="tulisan_rata">
                            <li>    
                                Tes minat bakat akan menentukan kejuruan dari pelatihan yang nantinya kalian ambil.
                            </li>
                            <li>
                                Ketika mengikuti tes ini, kalian harus menyelesaikan beberapa soal dalam bentuk 
                                    pilihan ganda dan harus diselesaikan dalam waktu yang telah disediakan.  
                                    Selama pengerjaan kalian dapat kembali ke soal sebelumnya.
                            </li>
                            <li>
                                Silahkan menekan tombol <b>Mulai Tes</b> jika merasa sudah siap.
                            </li>
                        </ul>
                    </div>

                    <div class="body-btn">
                        @if($tes == null)
                            <button type="button" class="btn btn-primary" onclick="show()">
                                Mulai Tes
                            </button>
                        @else
                            <a href="{{ route('peserta.uji.tahap.awal') }}" class="button btn btn-primary">Lanjut Tes</a>
                        @endif
                        
                    </div>
                </div>

            </div>

            <div id="modalTes">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body" style="text-align: center;">
                            <div class="modal-body-icon">
                                <i class="glyphicon glyphicon-warning-sign"></i>
                            </div>
                            <p>
                                Waktu akan berjalan setelah kalian menekan tombol <b>Mulai</b>.
                            </p>
                            <p>
                                Pastikan menyelesaikan soal tepat waktu.
                            </p>
                        </div>
    
                        <div class="modal-btn">
                            <a href="{{ route('peserta.uji.tahap.awal') }}" class="button btn btn-primary">Mulai</a>
                            <button type="button" class="btn btn-default" onclick="unshow()">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   
@endsection