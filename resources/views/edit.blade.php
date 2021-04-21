<h1>Update Member</h1>
<form action="/edit" method = "post">
    @csrf
    <input type="hidden" name = "id" value="{{$data['id']}}"> <br> <br>

    <input type="text" name = "username" value="{{$data['username']}}"> <br> <br>
    <input type="password" name = "password" value="{{$data['password']}}"> <br> <br>
    <input type="text" name = "name" value="{{$data['name']}}"> <br> <br>
    <input type="text" name = "email" value="{{$data['email']}}"> <br> <br>
    <button type = "submit">Submit</button>
</form>
