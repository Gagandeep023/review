<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <meta http-equiv = "X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
<body>
    
    <div class="container">
        <div class = "row" style="margin-top:45px">
            <div class="col-md-4 col-md-offset-4">
            <h1>User Login</h1>

                     
                <form action="{{ route('auth.check') }}" method = "post" >
                    @csrf
                    <div class="results">
                        @if(Session::get('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                        @endif   

                        @if(Session::get('fail'))
                            <div class="alert alert-danger">
                                {{Session::get('fail')}}
                            </div>
                        @endif  
                    </div>
                    <div class="form-group"> 
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name = "email" placeholder="enter email"
                        value="{{old('email')}}"> 
                        <span class="text-danger">@error('email'){{ $message }}@enderror</span> 
                    </div>

                    <!-- <input type="text" name = "user" placeholder="enter name"> <br> <br> -->
                    <div class="form-group"> 
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name = "password" placeholder="enter pasword"
                        value="{{old('password')}}"> 
                        <span class="text-danger">@error('password'){{ $message }} @enderror</span> 
                    </div>
                    

                    <div class="form-group"> 
                        <button type = "submit" class="btn btn-block btn-primary">Login</button>
                    </div>
                    <br>
                    <a href="register">Create an new Account now!</a>
                    <br>
                    <a href="/forget-password">Forgot Password</a>
                </form>
            </div>
        </div>
    
    </div>

</body>
</html>
