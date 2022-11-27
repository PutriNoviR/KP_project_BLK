@extends('layouts.adminlte')

@section('title')
Daftar Peserta
@endsection

@section('javascript')
<script>
    $(function () {

        $("#myTable").DataTable({
            "responsive": true,
            "autoWidth": true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print',
                {
                extend: 'pdfHtml5',
                customize: function ( doc ) {
                    doc.content.splice( 1, 0 );
                    var logo = 'data:image/png;base64,' + '<?= base64_encode(file_get_contents('https://seeklogo.com/images/J/jawa-timur-logo-24818906D1-seeklogo.com.png')) ?>'
                    doc.pageMargins = [20,60,20,30];
                    doc['header']=(function() {
							return {
								columns: [
									{
										image: logo,
										width: 45
									},
									{
										alignment: 'center',
										text: '<?= $blk[0]->nama ?>',
										fontSize: 18,
										margin: [10,0]
									},
								],
								margin: 20
							}
						});

                },
                 exportOptions: {
                    columns: [ 0, 1, 2,3 ]
                    },

                },
                'colvis'
            ]
        });
    });

    function modalEdit(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("user.getEditForm") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id,
            },
            success: function (data) {
                $("#modalContent").html(data.msg);
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    }

    function submitFormSuspend(form) {
        swal({
                title: "Peringatan!",
                text: "Apakah anda yakin ingin mengsuspend peserta ini?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        return false;
    }

</script>
@endsection

@section('contents')
<div class="container">
    <div class="d-flex justify-content-between mb-2">
        @if(Auth::user()->role->nama_role == 'superadmin')
        <h2>Daftar Akun</h2>
        @else
        <h2>Daftar Peserta di semua sesi pelatihan</h2>
        @endif

    </div>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid"
        aria-describedby="sample_1_info">
        <thead>
            <tr role="row">
                <th>NO</th>
                <th>EMAIL</th>
                <th>USERNAME</th>
                <th>NAMA</th>
                <th>INFO</th>
                <th>AKSI</th>
                <!-- <th>NO</th>
                <th>NAMA</th>
                <th>KTP</th>
                <th>FC IJAZAH</th>
                <th>FOTO</th>
                <th>ALAMAT DOMILISI</th>
                <th>ALAMAT KTP</th>
                <th>AKSI</th> -->
            </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->email}}</td>
                <td>{{ $d->username}}</td>
                <td>{{ $d->nama_depan}} {{ $d->nama_belakang}}</td>
                <!-- <td>{{ $loop->iteration }}</td>
                <td>{{ $d->nama_depan}} {{ $d->nama_belakang}}</td>
                <td>KTP</td>
                <td>FC IJAZAH</td>
                <td>FOTO</td>
                <td>{{ $d->alamat}}</td>
                <td>ALAMAT KTP</td>
            -->
                <td>
                    <!-- <a data-toggle="modal" data-target="#modalInfoAkun{{$d->email}}" class="button btn btn-info">
                        <i class="fas fa-info"></i>
                    </a> -->

                    <a data-toggle="modal" data-target="#modalInfoAkun{{$d->username}}" class="button btn btn-primary">
                        <i class="fas fa-info"></i>
                    </a>
                </td>
                <td>
                    @if( $d->is_suspend == '1')
                    <form method="POST" action="{{ route('User.suspend',$d->email) }}"
                        onsubmit="return submitFormSuspend(this);" class="d-inline">
                        @csrf
                        <button data-toggle="modal" data-target="#modalEditPelatihanPeserta" class='btn btn-success'
                            onclick="modalEdit('{{$d->email_peserta}}')">
                            UNSUSPEND
                        </button>
                    </form>
                    @else
                    <form method="POST" action="{{ route('User.suspend',$d->email) }}"
                        onsubmit="return submitFormSuspend(this);" class="d-inline">
                        @csrf
                        <button data-toggle="modal" data-target="#modalEditPelatihanPeserta" class='btn btn-danger'
                            onclick="modalEdit('{{$d->email_peserta}}')">
                            SUSPEND
                        </button>
                    </form>
                    @endif
                </td>
            </tr>
            <div class="modal fade" id="modalInfoAkun{{$d->username}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Data {{ $d->nama_depan}}
                                {{ $d->nama_belakang}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <img class="image-responsive-width" style="height: 90%; width: 90%;"
                                    src="{{ asset('storage/'.$d->pas_foto) }}" alt="">
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
            @endforeach
        </tbody>
    </table>
</div>
@endsection
