@extends('layouts.app')
@section('menu')

@endsection
@section('content')
<div class="row">
    <div class="col-sm-2 col-md-2 col-lg-2">
        <nav aria-label="breadcrumb" class="custom-bc" >
            <ol class="breadcrumb"  >
                <li class="breadcrumb-item"><a href="{{ route('common') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('showAllPosts') }}">Posts</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>
    <div class=" mt-2 col-sm-8 col-md-8 col-lg-8">
             @if(session('msg'))
            <div class="alert alert-success">           
                <strong>{{ session('msg') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             @endif
    </div>
</div>            

<div class="container">
         <div class="container mt-1 col-md-12"> 
           
        <!-- card-->
            <div class="card" >
                <div class="card-header bg-info text-center font-weight-bold">
                    Update Post
                </div>
                <div class="card-body">
                    <form name="updatePostForm" id="updatePostForm" method="post" action="{{route('updatePost')}}">
                    @csrf

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="@error('title') is-invalid @enderror form-control" value="{{ $postData->title }}" required="Fill title">
                        @error('title')
                        <div class="alert alert-danger alert-dismissible">{{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea rows="8" name="description" class="@error('description') is-invalid @enderror form-control" required="">{{ $postData->description }}</textarea>
                        @error('description')
                        <div class="alert alert-danger alert-dismissible">{{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Active Status</label>             									
                        <input style="margin-left:20px" class=" form-check-input" type="checkbox" value="" id="status" {{ ($postData->status == 1 ? 'checked' : '')}}>			
                    </div>									
        
                    <button type="submit" class="btn btn-lg btn-success">Update</button>
                    <button type="reset" class="btn btn-lg">Clear</button>

                    </form>
                </div><!-- end cardbody-->
            </div><!-- end card-->
        </div>
        <div class="col-md-2">
        </div>    
</div>

@endsection