<!DOCTYPE html>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
@if(Session::has('sucess'))
<div class='alert alert-success' role='alert'>
  {{Session::get('sucess')}}
<div>
  @endif
<form method="POST" action="{{url('save-user')}}">
    @csrf
    
    <div class="form-group">
    <label for="name">name</label>
    <input type="text" class="form-control" id="name" name='name'  placeholder="Enter name">
   
  </div>
  <div class="form-group">
    <label for="email">email</label>
    <input type="email" class="form-control" id="email" name='email' aria-describedby="emailHelp" placeholder="Enter email">
   
  </div>
  <div class="form-group">
    <label for="contact">Contact</label>
    <input type="text" class="form-control" id="contact" name='contact'  placeholder="Enter contact">
   
  </div>
  <div class="form-group">
    <label for="address">address</label>
    <input type="text" class="form-control" id="address" name='address'  placeholder="Enter address">
   
  </div>
  <div class="form-group">
    <label for="password">password</label>
    <input type="text" class="form-control" id="password" name='password'  placeholder="Enter password">
   
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</html>