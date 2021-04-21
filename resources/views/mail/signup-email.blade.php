Hello {{$email_data['name']}}
<br><br>
Welcome to FaangMock
<br>
Please click the below link to verify your email and activate your accoUnt!
<br><br>
<a href="http://localhost:9000/verify?code={{$email_data['verification_code']}}">Click Here</a>

<br><br>
Thank you!
<br>
Team FaangMock