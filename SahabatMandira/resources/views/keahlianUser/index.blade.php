@extends('layouts.adminlte')

@section('title')
Keahlian Mentor
@endsection

@section('style')
<style>
    .ck-editor__editable_inline {
        min-height: 200px;
    }
</style>
@endsection

@section('page-bar')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Keahlian</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Lowongan</li> -->
    </ol>
</div><!-- /.col -->
@endsection

@section('javascript')
<script>

    $('#btnSimpanKeahlian').click(function() {
        const nama = $('#namaKeahlian').val();
        const id = $('#namaKeahlian option:selected').attr('id-keahlian');
        // alert(id);
        $('#tbody').append(`<tr>
            <td style="width:90%">${nama}</td>
            <input type="hidden" name="keahlian[]" value="${id}">
            <td style="width:10%"><button type="button"  class="btndeleterow btn btn-danger"><i
                                class="fas fa-trash"></i></button></td>
        </tr>`);
        $('#tambahKeahlianMentor').modal('hide');
    });

    $('body').on('click', '.btndeleterow', function() {
        $(this).parent().parent().remove();
    })
</script>
@endsection

@section('contents')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card-register">
            <div class="card-header">
                <h4>Keahlian Mentor</h4>
            </div>
            @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
            @endif
            @if(count($errors) > 0)
            @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                <li>{{$error}}</li>
            </div>
            @endforeach
            @endif

            <div class="card-body">
                <form method="POST" action="{{ route('keahlianUser.store') }}">
                    @csrf

                    <div class="form-group p-3 border rounded">
                        <label class="form-label">Keahlian</label>
                        <div id="dokumen_perusahaan" class="row flex-column" style="min-height: 150px">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 90%">Nama</th>
                                        <th style="width: 10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="tambah_dokumen" class="p-3 border rounded">
                        <button type="button" id="btntambah" class="btn btn-primary btn-block" data-toggle="modal" data-target="#tambahKeahlianMentor">Tambah Keahlian</button>
                    </div>
                    <div class="form-group mt-3 rata_tengah">
                        <div class="col-md-12 offset-manual">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('SIMPAN') }}
                            </button>
                            <br>
                        </div>
                    </div>
                </form>


                <!-- Modal -->
                <div class="modal fade" id="tambahKeahlianMentor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Keahlian Mentor</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <!-- <label for="" class="form-label">Keahlian</label> -->
                                    <select class="form-control" aria-label="Default select example" name="mentors_email" id="namaKeahlian" readonly>
                                        @foreach($keahlian as $k)
                                        <option id="namaKeahlian" value="{{$k->nama}}" id-keahlian="{{$k->idkeahlians}}">{{$k->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-primary" id="btnSimpanKeahlian">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endsection
            </div>
        </div>
    </div>
</div>