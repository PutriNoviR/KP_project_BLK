<form method='POST' action="{{ url('testingDir/create') }}" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="id_dummy" value="2">
    <label for="dummyfile">Select Dummy File :</label><br>
    <input id="dummyfile" name="dummyfile" type="file" name="dummy_file">
    <br><hr>
    <button type="submit">SEND DATA</button>
</form>