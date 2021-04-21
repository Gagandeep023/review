<h1>User Login</h1>
@if(session('name'))
<h3 style = "color: green">{{session('name')}} user has been added</h3>
@endif
<form action="addmember" method = "post">
   
    @csrf
    <input type="text" name = "username" placeholder="enter username"> <br> <br>
    <input type="password" name = "password" placeholder="enter password"> <br> <br>
    <input type="text" name = "name" placeholder="enter name"> <br> <br>
    <input type="text" name = "email" placeholder="enter email"> <br> <br>
 
    <button type = "submit">Add Member</button>
</form>
