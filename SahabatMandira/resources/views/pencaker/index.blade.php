@extends('layouts.adminlte')

@section('title')
    Daftar Semua Lamaran
@endsection

@section('javascript')
    <script>
        @if ($message = session('success'))
            Swal.fire(
                'Berhasil!',
                'Data berhasil di ubah',
                'success'
            )
        @endif

        $(function() {
            $("#myTable").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });

        function submitDelete(form) {
            swal({
                    title: "Peringatan!",
                    text: "Apakah anda yakin ingin menghapus data ini?",
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

        function modalEditStatus(id) {
            // console.log('1');
            $.ajax({
                type: 'POST',
                url: '{{ route('pencaker.getEditForm') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'Id': id,
                },
                success: function(data) {
                    $("#modalContent").html(data.msg);
                    // console.log(data);
                },
                error: function(xhr) {
                    alert('erorr');
                    console.log(xhr);
                }
            });
        }

        function onChangeStatus(val, status) {
            // Get all checkbox elements
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');

            if (status == 'Tahap Seleksi') {
                var keteranganSeleksi = document.getElementById("keteranganSeleksi");
                if (val == 'Diterima') {
                    keteranganSeleksi.style.display = "none";
                    // Loop through each checkbox and uncheck it
                    checkboxes.forEach(function(checkbox) {
                        checkbox.checked = false;
                    });
                }
                if (val == 'Tidak Lolos Seleksi') {
                    keteranganSeleksi.style.display = "block";
                }
                if (val == "") {
                    keteranganSeleksi.style.display = "none";
                    // Loop through each checkbox and uncheck it
                    checkboxes.forEach(function(checkbox) {
                        checkbox.checked = false;
                    });
                }
            } else {
                var hideKet = document.getElementById("hideKet");
                if (val == 'Tidak Lolos Seleksi') {
                    hideKet.removeAttribute("hidden");
                } else {
                    hideKet.setAttribute("hidden", true);
                    // Loop through each checkbox and uncheck it
                    checkboxes.forEach(function(checkbox) {
                        checkbox.checked = false;
                    });
                }
            }

        }
    </script>
@endsection

@section('contents')
    <div class="container">
        <div class="d-flex justify-content-between mb-2">
            <h2>Daftar Semua Lamaran</h2>
        </div>
        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid"
            aria-describedby="sample_1_info">
            <thead>
                <tr role="row">
                    {{-- <th>Nama Pencaker</th> --}}
                    <th>Email Pencaker</th>
                    <th>Nama Lowongan</th>
                    <th>Posisi</th>
                    <th>Tempat Kerja</th>
                    <th>Tanggal Lamar</th>
                    <th>Status</th>
                    <th>Kompetensi</th>
                    <th>Gaji</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody id="myTable">
                @php
                    $i = 0;
                @endphp
                @foreach ($pencakers as $d)
                    <tr>
                        <td>{{ $d->users_email }}</td>
                        <td>{{ $d->lowongan->nama }}</td>
                        <td>{{ $d->lowongan->posisi }}</td>
                        <td>{{ $d->lowongan->kota }}</td>
                        <td>{{ $d->tanggal_pelamaran }}</td>
                        <td>{{ $d->status }}</td>
                        @if ($pelatihans[$i] != null)
                            @if ($pelatihans[$i]->hasil_kompetensi == null)
                                <td>-</td>
                            @else
                                <td>{{ $pelatihans[$i]->hasil_kompetensi }}</td>
                            @endif
                        @else
                            <td>-</td>
                        @endif
                        <td>{{$d->gaji}}</td>
                        <td>{{ $d->keterangan }}</td>
                        @if ($d->status == 'Tidak Lolos Seleksi' || $d->status == 'Diterima')
                        <td>
                            <div class="text-center">
                                <a href="#modalEditStatus" data-toggle="modal" class="btn btn-sm btn-secondary"
                                    onclick="modalEditStatus({{ $d->Id }})">
                                    <i class="fas fa-eye">
                                    </i>
                                    Status
                                </a>
                            </div>
                        </td>
                        @else
                        <td>
                            <div class="text-center">
                                <a href="#modalEditStatus" data-toggle="modal" class="btn btn-sm btn-primary"
                                    onclick="modalEditStatus({{ $d->Id }})">
                                    <i class="fas fa-pen">
                                    </i>
                                    Status
                                </a>
                            </div>
                        </td>
                        @endif
                    </tr>

                    @php
                        $i++;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="modalEditStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">

        </div>
    </div>
@endsection
