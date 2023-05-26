<!DOCTYPE html>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
    
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<div  id=suces></div>

<nav class="navbar navbar-light bg-light">
  <form class="form-inline" type='get' action="{{url('/search')}}">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name='query'>
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav>
<div style='margin-right'>
<a href="{{url('add-user')}}" class="link-warning"> add</a>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">name</th>
      <th scope="col">E-mail</th>
      <th scope="col">Address</th>
      <th scope="col">edit     </th>
      <th scope="col">delete </th>
  </thead>
  <tbody>
    @foreach($user as $users)
    <tr>
      <th scope="row">{{$users->name}}</th>
      <td>{{$users->email}}</td>
      <td>{{$users->address}}</td>
      <td><a href="{{url('edit-student/'.$users->id)}}">edit</a></td>
      <td>
        <button class='btn btn-sm btn-danger' data-id='{{$users->id}}' id='deletecountrybtn'>delete</button>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{$user->onEachSide(1)->links()}}
<script>
      
      $(document).ready(function () {


$(document).on('click','#deletecountrybtn',function(){
var id = $(this).data('id');
// alert(id);
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

$.ajax({
  type:"DELETE",
  url:"/delete-student/"+id,
  success:function (response) {
    console.log(response);
    $('#suces').html(response.message);
  }
})


});

});
</script>
</html>
