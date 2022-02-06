@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 600px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.po {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
  text-decoration: none
}

a.edit {
border: none;
  outline: 0;
  display: inline-block;
  padding: 20px;
  color: #fff;
  text-decoration: none;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 22px;
  height: 50px;
}

/* button:hover, a:hover {
  opacity: 0.7;
} */
p{
    font-size: 20px
}
.image_style{
  margin-left: 28%;
    border-radius: 70%;
    width: 40%;
}
</style>


  <div class="card">
    <img class="image_style" src="{{asset('storage/EmployeeProfileImages/'. Auth::user()->user_pp)}}" alt="John">
    <h1>{{Auth::user()->name}}</h1>
    <h1 class="po">{{Auth::user()->Djv_Group}}</h1>
    <p>{{Auth::user()->email}}</p>
    <p>{{Auth::user()->mobile}}</p>
    <div style="margin: 24px 0;">
      <a href="#"><i class="fa fa-dribbble"></i></a> 
      <a href="#"><i class="fa fa-twitter"></i></a>  
      <a href="#"><i class="fa fa-linkedin"></i></a>  
      <a href="#"><i class="fa fa-facebook"></i></a> 
    </div>
    <a href="{{url('employees/'. Auth::user()->id .'/edit')}}" class="edit btn btn-dark">Edit</a>
  </div>
@endsection
