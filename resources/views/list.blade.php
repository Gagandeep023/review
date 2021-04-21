<h1>Member List</h1>

<table border = "1" >
    <tr>
        <td>id</td>
        <td>username</td>
        <td>password</td>
        <td>name</td>
        <td>email</td>
        <td>operation</td>
        <td>update</td>
    </tr>
     @foreach($details as $detail)
    <tr>
        <td>{{$detail['id']}}</td>
        <td>{{$detail['username']}}</td>
        <td>{{$detail['password']}}</td>
        <td>{{$detail['name']}}</td>
        <td>{{$detail['email']}}</td>
        
        <td><a href={{"delete/".$detail['id']}}>Delete</a></td>
        <td><a href={{"edit/".$detail['id']}}>Edit</a></td>
    </tr>
    @endforeach 
    <a href="/add">add</a>
</table>
