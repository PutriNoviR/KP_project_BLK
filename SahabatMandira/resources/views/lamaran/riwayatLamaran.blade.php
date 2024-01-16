<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalEditStatus">Riwayat Lamaran {{ $email }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <br>
        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable2" role="grid"
            aria-describedby="sample_1_info">
            <thead>
                <tr>
                    <th>Nama Perusahaan</th>
                    <th>Posisi</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayat as $item)
                    <tr>
                        <td>{{ $item->lowongan->perusahaan->nama }}</td>
                        <td>{{ $item->lowongan->posisi }}</td>
                        <td>{{ $item->tanggal_pelamaran }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table><br>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
    </div>
</div>


<script>
    $('#myTable2').dataTable({
        "order": [3, 'desc']
    });
</script>
