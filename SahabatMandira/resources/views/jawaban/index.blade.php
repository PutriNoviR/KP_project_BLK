@extends('layouts.index')

@section('title')
    Menu Jawaban
@endsection


@section('contents')
<!-- List Soal, Tombol Tambah Soal dan Tombol Edit Soal sama lihat hasil tes -->
<br>

<h4 class="text-center">List Jawaban</h4>
<a href="{{url('soal/create')}}" data-toggle='modal' class='btn btn-info'> Tambah Jawaban </a><br><br>

<div class="table-responsive">
    <table id="myTable" class="table">
        <thead>
            <tr>
                <th> ID </th>
                <th> Jawaban </th>
                <th> Pertanyaan </th>

                
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key=> $item)
            <tr class="{{ ($key % 2 === 0) ? 'active' : 'success' }}">
            
            <td scope="row">{{ $item-> id}}</td>
            <td>
            </td>
            <td>{{ $item->pertanyaan->pertanyaan}}</td>
            <td>
                <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-xs' onclick="getEditForm({{$item->id}})">
                Edit
                </a>
          
                <form method='POST' action="{{ route('jawaban.destroy',$item->idanswers) }}">
                @csrf
                @method('DELETE')
                <input type="submit" value="delete" class='btn btn-danger btn-xs' onclick="if(!confirm('are you sure to delete this record ?')) return false;">
                </form>


                <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                     <div class="modal-content" id='modalContent'></div>
                    </div>
                </div>   
            </td>
        </tr>

@endsection
</tbody>
</table>
</div>