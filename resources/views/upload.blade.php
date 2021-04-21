<h1>User Login</h1>

<form action="uploaded" method = "post" enctype ="multipart/form-data">
    <!-- {{method_field('put')}} -->
    <!-- {{ csrf_field() }} -->
    @csrf
    <input type="file" name = "file" > <br> <br>
    <button type = "upload">upload</button>
</form>