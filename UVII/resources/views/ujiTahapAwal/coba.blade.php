<div class="body_test">
    @foreach($dataSoal as $key => $data)
        <div class="soal">
           <p> {{ $dataSoal->firstItem() + $key }}. {{ $data->pertanyaan }}</p>
           <input type="hidden" name="" value="{{ $data->id }}"> 
        </div>

        <div class="row_pilihan">

            @foreach($data->find($data->id)->jawaban->shuffle() as $pilihan)
            <div class="pilihan">
                
                <label>
                    <input type="radio" name="" value="{{ $pilihan->idanswers }}"> 
                    {{ $pilihan->jawaban }}
                </label>
            </div>
           
            @endforeach
        </div>
        
@endforeach 
        {{--@endfor--}}
</div>
<div>
    {{ $dataSoal->links() }}
</div>