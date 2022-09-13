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
            <a href="{{route('home')}}">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('peserta.tes')}}">Tes Tahap 1</a>
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
                        <p>Hal Penting tentang Tes Minat Kejuruan:</p>
                    </div>
                    <div class="body-content">
                        <ul class="tulisan_rata">
                            <li>    
                            Tes minat kejuruan ini akan memberikan masukan mengenai kejuruan dari pelatihan yang nantinya dapat Anda ambil di Balai Latihan Kerja (BLK).
                            </li>
                            <li>
                            Anda akan dihadapkan pada pernyatan-penyataan yang berisi berbagai aktivitas kerja dan Anda diminta untuk memilih salah satu aktivitas kerja yang paling Anda sukai terlepas dari jumlah penghasilan yang akan Anda peroleh dari aktivitas tersebut juga terlepas dari apakah Anda sudah memiliki keahlian untuk melakukan aktivitas tersebut. Pilihlah aktivitas yang memang benar-benar Anda sukai.
                            </li>
                            <li>
                            Ketika mengerjakan tes ini, Anda diminta untuk menjawab seluruh pertanyaan-pertanyaan yang diberikan. Semua jawaban adalah benar sejauh Anda menjawab sesuai kondisi diri Anda. Anda tidak perlu khawatir, karena tidak ada jawaban yang salah. 
                            </li>
                            <li>
                            Anda diminta untuk mengerjakan soal-soal tes dalam waktu yang kami sediakan sesuai dengan instruksi.  Selama pengerjaan Anda dapat kembali ke soal sebelumnya.
                            </li>
                           
                        </ul>
                    </div>

                    <div class="body-btn">
                        <p>
                            Silahkan menekan tombol <b>Mulai Tes</b> jika merasa sudah siap. Selamat mengerjakan tes.
                        </p>

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