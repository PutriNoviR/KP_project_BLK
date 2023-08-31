@extends('layouts.adminlte')
@section('title')
DETAIL TUGAS PESERTA PELATIHAN NAMA INI BUAT KAYAK PELAPORAN
@endsection
@section('contents')
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#JawabanSeluruhPeserta" role="tab" aria-controls="nav-home" aria-selected="true">Daftar Seluruh Peserta</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#pesertaSudahKumpul" role="tab" aria-controls="nav-profile" aria-selected="false">Daftar Peserta yang Telah Mengumpulkan</a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#pesertaBelumKumpul" role="tab" aria-controls="nav-contact" aria-selected="false">Daftar Peserta yang Belum Mengumpulkan</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#pesertaTerlambatKumpul" role="tab" aria-controls="nav-profile" aria-selected="false">Daftar Peserta yang Terlambat Mengumpulkan</a>

  </div>
</nav>

<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="JawabanSeluruhPeserta" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="container">
      <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Seluruh Peserta</h2>
      </div>
      @if (\Session::has('success'))
      <div class="alert alert-success">
        <ul>
          <li>{!! \Session::get('success') !!}</li>
        </ul>
      </div>
      @endif
      <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid" aria-describedby="sample_1_info">
        <thead>
          <tr role="row">
            <th>No</th>
            <th>Nama</th>
            <th>Terakhir Diubah</th>
            <th>Jawaban</th>
            <th>Nilai</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="myTable">
          @foreach($semuaJawabanPeserta as $d)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$d['namaLengkap']}}</td>{{-- ambil dari model --}}
            <td>{{isset($d['updated_at']) ? $d['updated_at']:'BELUM MENGUMPULKAN'}}</td>
            <td>
              <a data-target="#JawabanSeluruhPeserta{{$loop->iteration}}" data-toggle="modal" class="button btn btn-primary text-white">
                Lihat Jawaban</i>
              </a>

              <a type="button" href="{{ asset('storage/'.$d['fileJawaban']) }}" class="btn btn-success" download="JAWABAN_{{$d['namaLengkap']."_".$d['fileJawaban']}}" @if(empty($d['fileJawaban'])) style="pointer-events: none;" @endif><i class="fas fa-print"></i>
                &nbsp; Download Jawaban
              </a>
            </td>
            @if($d['nilai'] == NULL) 
              <td>0</td>
            @else
            <td>{{$d['nilai']}}</td>
            @endif
            <td>
              <a class='btn btn-primary text-white' data-toggle="modal" data-target="#modalInputNilai_{{$loop->iteration}}" class='btn btn-primary text-white'>
                Input Nilai</i>
              </a>
            </td>
          </tr>
          {{-- MODAL SELURUH PESERTA --}}
          <div class="modal fade" id="JawabanSeluruhPeserta{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">JAWABAN PESERTA</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="detailPenugasan" class="col-md-12 col-form-label">{{ __('JAWABAN PESERTA') }}</label>
                    <textarea name="detailPenugasan" class="form-control topik" id="detailPenugasan" cols="40" rows="10" readonly>{{$d['jawabanTertulis']}}</textarea>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- MODAL INPUT NILAI TUGAS PESERTA --}}
          <div class="modal fade" id="modalInputNilai_{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Input Nilai Peserta Pelatihan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  {{--  --}}
                  <form method="POST" action="{{route('jawabanTugasPeserta.storeNilaiTugas')}}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                      <label for="topik" class="col-md-12 col-form-label">{{ __('Nilai Peserta') }}</label>
                      <input type="number" class="col-md-12 col-form-label" name="nilai">
                    </div>

                    <input type="hidden" value="{{$d['id']}}" name="idTugas">
                    <input type="hidden" value="{{$d['email_peserta']}}" name="email_peserta">
                    <input type="hidden" value="{{$d['idSesi']}}" name="sesi"> 
                    
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
                      <button type="submit" class="btn btn-primary">SIMPAN</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>





  <div class="tab-pane fade show" id="pesertaSudahKumpul" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="container">
      <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Peserta Yang Sudah Kumpul</h2>
      </div>
      @if (\Session::has('success'))
      <div class="alert alert-success">
        <ul>
          <li>{!! \Session::get('success') !!}</li>
        </ul>
      </div>
      @endif
      <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable2" role="grid" aria-describedby="sample_1_info">
        @php
        $urutan =1;
        @endphp
        <thead>
          <tr role="row">
            <th>No</th>
            <th>Nama</th>
            <th>Terakhir Diubah</th>
            <th>Nilai</th>
            <th>Jawaban</th>
          </tr>
        </thead>
        <tbody id="myTable">
          @foreach($pesertaSudahMengumpulkan as $d)
          @if(isset($d['updated_at']))
          <tr>
            <td>{{$urutan}}</td>
            <td>{{$d['namaLengkap']}}</td>
            <td>{{$d['updated_at']}}</td>
            <td>{{$d['nilai']}}</td>
            <td>
              <a data-target="#modalLihatJawabanPesertaYangSudahKumpul" data-toggle="modal" class="button btn btn-primary text-white">
                Lihat Jawaban</i>
              </a>

              <a class='btn btn-primary text-white' data-toggle="modal" data-target="#modalEditPengumpulanTugas" class='btn btn-primary text-white'>
                &nbsp; Download Jawaban
              </a>
            </td>
          </tr>

          @php
          $urutan++;
          @endphp
          @endif
          {{-- MODAL PESERTA SUDAH KUMPUL --}}
          <div class="modal fade" id="modalLihatJawabanPesertaYangSudahKumpul" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">JAWABAN PESERTA</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="detailPenugasan" class="col-md-12 col-form-label">{{ __('JAWABAN PESERTA') }}</label>
                    <textarea name="detailPenugasan" class="form-control topik" id="detailPenugasan" cols="40" rows="10" readonly></textarea>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div class="tab-pane fade show" id="pesertaBelumKumpul" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="container">
      <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Peserta yang Belum Kumpul</h2>
      </div>
      @if (\Session::has('success'))
      <div class="alert alert-success">
        <ul>
          <li>{!! \Session::get('success') !!}</li>
        </ul>
      </div>
      @endif
      <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable6" role="grid" aria-describedby="sample_1_info">
        <thead>
          <tr role="row">
            <th>No</th>
            <td>Nama</td>
            <td>Terakhir diubah</td>
            <td>Jawaban</td>
          </tr>
        </thead>
        <tbody id="myTable">
          @php
          $urutan =1;

          @endphp
          @foreach($pesertaTidakMengumpulkan as $d)
          @if(!isset($d['updated_at']))
          <tr>
            <td>{{$urutan}}</td>
            <td>{{$d['namaLengkap']}}</td>
            <td>{{$d['updated_at']}}</td>
            <td>
              GA KUMPUL
            </td>
          </tr>

          @php
          $urutan++;
          @endphp
          @endif
          @endforeach

        </tbody>
      </table>
    </div>
  </div>

  <div class="tab-pane fade show" id="pesertaTerlambatKumpul" role="tabpanel" aria-labelledby="nav-contact-tab">
    <div class="container">
      <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Peserta Terlambat Kumpul</h2>
      </div>
      @if (\Session::has('success'))
      <div class="alert alert-success">
        <ul>
          <li>{!! \Session::get('success') !!}</li>
        </ul>
      </div>
      @endif
      <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable3" role="grid" aria-describedby="sample_1_info">
        <thead>
          <tr role="row">
            <th>No</th>
            <td>Nama</td>
            <td>Terakhir diubah</td>
            <td>Jawaban</td>
          </tr>
        </thead>
        <tbody id="myTable">
          @foreach($pesertaTerlambatMengumpulkan as $d)
          @if(isset($d['updated_at']))
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$d['namaLengkap']}}</td>
            <td>{{$d['updated_at']}}</td>
            <td>
              <a data-target="#modalLihatJawabanPesertaTerlambatKumpul" data-toggle="modal" class="button btn btn-primary text-white">
                Lihat Jawaban</i>
              </a>

              <a class='btn btn-primary text-white' data-toggle="modal" data-target="#modalEditPengumpulanTugas" class='btn btn-primary text-white'>
                &nbsp; Download Jawaban
              </a>
            </td>
          </tr>
          @endif
    </div>

    {{-- MODAL PESERTA TERLAMBAT KUMPUL --}}
    <div class="modal fade" id="modalLihatJawabanPesertaTerlambatKumpul" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">JAWABAN PESERTA</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="detailPenugasan" class="col-md-12 col-form-label">{{ __('JAWABAN PESERTA') }}</label>
              <textarea name="detailPenugasan" class="form-control topik" id="detailPenugasan" cols="40" rows="10" readonly></textarea>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    </table>
  </div>
</div>


@endsection