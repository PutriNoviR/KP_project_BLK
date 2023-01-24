@extends('layouts.adminlte')
@section('title')
Detail Peserta Pelatihan MTU
@endsection

@section('javascript')

<script>
    $(document).ready(function() {
        $("#myTable").DataTable({
            "responsive": true,
            "autoWidth": false,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print',
                {
                    extend: 'pdfHtml5',
                    customize: function(doc) {
                        doc.content.splice(1, 0);
                        var logo = 'data:image/png;base64,' + '<?= base64_encode(file_get_contents('https://seeklogo.com/images/J/jawa-timur-logo-24818906D1-seeklogo.com.png')) ?>'
                        doc.pageMargins = [20, 100, 20, 30];
                        doc['header'] = (function() {
                            return {
                                columns: [{
                                        image: logo,
                                        width: 45
                                    },
                                    {
                                        alignment: 'center',
                                        text: '',
                                        fontSize: 18,
                                        margin: [10, 0]
                                    },
                                ],
                                margin: 20
                            }
                        });

                    },
                    exportOptions: {
                        columns: [0, 1, 2, 3, 5]
                    }
                },
                'colvis'
            ]
        });
    });

    function alertShowKtp(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("mtuPesertas.getDetailKtp") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id,
            },
            success: function(data) {
                Swal.fire({
                    title: "Ktp",
                    imageUrl: "{{ asset('storage/') }}/"+data.data,
                    imageHeight: 800,
                    imageWidth: 1300,
                    width: 1300,
                })
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    }

    function alertShowIjazah(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("mtuPesertas.getDetailIjazah") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id,
            },
            success: function(data) {
                Swal.fire({
                    title: "Ijazah",
                    imageUrl: "{{ asset('storage/') }}/"+data.data,
                    imageHeight: 800,
                    imageWidth: 1300,
                    width: 1300,
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

<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Detail Peserta Pelatihan</h2>
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
                <th>Ktp</th>
                <th>Ijazah</th>
                <th>Status Peserta</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($data as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->nama }}</td>
                <td>{{ $d->no_hp }}</td>
                <td> <a href="{{ url('storage/'.$d->ktp) }}" class="btn btn-primary" download="KTP_{{Auth::user()->email."_".$d->ktp}}"><i class="fas fa-id-card"></i> &nbsp;CETAK KTP</a>
                    <a href hidden id="download-file"></a>
                    <button class='btn btn-info' onclick="alertShowKtp({{$d->id}})">
                        <i class="fas fa-eye"> KTP </i>
                    </button>
                </td>
                <td>
                    <a href="{{ url('storage/'.$d->ijazah) }}" class="btn btn-success" download="IJAZAH_{{Auth::user()->email."_".$d->ijazah}}"><i class="fas fa-id-card"></i> &nbsp;CETAK IJAZAH</a>
                    <a href hidden id="download-file"></a>
                    <button class='btn btn-info' onclick="alertShowIjazah({{$d->id}})">
                        <i class="fas fa-eye"> IJAZAH </i>
                    </button>
                </td>
                <td>{{ $d->status }}</td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection