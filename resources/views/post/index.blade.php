@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="custom-bc" >
  <ol class="breadcrumb"  >
  <li class="breadcrumb-item"><a href="{{ route('common') }}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('showAllPosts') }}">Posts</a></li>   
  </ol>
</nav>
<div class="container">
    <div class="row justify-content-center">  
        <h2>Posts</h2>   
        <div class="col-md-11" style="background-color:light;padding-top:10px;padding-bottom:10px"> 
            <input  style="padding-left:5px" type="text" name="search" id="txt-search" />
            <a  name="search" id="btn-search" class="btn btn-large btn-info"><i class="bi bi-search"></i>&nbsp;&nbsp;Search</a>          
            <a  name="upload" id="btn-upload" class="btn btn-large btn-info"><i class="bi bi-upload"></i>&nbsp;&nbsp;Upload</a>
            <a  name="download" id="btn-download" class="btn btn-large btn-info"><i class="bi bi-download"></i>&nbsp;&nbsp;Download</a>
            <a  href="{{route('create')}}" name="add" id="btn-add" class="btn btn-large btn-info"><i class="bi bi-plus-circle"></i>&nbsp;&nbsp;Add</a>    
        
        </div>
        
        @if ($message = Session::get('success'))
        <div class="col-md-11 alert alert-success">
            <p>{{ $message }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
      
        <div class="container mt-2">
            <table class="table table-striped table-responsive-sm table-bordered mb-5">
                <thead>
                    <tr class="table-success">
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Posted User</th>
                        <th scope="col">Posted Date</th>
                        <th scope="col" ></th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($postData as $key=>$data)
                    <tr>
                        <th scope="row" style="width:1px; white-space:nowrap;">{{ ++$i}}</th>
                        <td><a href="#" data-toggle="modal" data-target="#postModal">{{ $data->title }}</a></td>
                        <td>{{ \Str::limit($data->description,50) }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{date_format($data->created_at,'Y-m-d')}} </td>
                        <td style="width:1px; white-space:nowrap;">
                            <form action="{{route('deletePost',$data->id)}}" method="POST">                               
                            <a class="btn btn-sm btn-success" href="{{ route('editPost',$data->id) }}">Edit</a>   
                            @csrf                                
                            <input type="submit" class="btn btn-sm btn-danger" value="Delete"/>
                            </form>
                        </td>                       
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
            {{$postData->links()}}
            </div>
        </div>        
    </div>
</div>
	



<!-- Modal -->
<div class="modal fade " id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Post Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">       
        <div class="form-group input-group">
          <label for="">Title :&nbsp;</label>
          <label> $post->title</label>
        </div>
        <div class="form-group input-group">
          <label for="">Description:</label>
          <label class='col-md-10'> $post->description</label>
        </div>
        <div class=" input-group">
          <label for="status">Status : &nbsp;</label>
          <label for="">Active</label>
        </div>
        <div class="input-group">
          <label for="">Created User : &nbsp;</label>
          <label> Mu Mu</label>
        </div>         
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<!-- End Modal-->

@endsection
