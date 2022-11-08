<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalRiwayatInstukturLabel">Riwayat Mentoring Instruktur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        {{-- <h1>Riwayat Instuktur</h1> --}}
        <ul class="list-group">
            @if (count($pelatihan_mentor)>0)
            @foreach ($pelatihan_mentor as $p)
            <li class="list-group-item">{{ $p}}</li>
            @endforeach
            @else
            <h1>Tidak Ada Riwayat Instuktur</h1>
            @endif
        </ul>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal"
            data-target="#modalTambahInstruktur">Kembali</button>
    </div>
</div>
