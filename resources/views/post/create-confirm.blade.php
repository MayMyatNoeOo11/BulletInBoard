@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="custom-bc" >
  <ol class="breadcrumb"  >
    <li class="breadcrumb-item"><a href="{{ route('showAllPosts') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('showAllPosts') }}">Posts</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
  </ol>
</nav>

<div class="justify-content-center col-md-12" style="padding-left:10em" > 
<h3>Create Post Confirmation </h3>
</div>


<form name="confirmPostForm" id="confirmPostForm" method="post" action="{{route('confirmPost')}}">
                    @csrf

                    <input type="hidden" id="title" name="title" value="{{$post->title}}" >
                    <input type="hidden" id="description" name="description" value=" {{$post->description}}" >
<div class="row">

<div class="col-md-1"></div>
  <div class="col-md-1"  style="background-color:skyblue">
      <label  for="title" style="margin-top:10px;"><strong>Title :</strong></label>
  </div>
  <div class="col-md-9"  style="background-color:#dee2e6">
    <span><strong><h4  style="padding-top:10px;" >{{$post->title}}</h4></strong></span>
  </div>
</div>

<div class=" row" >
<div class="col-md-1"></div>
  <div class="col-md-1" style="background-color:skyblue">
    <label for="description" ><strong>Description:</strong></label>
  </div>
  <div class="col-md-9" style="background-color:#dee2e6">
    <p id="description" name="description" > {{$post->description}}</p>
  </div>
</div>

<div class="row" style="padding-top:8px">
<div class="col-md-5"></div>
<div class="col-md-1" style="marign-right:5px">
  <button type="submit" class="btn btn-lg btn-success" >Create</button> 
    
</div>
<div class="col-md-1">
  <a class="btn btn-lg btn-danger" href="javascript:history.back()">Cancel</a> 
    
</div>
<div class="col-md-5"></div>
</div>
</form>
@endsection