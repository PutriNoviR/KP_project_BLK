<form role="form" method="POST" action="{{ route('soal.update', $data->id) }}" enctype="multipart/form-data" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Edit Pertanyaan</h4>
  </div>
  @csrf
  @method('PUT')
  <div class="modal-body">
    <div class="form-body">
      <div class="form-group">
        <label>Pertanyaan</label>
        <input type="text" class="form-control" id="pertanyaan" name='pertanyaan' value="{{$data->pertanyaan}}">
      </div>
      <div class="form-group">
        <label>Jawaban</label>
        <input type="text" class="form-control" id="jawaban" name='jawaban' value="{{$data->jawaban}}">
      </div>
      
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-info">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
</form>