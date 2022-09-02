<form method="POST" action="{{ url('soal/'.$data->id)}}">
  @csrf
    @method("PUT")
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>    
    
        <h5 class="modal-title" id="mediumModalLabel"><strong>Edit Pertanyaan</strong></h5>  
        <input type="hidden" name='old_creator' value="{{$data->created_by}}"> 
        <input type="hidden" name='old_id' value="{{$data->id}}">
    </div>
    
 {{--   @foreach($data as $d) --}}
    <div class="modal-body">
      <div class="form-group">
        <label for="pertanyaan">Pertanyaan</label>
        <textarea name="pertanyaan" class="form-control" rows="3" placeholder="Masukkan Pertanyaan" required>{{ $data->pertanyaan }}</textarea>
      </div>
    
      <div class="form-group">
        <div class='row'>
          <div class='col-md-8'>
            <label for="jawaban">Jawaban</label>
          </div>
        </div>

        @for($i = 0; $i<=3; $i++)
          <div class='row'>
            <div class='col-md-8'>
              <input type="text" class="form-control" id="jawaban" name="jawaban[{{ $i }}]" value="{{ $jawaban[$i]->jawaban }}" placeholder="Masukkan Pilihan {{ ($i+1) }}" required>
            </div>
            <div class="col-md-4">
              <select class="form-control" name="kejuruan[{{ $i }}]" required>
              {{-- Belum fix. Tinggal di looping lagi sesuai table kejuruans --}}
                <option value="">-Pilih Klaster-</option>
               @foreach($namaKlaster as $klaster)
                  <option value='{{ $klaster->id }}' {{ $jawaban[$i]->klaster_id == $klaster->id ? 'selected':'' }}>{{ $klaster->nama }}</option>
                @endforeach
                
              </select>
            </div>
          </div><br>
        @endfor
      </div>
    
   {{--  @endforeach --}}
  </div>
  <div class="modal-footer">
      <button type="submit" class="btn btn-primary pull-right">Simpan</button>
    </div>
</form>