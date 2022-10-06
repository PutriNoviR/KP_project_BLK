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
<!-- Tabs navs -->
<ul class="nav nav-tabs nav-justified mb-3" id="ex1" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="ex3-tab-1" data-mdb-toggle="tab" href="#ex3-tabs-1" role="tab" aria-controls="ex3-tabs-1" aria-selected="true">Daftar peserta</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="ex3-tab-2" data-mdb-toggle="tab" href="#ex3-tabs-2" role="tab" aria-controls="ex3-tabs-2" aria-selected="false">Peserta lolos seleksi</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="ex3-tab-3" data-mdb-toggle="tab" href="#ex3-tabs-3" role="tab" aria-controls="ex3-tabs-3" aria-selected="false">Peserta berkompeten</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="ex3-tab-3" data-mdb-toggle="tab" href="#ex3-tabs-3" role="tab" aria-controls="ex3-tabs-3" aria-selected="false">Peserta cadangan</a>
  </li>
</ul>
<!-- Tabs navs -->

<!-- Tabs content -->
<div class="tab-content" id="ex2-content">
  <div class="tab-pane fade show active" id="ex3-tabs-1" role="tabpanel" aria-labelledby="ex3-tab-1">
    <div class="container">
      <div class="d-flex justify-content-between mb-2">
        <h2>Riwayat Pelatihan</h2>
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
            <th>Alamat</th>
            <th>No Telepon</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Pendidikan Terakhir</th>
          </tr>
        </thead>
        <tbody id="myTable">
          @foreach($peserta as $d)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->nama_depan }} {{ $d->nama_belakang }}</td>
            <td>{{ $d->alamat }}</td>
            <td>{{ $d->nomer_hp }}</td>
            <td>{{ $d->tanggal_lahir }}</td>
            <td>{{ $d->jenis_kelamin }}</td>
            <td>{{ $d->pendidikan_terakhir }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="tab-pane fade" id="ex3-tabs-2" role="tabpanel" aria-labelledby="ex3-tab-2">
  <div class="container">
      <div class="d-flex justify-content-between mb-2">
        <h2>Riwayat Pelatihan</h2>
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
            <th>Alamat</th>
            <th>No Telepon</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Pendidikan Terakhir</th>
          </tr>
        </thead>
        <tbody id="myTable">
          @foreach($peserta as $d)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->nama_depan }} {{ $d->nama_belakang }}</td>
            <td>{{ $d->alamat }}</td>
            <td>{{ $d->nomer_hp }}</td>
            <td>{{ $d->tanggal_lahir }}</td>
            <td>{{ $d->jenis_kelamin }}</td>
            <td>{{ $d->pendidikan_terakhir }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="tab-pane fade" id="ex3-tabs-3" role="tabpanel" aria-labelledby="ex3-tab-3">
  <div class="container">
      <div class="d-flex justify-content-between mb-2">
        <h2>Riwayat Pelatihan</h2>
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
            <th>Alamat</th>
            <th>No Telepon</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Pendidikan Terakhir</th>
          </tr>
        </thead>
        <tbody id="myTable">
          @foreach($peserta as $d)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->nama_depan }} {{ $d->nama_belakang }}</td>
            <td>{{ $d->alamat }}</td>
            <td>{{ $d->nomer_hp }}</td>
            <td>{{ $d->tanggal_lahir }}</td>
            <td>{{ $d->jenis_kelamin }}</td>
            <td>{{ $d->pendidikan_terakhir }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Tabs content -->
@endsection