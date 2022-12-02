@extends('layouts.adminlte')
@section('title')
Pelaporan
@endsection

@section('javascript')
<script>
  $(function() {
    $("#myTable").DataTable({
      "responsive": true,
      "autoWidth": false,
      dom: 'Bfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });
    $("#myTable2").DataTable({
      "responsive": true,
      "autoWidth": false,
      dom: 'Bfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });
    $("#myTable3").DataTable({
      "responsive": true,
      "autoWidth": false,
      dom: 'Bfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });
    $("#myTable4").DataTable({
      "responsive": true,
      "autoWidth": false,
      dom: 'Bfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });
    $("#myTable5").DataTable({
      "responsive": true,
      "autoWidth": false,
      dom: 'Bfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });
    $("#myTable6").DataTable({
      "responsive": true,
      "autoWidth": false,
      dom: 'Bfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $($.fn.dataTable.tables(true)).DataTable()
           .columns.adjust()
           .responsive.recalc();
    });
  });

  function alertShow(id) {
    $.ajax({
      type: 'POST',
      url: '{{ route("sesiPelatihan.getDetail") }}',
      data: {
        '_token': '<?php echo csrf_token() ?>',
        'id': id,
      },
      success: function(data) {
        swal({
          title: "Aktivitas",
          text: data.data,
        })
      },
      error: function(xhr) {
        console.log(xhr);
      }
    });
  }
</script>
@endsection

@section('contents')

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#daftarPeserta" role="tab" aria-controls="nav-home" aria-selected="true">Daftar Calon Peserta</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#pesertaMengikutiSeleksi" role="tab" aria-controls="nav-profile" aria-selected="false">Peserta yang Mengikuti Seleksi</a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#pesertaCadangan" role="tab" aria-controls="nav-contact" aria-selected="false">Calon Peserta Cadangan</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#pesertaLolosSeleksi" role="tab" aria-controls="nav-profile" aria-selected="false">Calon Peserta yang Lolos Seleksi</a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#pesertaDaftarUlang" role="tab" aria-controls="nav-contact" aria-selected="false">Peserta daftar ulang</a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#pesertaBerkompeten" role="tab" aria-controls="nav-contact" aria-selected="false">Peserta berkompeten</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="daftarPeserta" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="container">
      <div class="d-flex justify-content-between mb-2">
        <h2>Laporan Pelatihan</h2>
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
            <th>No Telepon</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Pendidikan Terakhir</th>
            <th>INFO</th>
            <th>UPDATE HASIL SELEKSI</th>
          </tr>
        </thead>
        <tbody id="myTable">
          @foreach($peserta as $d)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->nama_depan }} {{ $d->nama_belakang }}</td>
            <td>{{ $d->nomer_hp }}</td>
            <td>{{ $d->tanggal_lahir }}</td>
            <td>{{ $d->jenis_kelamin }}</td>
            <td>{{ $d->pendidikan_terakhir }}</td>
            <td>
              <a data-toggle="modal" data-target="#modalInfoAkun{{$d->username}}" class="button btn btn-primary">
                <i class="fas fa-info"></i>
              </a>
            </td>
            <td>
              <button data-toggle="modal" data-target="#modalUpdateHasilSeleksiPelaporanPelatihan{{$d->username}}" class='btn btn-warning' onclick="modalEdit('{{$d->email_peserta}}','{{$d->sesi_pelatihans_id}}')">
                Update Hasil Seleksi
              </button>
            </td>
          </tr>
          <div class="modal fade" id="modalInfoAkun{{$d->username}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            {{-- TEMPAT AWAL MODAL --}}
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Data {{ $d->nama_depan}} {{ $d->nama_belakang}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div>
                    <img class="image-responsive-width" style="height: 90%; width: 90%;" src="{{ asset('storage/'.$d->pas_foto) }}" alt="">
                  </div>
                  <hr>
                  <div>
                    <label for="">Nomor Identitas</label><br>
                    <p>{{$d->nomor_identitas}}</p>
                    <label for="">Nomor HP</label><br>
                    <p>{{$d->nomer_hp}}</p>
                    <label for="">Domisili</label><br>
                    <p>{{$d->kota}}</p>
                    <label for="">Alamat</label><br>
                    <p>{{$d->alamat}}</p>
                    <label for="">Pendidikan Terakhir</label><br>
                    <p>{{$d->pendidikan_terakhir}}</p>
                  </div>

                </div>
              </div>
            </div>
          </div>


          <div class="modal fade" id="modalUpdateHasilSeleksiPelaporanPelatihan{{$d->username}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalEditPelatihanPeserta">EDIT HASIL SELEKSI PESERTA</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="{{ route('pelatihanPesertas.update',$d->email) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="nama" class="col-md-12 col-form-label">{{ __('Email Peserta') }}</label>
                      <div class="col-md-12">
                        <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$d->email}}" readonly autocomplete="nama" autofocus>
                        <input type="hidden" name="sesi_pelatihans_id" class="col-md-12 col-form-label" value="{{$d->sesi_pelatihans_id}}">
                        @error('nama')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="nama" class="col-md-12 col-form-label">{{ __('Rekomendasi Keputusan') }}</label>
                      <div class="col-md-12">
                        <select class="form-control" aria-label="Default select example" name="rekom_keputusan" value="{{$d->rekom_keputusan}}">
                          <option value="LULUS">Diterima</option>
                          <option value="TIDAK LULUS">Tidak Diterima</option>
                          <option value="CADANGAN">Cadangan</option>
                          <option value="MENGUNDURKAN DIRI">Mengundurkan Diri</option>
                        </select>

                        @error('nama')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group">
                      <input type="hidden" id="permanent" name="rekom_is_permanent" class="col-md-12 col-form-label" value="0">
                      <div class="modal-footer">
                        <div>
                          <button onclick="" type="submit" id="sementara" name="action" class="btn btn-success" value="1">Simpan</button>
                          {{-- <button onclick="myFunction(); submitFormSimpanPermanen(this);" type="submit" id="permanent" name="action" class="btn btn-primary">Simpan Permanen</button> --}}
                        </div>
                      </div>
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


  <div class="tab-pane fade show" id="pesertaLolosSeleksi" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="container">
      <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Peserta Lolos Seleksi</h2>
      </div>
      @if (\Session::has('success'))
      <div class="alert alert-success">
        <ul>
          <li>{!! \Session::get('success') !!}</li>
        </ul>
      </div>
      @endif
      <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable2" role="grid" aria-describedby="sample_1_info">
        <thead>
          <tr role="row">
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>INFO</th>
            <th>UPDATE HASIL SELEKSI</th>
          </tr>
        </thead>
        <tbody id="myTable2">
          @foreach($lolos as $d)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->nama_depan }} {{ $d->nama_belakang }}</td>
            <td>{{ $d->tanggal_lahir }}</td>
            <td>{{ $d->jenis_kelamin }}</td>
            <td>
              <a data-toggle="modal" data-target="#modalInfoAkunPesertaLolosSeleksi{{$d->username}}" class="button btn btn-primary">
                <i class="fas fa-info"></i>
              </a>
            </td>
            <td>
              <button data-toggle="modal" data-target="#modalUpdateHasilSeleksi{{$d->username}}" class='btn btn-warning' onclick="modalEdit('{{$d->email_peserta}}','{{$d->sesi_pelatihans_id}}')" >
                Update Hasil Seleksi
              </button>
          </tr>
          <div class="modal fade" id="modalInfoAkunPesertaLolosSeleksi{{$d->username}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Data {{ $d->nama_depan}} {{ $d->nama_belakang}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div>
                    <img class="image-responsive-width" style="height: 90%; width: 90%;" src="{{ asset('storage/'.$d->pas_foto) }}" alt="">
                  </div>
                  <hr>
                  <div>
                    <label for="">Nomor Identitas</label><br>
                    <p>{{$d->nomor_identitas}}</p>
                    <label for="">Nomor HP</label><br>
                    <p>{{$d->nomer_hp}}</p>
                    <label for="">Domisili</label><br>
                    <p>{{$d->kota}}</p>
                    <label for="">Alamat</label><br>
                    <p>{{$d->alamat}}</p>
                    <label for="">Pendidikan Terakhir</label><br>
                    <p>{{$d->pendidikan_terakhir}}</p>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="modalUpdateHasilSeleksi{{$d->username}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalEditPelatihanPeserta">EDIT HASIL SELEKSI PESERTA</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="{{ route('pelatihanPesertas.update',$d->email) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="nama" class="col-md-12 col-form-label">{{ __('Email Peserta') }}</label>
                      <div class="col-md-12">
                        <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$d->email}}" readonly autocomplete="nama" autofocus>
                        <input type="hidden" name="sesi_pelatihans_id" class="col-md-12 col-form-label" value="{{$d->sesi_pelatihans_id}}">
                        @error('nama')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="nama" class="col-md-12 col-form-label">{{ __('Rekomendasi Keputusan') }}</label>
                      <div class="col-md-12">
                        <select class="form-control" aria-label="Default select example" name="rekom_keputusan" value="{{$d->rekom_keputusan}}">
                          <option value="TIDAK LULUS">Tidak Diterima</option>
                          <option value="CADANGAN">Cadangan</option>
                          <option value="MENGUNDURKAN DIRI">Mengundurkan Diri</option>
                        </select>

                        @error('nama')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group">
                      <input type="hidden" id="permanent" name="rekom_is_permanent" class="col-md-12 col-form-label" value="0">
                      <div class="modal-footer">
                        <div>
                          <button onclick="" type="submit" id="sementara" name="action" class="btn btn-success" value="1">Simpan</button>
                          {{-- <button onclick="" type="submit" id="sementara" name="action" class="btn btn-default" value="1">Simpan Sementara</button>
                          <button onclick="myFunction(); submitFormSimpanPermanen(this);" type="submit" id="permanent" name="action" class="btn btn-primary">Simpan Permanen</button> --}}
                        </div>
                      </div>
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

  <div class="tab-pane fade show" id="pesertaMengikutiSeleksi" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="container">
      <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Peserta yang Mengikuti Seleksi</h2>
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
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>INFO</th>
            <th>UPDATE HASIL SELEKSI</th>
          </tr>
        </thead>
        <tbody id="myTable">
          @foreach($mengikutiSeleksi as $d)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->nama_depan }} {{ $d->nama_belakang }}</td>
            <td>{{ $d->tanggal_lahir }}</td>
            <td>{{ $d->jenis_kelamin }}</td>
            <td>
              <a data-toggle="modal" data-target="#modalInfoAkunPesertaMengikutiSeleksi{{$d->username}}" class="button btn btn-primary">
                <i class="fas fa-info"></i>
              </a>
            </td>
            <td>
              <button data-toggle="modal" data-target="#modalUpdateHasilSeleksiIkut{{$d->username}}" class='btn btn-warning' onclick="modalEdit('{{$d->email_peserta}}','{{$d->sesi_pelatihans_id}}')" >
                Update Hasil Seleksi
              </button>
          </tr>
          <div class="modal fade" id="modalInfoAkunPesertaMengikutiSeleksi{{$d->username}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Data {{ $d->nama_depan}} {{ $d->nama_belakang}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div>
                    <img class="image-responsive-width" style="height: 90%; width: 90%;" src="{{ asset('storage/'.$d->pas_foto) }}" alt="">
                  </div>
                  <hr>
                  <div>
                    <label for="">Nomor Identitas</label><br>
                    <p>{{$d->nomor_identitas}}</p>
                    <label for="">Nomor HP</label><br>
                    <p>{{$d->nomer_hp}}</p>
                    <label for="">Domisili</label><br>
                    <p>{{$d->kota}}</p>
                    <label for="">Alamat</label><br>
                    <p>{{$d->alamat}}</p>
                    <label for="">Pendidikan Terakhir</label><br>
                    <p>{{$d->pendidikan_terakhir}}</p>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="modalUpdateHasilSeleksiIkut{{$d->username}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalEditPelatihanPeserta">EDIT HASIL SELEKSI PESERTA</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="{{ route('pelatihanPesertas.update',$d->email) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="nama" class="col-md-12 col-form-label">{{ __('Email Peserta') }}</label>
                      <div class="col-md-12">
                        <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$d->email}}" readonly autocomplete="nama" autofocus>
                        <input type="hidden" name="sesi_pelatihans_id" class="col-md-12 col-form-label" value="{{$d->sesi_pelatihans_id}}">
                        @error('nama')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="nama" class="col-md-12 col-form-label">{{ __('Rekomendasi Keputusan') }}</label>
                      <div class="col-md-12">
                        <select class="form-control" aria-label="Default select example" name="rekom_keputusan" value="{{$d->rekom_keputusan}}">
                        <option value="LULUS">Diterima</option>  
                        <option value="TIDAK LULUS">Tidak Diterima</option>
                          <option value="CADANGAN">Cadangan</option>
                          <option value="MENGUNDURKAN DIRI">Mengundurkan Diri</option>
                        </select>

                        @error('nama')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group">
                      <input type="hidden" id="permanent" name="rekom_is_permanent" class="col-md-12 col-form-label" value="0">
                      <div class="modal-footer">
                        <div>
                          <button onclick="" type="submit" id="sementara" name="action" class="btn btn-success" value="1">Simpan</button>
                          {{-- <button onclick="" type="submit" id="sementara" name="action" class="btn btn-default" value="1">Simpan Sementara</button>
                          <button onclick="myFunction(); submitFormSimpanPermanen(this);" type="submit" id="permanent" name="action" class="btn btn-primary">Simpan Permanen</button> --}}
                        </div>
                      </div>
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

  <div class="tab-pane fade show" id="pesertaBerkompeten" role="tabpanel" aria-labelledby="nav-contact-tab">
    <div class="container">
      <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Peserta Kompeten</h2>
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
            <th>Nama</th>
            <th>No Telepon</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Pendidikan Terakhir</th>
            <th>INFO</th>
          </tr>
        </thead>
        <tbody id="myTable">
          @foreach($kompeten as $d)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->nama_depan }} {{ $d->nama_belakang }}</td>
            <td>{{ $d->nomer_hp }}</td>
            <td>{{ $d->tanggal_lahir }}</td>
            <td>{{ $d->jenis_kelamin }}</td>
            <td>{{ $d->pendidikan_terakhir }}</td>
            <td>
              <a data-toggle="modal" data-target="#modalInfoAkunPesertaKompeten{{$d->username}}" class="button btn btn-primary">
                <i class="fas fa-info"></i>
              </a>
            </td>
          </tr>
          <div class="modal fade" id="modalInfoAkunPesertaKompeten{{$d->username}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Data {{ $d->nama_depan}} {{ $d->nama_belakang}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div>
                    <img class="image-responsive-width" style="height: 90%; width: 90%;" src="{{ asset('storage/'.$d->pas_foto) }}" alt="">
                  </div>
                  <hr>
                  <div>
                    <label for="">Nomor Identitas</label><br>
                    <p>{{$d->nomor_identitas}}</p>
                    <label for="">Nomor HP</label><br>
                    <p>{{$d->nomer_hp}}</p>
                    <label for="">Domisili</label><br>
                    <p>{{$d->kota}}</p>
                    <label for="">Alamat</label><br>
                    <p>{{$d->alamat}}</p>
                    <label for="">Pendidikan Terakhir</label><br>
                    <p>{{$d->pendidikan_terakhir}}</p>
                  </div>

                </div>
              </div>
            </div>
          </div>
    </div>
    @endforeach
    </table>
  </div>
