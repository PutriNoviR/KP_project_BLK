<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalRiwayatInstukturLabel">Riwayat Instruktur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        {{-- <h1>Riwayat Instuktur</h1> --}}
        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid" aria-describedby="sample_1_info">
            <thead>
                <tr role="row">
                    <th>No</th>
                    <th>Email Mentor</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if(count($data)>0)
                    @foreach ($data as $d)
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $d->mentors_email}}</td>
                    <td>
                        <form method="POST" action="{{ route('pelatihanMentors.destroy',$d->mentors_email) }}" onsubmit="return submitFormDelete(this);" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="id_sesi" value="{{ $id_sesi }}">
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> &nbsp; Hapus</button>
                        </form>
                    </td>
                    @endforeach
                @endif
            </tbody>
        </table>
        <ul class="list-group">
            
        </ul>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal"
            data-target="#modalTambahInstruktur">Kembali</button>
    </div>
</div>
