@extends('layouts.adminlte')
@section('title')
    Bidang Kerja
@endsection
@section('javascript')
    <script>
        $("#myTable").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    </script>
    <script>
        function editRow(nama,keterangan,id) {

            $("#editForm").attr('action' , '/bidang-kerja/' + id);

            // Set data in the modal form
            $("#editNamaBidang").val(nama);
            $("#editKeterangan").val(keterangan);

            // Show the modal
            $("#editModal").modal("show");

        }
    </script>
@endsection


@section('contents')
    <div class="container">
        @if (\Session::has('success'))
            {{-- <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div> --}}

            <div class="alert alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success</strong> {!! \Session::get('success') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="d-flex justify-content-between mb-2">
            <h2>Bidang Kerja</h2>
            <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"">
                Tambah Bidang
            </a>
        </div>
        {{-- TAMBAHKAN --}}

        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid"
            aria-describedby="sample_1_info">
            <thead>
                <tr role="row">
                    <th>#</th>
                    <th>Nama</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $row = 0;
                @endphp
                @foreach ($data as $item)
                    @php
                        $row++;
                    @endphp
                    <tr>
                        <td>{{ $row }}</td>
                        <td>{{ $item->nama_bidang }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>
                            <button class="btn btn-primary" onclick="editRow('{{ $item->nama_bidang }}','{{ $item->keterangan }}' , {{ $item->id }})">Edit</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- MODAL TAMBAH  --}}

        <!-- Modal -->
        <form action="/bidang-kerja" method="POST">
            @csrf
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Bidang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                                <div class="form-group">
                                    <label for="namaBidang">Nama Bidang:</label>
                                    <input type="text" class="form-control" name="nama" id="namaBidang">
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan:</label>
                                    <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Modal UBAHH -->
        <div class="modal" tabindex="-1" role="dialog" id="editModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form to edit data -->
                        <form id="editForm" method="POST" action="/bidang-kerja/2">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="editNamaBidang">Nama Bidang</label>
                                <input type="text" class="form-control" id="editNamaBidang" name="editNamaBidang">
                            </div>
                            <div class="form-group">
                                <label for="editKeterangan">Keterangan</label>
                                <input type="text" class="form-control" id="editKeterangan" name="editKeterangan">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
