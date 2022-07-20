<!DOCTYPE html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
     <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>dashboard</title>
        <!-- Favicon-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
        <link href="{{asset('style/bootstrap.css')}}" rel="stylesheet" />
        <link href="{{asset('style/datatables.min.css')}}" rel="stylesheet" />
        <link href="{{asset('style/datatables.css')}}" rel="stylesheet" />
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
        <script src="{{asset('jquery/jquery.js')}}"></script>
        
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
            <div class="container">
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{Session('username')}}</a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal"><a href="javascript:void(0);" data-id="{{Session('admin_id')}}" style="text-decoration: none;color:red">
  Update Profile</a>
</button></li>
                                <li><hr class="dropdown-divider" /></li>
                                 <li><button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#passwordModal"><a href="javascript:void(0);" data-id="{{Session('admin_id')}}" style="text-decoration: none;color:rgb(12, 13, 12)">
  Change Password</a>
</button></li>
                                <li><a class="dropdown-item" href="{{url('logout')}}">LogOut</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Button trigger modal -->

<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Update Account</h5>
        
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      
      <form id="formupdate" name="formupdate" method="POST" action="javascript:void(0);">
       @csrf
      
        @if(!empty($admin))
                @foreach($admin as $row)
               
        <div class="modal-body">
        <div class="form-group">
            <label for="name1">Username</label>
            <input type="text" class="form-control" value="{{$row->username}}" name="username" id="username" aria-describedby="nameHelp" placeholder="Enter Name">
          <h6 id="usernameupdate"></h6>
          </div>
          <div class="form-group">
            <label for="email1">Email address</label>
            <input type="email" class="form-control" value="{{$row->email}}" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
          <h6 id="emailupdate"></h6>
          </div>
          {{-- <div class="form-group">
            <label for="password">Password</label>
          
            <input type="password" class="form-control" value="{{$row->password}}" id="password" name="password" placeholder="Password">
          <h6 id="passwordupdate"></h6>
          </div> --}}
          <div class="form-group">           
           <input type="hidden" class="form-control" value="{{$row->admin_id}}" id="admin_id" name="admin_id">
        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
          <button type="submit" id="updateuser" name="updateuser" class="btn btn-success">Upate</button>
        </div>
        </div>
          @endforeach
                @endif
      </form>
    </div>
  </div>
</div>

<!-- Modal -->

<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">change Password</h5>
        
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      
      <form id="formchange" name="formchange" method="POST" action="javascript:void(0);">
       @csrf
        <div class="modal-body">
        <div class="form-group">
            <label for="name1">Current Password</label>
            <input type="password" class="form-control"  name="oldpassword" id="oldpassword" aria-describedby="nameHelp" placeholder="Old Password">
          <h6 id="oldpasswordcheck"></h6>
          </div>
          <div class="form-group">
            <label for="email1">New Password</label>
            <input type="password" class="form-control"  id="newpassword" name="newpassword" aria-describedby="emailHelp" placeholder="Enter New Password">
          <h6 id="newpasswordcheck"></h6>
          </div>
          <div class="form-group">
            <label for="password">Confirm Password</label>
          
            <input type="password" class="form-control"  id="confirmnew" name="confirmnew" placeholder="Confirm NEW Password">
          <h6 id="confirmnewcheck"></h6>
          </div>
           @if(!empty($admin))
                @foreach($admin as $row)
          <div class="form-group">           
           <input type="hidden" class="form-control" value="{{$row->admin_id}}" id="admins_id" name="admins_id">
        </div>
            @endforeach
                @endif
        <div class="modal-footer border-top-0 d-flex justify-content-center">
          <button type="submit" id="changepass" name="changepass" class="btn btn-success">Change Password</button>
        </div>
        </div>
         
      </form>
    </div>
  </div>
</div>