</div>
<div class="tab-pane fade" id="pesertaCadangan" role="tabpanel" aria-labelledby="nav-contact-tab">
  <div class="container">
    <div class="d-flex justify-content-between mb-2">
      <h2>Calon Peserta Cadangan</h2>
    </div>
    @if (\Session::has('success'))
    <div class="alert alert-success">
      <ul>
        <li>{!! \Session::get('success') !!}</li>
      </ul>
    </div>
    @endif
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable4" role="grid" aria-describedby="sample_1_info">
      <thead>
        <tr role="row">
          <th>No</th>
          <th>Nama</th>
          <th>No Telepon</th>
          <th>Tanggal Lahir</th>
          <th>Jenis Kelamin</th>
          <th>Pendidikan Terakhir</th>
          <th>INFO</th>
          <th>UPDATE HASIL SELEKSI</th>
        </tr>
      </thead>
      <tbody id="myTable">
        @foreach($cadangan as $d)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $d->nama_depan }} {{ $d->nama_belakang }}</td>
          <td>{{ $d->nomer_hp }}</td>
          <td>{{ $d->tanggal_lahir }}</td>
          <td>{{ $d->jenis_kelamin }}</td>
          <td>{{ $d->pendidikan_terakhir }}</td>
          <td>
            <a data-toggle="modal" data-target="#modalInfoAkunPesertaCadangan{{$d->username}}" class="button btn btn-primary">
              <i class="fas fa-info"></i>
            </a>
          </td>
          <td>
            <button data-toggle="modal" data-target="#modalUpdateHasilSeleksiCalonPesertaCadangan{{$d->username}}" class='btn btn-warning' onclick="modalEdit('{{$d->email_peserta}}','{{$d->sesi_pelatihans_id}}')" >
              Update Hasil Seleksi
            </button>
          </td>
        </tr>
        <div class="modal fade" id="modalInfoAkunPesertaCadangan{{$d->username}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data {{ $d->nama_depan}} {{ $d->nama_belakang}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div>
                  <img class="image-responsive-width" style="height: 90%; width: 90%;" src="{{ asset('storage/'.$d->pas_foto) }}" alt="">
                </div>
                <hr>
                <div>
                  <label for="">Nomor Identitas</label><br>
                  <p>{{$d->nomor_identitas}}</p>
                  <label for="">Nomor HP</label><br>
                  <p>{{$d->nomer_hp}}</p>
                  <label for="">Domisili</label><br>
                  <p>{{$d->kota}}</p>
                  <label for="">Alamat</label><br>
                  <p>{{$d->alamat}}</p>
                  <label for="">Pendidikan Terakhir</label><br>
                  <p>{{$d->pendidikan_terakhir}}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modalUpdateHasilSeleksiCalonPesertaCadangan{{$d->username}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalEditPelatihanPeserta">EDIT HASIL SELEKSI PESERTA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" action="{{ route('pelatihanPesertas.update',$d->email) }}">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="nama" class="col-md-12 col-form-label">{{ __('Email Peserta') }}</label>
                    <div class="col-md-12">
                      <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$d->email}}" readonly autocomplete="nama" autofocus>
                      <input type="hidden" name="sesi_pelatihans_id" class="col-md-12 col-form-label" value="{{$d->sesi_pelatihans_id}}">
                      @error('nama')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="nama" class="col-md-12 col-form-label">{{ __('Rekomendasi Keputusan') }}</label>
                    <div class="col-md-12">
                      <select class="form-control" aria-label="Default select example" name="rekom_keputusan" value="{{$d->rekom_keputusan}}">
                        <option value="LULUS">Diterima</option>
                        <option value="TIDAK LULUS">Tidak Diterima</option>
                      </select>

                      @error('nama')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group">
                    <input type="hidden" id="permanent" name="rekom_is_permanent" class="col-md-12 col-form-label" value="0">
                    <div class="modal-footer">
                      <div>
                        <button onclick="" type="submit" id="sementara" name="action" class="btn btn-success" value="1">Simpan</button>
                        {{-- <button onclick="" type="submit" id="sementara" name="action" class="btn btn-default" value="1">Simpan Sementara</button>
                        <button onclick="myFunction(); submitFormSimpanPermanen(this);" type="submit" id="permanent" name="action" class="btn btn-primary">Simpan Permanen</button> --}}
                      </div>
                    </div>
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


