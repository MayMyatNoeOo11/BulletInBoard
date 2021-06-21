@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="custom-bc" >
  <ol class="breadcrumb"  >
    <li class="breadcrumb-item"><a href="{{ route('showAllPosts') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('showAllPosts') }}">Posts</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
  </ol>
</nav>


<!-- <h3>Create Post Confirmation </h3> -->


  <div class="row mt-1">
    <div class="col-md-12">      
      <form action="{{route('confirmPost')}}" method="post">
      @csrf

    <input type="hidden" id="title" name="title" value="{{$post->title}}" >
    <input type="hidden" id="description" name="description" value=" {{$post->description}}" >  
    <div class="col-md-8 offset-md-2 mt-2">
        <div class="row card">
            <h4 class="text-center">Create Post Confirmation</h4>
            <div class="card-body confirm-bg-color">
                <div class="row mb-2">                    
                        <div class="row mb-3">
                            <div class="col-md-3">
                                Title :
                            </div>
                            <div class="col-md-9">
                            {{$post->title}}   
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                Description :
                            </div>
                            <div class="col-md-9">
                            {{$post->description}}
                            </div>
                        </div>    
                </div>
            </div>

        </div>
        <div class="row mt-2">
                <div class="col-md-4 offset-md-4">
                    <button type="submit" class="btn btn-success btn-md">
                        Confirm
                    </button>
                    <a class="btn  btn-danger btn-md" href="javascript:history.back()">Cancel</a>
                </div>
            </div>
    </div> 
      </form>
    </div>
  </div>



<!-- <form name="confirmPostForm" id="confirmPostForm" method="post" action="{{route('confirmPost')}}">
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
</form> -->
@endsection