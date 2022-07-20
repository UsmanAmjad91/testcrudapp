<!doctype html>
<html lang="en">
  <head>
    <title>Register</title>
    <!-- Required meta tags -->
     <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
 
  </head>
  <body>
      <form id="form" name="form" method="POST" action="javascript:void(0);">
       @csrf
                                        {{-- @if(Session::has('fail'))
                                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
           
                                        @endif --}}
                                        <input type="hidden" name="status" id="status" value="1" class="input">
      <label>
    <p class="label-txt">ENTER YOUR NAME</p>
    <input type="text" name="username" id="username" class="input">
    <div class="line-box">
      <div class="line"></div>
     
    </div>
    <h6 id="usernamecheck"></h6>
  </label>
  <label>
    <p class="label-txt">ENTER YOUR EMAIL</p>
    <input type="email" name="email" id="email" class="input">
    <div class="line-box">
      <div class="line"></div>
     
    </div>
     <h6 id="emailcheck"></h6>
  </label>
  
  <label>
    <p class="label-txt">ENTER YOUR PASSWORD</p>
    <input type="password" name="password" id="password" class="input">
    <div class="line-box">
      <div class="line"></div>
     
    </div>
     <h6 id="passwordcheck"></h6>
  </label>
  <label>
    <p class="label-txt">Confirm PASSWORD</p>
    <input type="password" name="confirmpassword" id="confirmpassword" class="input">
    <div class="line-box">
      <div class="line"></div>
    </div>
     <h6 id="confirmcheck"></h6>
  </label>
  <button type="submit" id="adduser" name="adduser">submit</button>

  <h6 class="acc">If you already register <a href="{{url('/signin')}}" style="text-decoration: none;">Login</a></h6>
</form>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="{{asset('js/custom.js')}}"></script>
  </body>
</html>