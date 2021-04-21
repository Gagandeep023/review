<h1>User Login</h1>

<form action="users" method = "post">
    <!-- {{method_field('put')}} -->
    <!-- {{ csrf_field() }} -->
    @csrf
    <input type="text" name = "user" placeholder="enter name"> <br> <br>
    <input type="password" name = "password" placeholder="enter pasword"> <br> <br>
    <button type = "submit">Login</button>
</form>