<div class="tab-pane fade" id="pesertaDaftarUlang" role="tabpanel" aria-labelledby="nav-contact-tab">
  <div class="container">
    <div class="d-flex justify-content-between mb-2">
      <h2>Peserta Daftar Ulang</h2>
    </div>
    @if (\Session::has('success'))
    <div class="alert alert-success">
      <ul>
        <li>{!! \Session::get('success') !!}</li>
      </ul>
    </div>
    @endif
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable5" role="grid" aria-describedby="sample_1_info">
      <thead>
        <tr role="row">
          <th>No</th>
          <th>Nama</th>
          <th>No Telepon</th>
          <th>Tanggal Lahir</th>
          <th>Jenis Kelamin</th>
          <th>Pendidikan Terakhir</th>
          <th>INFO</th>
          <th>UPDATE HASIL SELEKSI</th>
        </tr>
      </thead>
      <tbody id="myTable">
        @foreach($daftarUlang as $d)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $d->nama_depan }} {{ $d->nama_belakang }}</td>
          <td>{{ $d->nomer_hp }}</td>
          <td>{{ $d->tanggal_lahir }}</td>
          <td>{{ $d->jenis_kelamin }}</td>
          <td>{{ $d->pendidikan_terakhir }}</td>
          <td>
            <a data-toggle="modal" data-target="#modalInfoAkunPesertaDaftarUlang{{$d->username}}" class="button btn btn-primary">
              <i class="fas fa-info"></i>
            </a>
          </td>
          <td>
              <button data-toggle="modal" data-target="#modalUpdateHasilSeleksiPesertaDaftarUlang{{$d->username}}" class='btn btn-warning' onclick="modalEdit('{{$d->email_peserta}}','{{$d->sesi_pelatihans_id}}')">
                Update Hasil Seleksi
              </button>
            </td>
        </tr>
        <div class="modal fade" id="modalInfoAkunPesertaDaftarUlang{{$d->username}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data {{ $d->nama_depan}} {{ $d->nama_belakang}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div>
                  <img class="image-responsive-width" style="height: 90%; width: 90%;" src="{{ asset('storage/'.$d->pas_foto) }}" alt="">
                </div>
                <hr>
                <div>
                  <label for="">Nomor Identitas</label><br>
                  <p>{{$d->nomor_identitas}}</p>
                  <label for="">Nomor HP</label><br>
                  <p>{{$d->nomer_hp}}</p>
                  <label for="">Domisili</label><br>
                  <p>{{$d->kota}}</p>
                  <label for="">Alamat</label><br>
                  <p>{{$d->alamat}}</p>
                  <label for="">Pendidikan Terakhir</label><br>
                  <p>{{$d->pendidikan_terakhir}}</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalUpdateHasilSeleksiPesertaDaftarUlang{{$d->username}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalEditPelatihanPeserta">EDIT HASIL SELEKSI PESERTA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" action="{{ route('pelatihanPesertas.update',$d->email) }}">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="nama" class="col-md-12 col-form-label">{{ __('Email Peserta') }}</label>
                    <div class="col-md-12">
                      <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$d->email}}" readonly autocomplete="nama" autofocus>
                      <input type="hidden" name="sesi_pelatihans_id" class="col-md-12 col-form-label" value="{{$d->sesi_pelatihans_id}}">
                      @error('nama')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="nama" class="col-md-12 col-form-label">{{ __('Rekomendasi Keputusan') }}</label>
                    <div class="col-md-12">
                      <select class="form-control" aria-label="Default select example" name="rekom_keputusan" value="{{$d->rekom_keputusan}}">
                      <option value="MENGUNDURKAN DIRI">Mengundurkan Diri</option>
                      </select>

                      @error('nama')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group">
                    <input type="hidden" id="permanent" name="rekom_is_permanent" class="col-md-12 col-form-label" value="0">
                    <div class="modal-footer">
                      <div>
                        <button onclick="" type="submit" id="sementara" name="action" class="btn btn-success" value="1">Simpan</button>
                        {{-- <button onclick="" type="submit" id="sementara" name="action" class="btn btn-default" value="1">Simpan Sementara</button>
                        <button onclick="myFunction(); submitFormSimpanPermanen(this);" type="submit" id="permanent" name="action" class="btn btn-primary">Simpan Permanen</button> --}}
                      </div>
                    </div>
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
</div>
</div>
@endsection