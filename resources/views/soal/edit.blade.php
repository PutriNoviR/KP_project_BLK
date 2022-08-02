<form method="POST" action="{{ route('soal.edit',$id)}}">
 
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>    
    
        <h5 class="modal-title" id="mediumModalLabel"><strong>Edit Pertanyaan</strong></h5>   
    </div>
    @csrf
    @method("PUT")
    @foreach($data as $d){
    <div class="modal-body">
      <div class="form-group">
        <label for="pertanyaan">Pertanyaan</label>
        <textarea name="pertanyaan" class="form-control" rows="3" placeholder="Masukkan Pertanyaan" required>{{ $d->pertanyaan }}</textarea>
      </div>
    
      <div class="form-group">
        <div class='row'>
          <div class='col-md-8'>
            <label for="jawaban">Jawaban</label>
          </div>
          <div class="col-md-4">
            <label for="kejuruan">Kejuruan</label>
          </div>
        </div>

      {{--  @for($i = 0; $i<=4; $i++)
          <div class='row'>
            <div class='col-md-8'>
              <input type="text" class="form-control" id="jawaban" name="jawaban[{{ $i }}]" value="{{ $jawaban->jawaban }}" placeholder="Masukkan Pilihan {{ ($i+1) }}" required>
            </div>
            <div class="col-md-4">
              <select class="form-control" name="kejuruan[{{ $i }}]" required>
              {{-- Belum fix. Tinggal di looping lagi sesuai table kejuruans --}}
                <option value="">-Pilih Kejuruan-</option>
                <option value=1 {{$jawaban->kejuruans_id == 1? "selected":""}}>Kejuruan 1</option>
                <option value=2 {{$jawaban->kejuruans_id == 2? "selected":""}}>Kejuruan 2</option>
                <option value=3 {{$jawaban->kejuruans_id == 3? "selected":""}}>Kejuruan 3</option>
                <option value=4 {{$jawaban->kejuruans_id == 4? "selected":""}}>Kejuruan 4</option>
                <option value=5 {{$jawaban->kejuruans_id == 5? "selected":""}}>Kejuruan 5</option>
              </select>
            </div>
          </div><br>
        @endfor
      </div>
    
      @endforeach--}}
      <button type="submit" class="btn btn-primary">Submit</button>
   {{-- </div>--}}
</form>