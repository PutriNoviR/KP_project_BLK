@extends('layouts.adminlte')

@section('title')
    Data Semua Perusahaan
@endsection

@section('javascript')
    <script>
        $(function() {
            $("#myTable").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
@endsection

@section('contents')
    <h1> Data Semua Perusahaan</h1>
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid"
        aria-describedby="sample_1_info">
        <thead>
            <tr role="row">
                <th style="width: 40%">Nama Perusahaan</th>
                <th>Dokumen</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach ($perusahaan as $p)
                <tr>
                    <td>{{ $p->nama }}</td>
                    <td>
                        <table style="width: 100%">
                            
                        @foreach ($p->dokumen as $pd)

                        <tr>
                            @if ($pd->nama == 'NIB')
                                <td><p>NIB : {{ $pd->value }}</p></td>
                            @else
                              <td><p>{{ $pd->nama }} : <a href="files/{{ $pd->nama . '^' . $pd->value }}">
                                    {{ $pd->value }}</a></p></td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

<script>
    function NIB(pesan) {
        console.log(pesan);

    }
</script>
