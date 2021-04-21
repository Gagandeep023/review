<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <meta http-equiv = "X-UA-Compatible" content="ie=edge">
    <title>Profile Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
<body>
    
    <div class="container">
        <div class = "row" style="margin-top:45px">
            <div class="col-md-4 col-md-offset-4">
            <h1>User Profile</h1>
                <table class="table table-hover">
                <thead>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                </thead>

                <tbody>
                    <td>{{$LoggedUserInfo->name}}</td>
                    <td>{{$LoggedUserInfo->email}}</td>
                    <td><a href="logoutpage">Logout</a></td>
                </tbody>

                </table>
            </div>
        </div>
    
    </div>

</body>
</html>
