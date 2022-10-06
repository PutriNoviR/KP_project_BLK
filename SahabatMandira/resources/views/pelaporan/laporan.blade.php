@extends('layouts.adminlte')
@section('title')
Pelaporan
@endsection

@section('javascript')
<script>
    $(function() {
        $("#myTable").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });

    function alertShow(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("sesiPelatihan.getDetail") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id,
            },
            success: function (data) {
                swal({
                    title: "Aktivitas",
                    text: data.data,
                })
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    }
</script>
@endsection

@section('contents')
<!-- Tabs navs -->
<ul class="nav nav-tabs nav-justified mb-3" id="ex1" role="tablist">
    <li class="nav-item" role="presentation">
      <a
        class="nav-link active"
        id="ex3-tab-1"
        data-mdb-toggle="tab"
        href="#ex3-tabs-1"
        role="tab"
        aria-controls="ex3-tabs-1"
        aria-selected="true"
        >Daftar peserta</a
      >
    </li>
    <li class="nav-item" role="presentation">
      <a
        class="nav-link"
        id="ex3-tab-2"
        data-mdb-toggle="tab"
        href="#ex3-tabs-2"
        role="tab"
        aria-controls="ex3-tabs-2"
        aria-selected="false"
        >Peserta lolos seleksi</a
      >
    </li>
    <li class="nav-item" role="presentation">
      <a
        class="nav-link"
        id="ex3-tab-3"
        data-mdb-toggle="tab"
        href="#ex3-tabs-3"
        role="tab"
        aria-controls="ex3-tabs-3"
        aria-selected="false"
        >Peserta berkompeten</a
      >
    </li>
    <li class="nav-item" role="presentation">
        <a
          class="nav-link"
          id="ex3-tab-3"
          data-mdb-toggle="tab"
          href="#ex3-tabs-3"
          role="tab"
          aria-controls="ex3-tabs-3"
          aria-selected="false"
          >Peserta cadangan</a
        >
      </li>
  </ul>
  <!-- Tabs navs -->
  
  <!-- Tabs content -->
  <div class="tab-content" id="ex2-content">
    <div
      class="tab-pane fade show active"
      id="ex3-tabs-1"
      role="tabpanel"
      aria-labelledby="ex3-tab-1"
    >
      Tab 1 content
    </div>
    <div
      class="tab-pane fade"
      id="ex3-tabs-2"
      role="tabpanel"
      aria-labelledby="ex3-tab-2"
    >
      Tab 2 content
    </div>
    <div
      class="tab-pane fade"
      id="ex3-tabs-3"
      role="tabpanel"
      aria-labelledby="ex3-tab-3"
    >
      Tab 3 content
    </div>
  </div>
  <!-- Tabs content -->
@endsection