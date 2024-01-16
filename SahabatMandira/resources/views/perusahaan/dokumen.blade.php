@extends('layouts.adminlte')

@section('title')
    Daftar Dokumen Perusahaan
@endsection

@section('javascript')
    <script>
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
    </script>
@endsection

@section('contents')
<h1> Daftar Perusahaan yang perlu divalidasi</h1>

@if (\Session::has('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{!! \Session::get('success') !!}",
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the previous page after the user clicks "OK"
                window.location.href = document.referrer;
            }
        });
    </script>
@endif


    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid"
        aria-describedby="sample_1_info">
        <thead>
            <tr role="row">
                <th>Nama Perusahaan</th>
                <th>Dokumen</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach ($perusahaan as $p)
                <tr>
                    <td>{{ $p->nama }}</td>
                    <td>
                        <table style="width: 100%">
                            @foreach ($p->Dokumen as $d)
                                <tr>
                                    <td>
                                        {{ $d->nama }}
                                    </td>
                                    <td>
                                        <a href="{{ route('download', $d->nama . '^' . $d->value) }}">{{ $d->value }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </td>
                    <td>
                        <div class="text-center">
                            <a class="btn btn-sm btn-primary" href="{{ route('perusahaan.validasi', $p->id ) }}">
                                VALIDASI
                            </a>

                            {{-- <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $p->email }}&su=subject_here&body=body_here">Send Email</a> --}}

                            <button class="btn btn-sm btn-warning" onclick=" window.open('https://mail.google.com/mail/?view=cm&fs=1&to={{ $p->email }}&su=Validasi Dokumen&body=')">Kirim Email</button>

                        </div>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
