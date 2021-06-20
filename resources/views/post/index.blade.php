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
            <a  name="search" id="btn-search" class="btn btn-large btn-info">Search</a>          
            <a  name="upload" id="btn-upload" class="btn btn-large btn-info">Upload</a>
            <a  name="download" id="btn-download" class="btn btn-large btn-info">Download</a>
            <a  href="{{route('create')}}" name="add" id="btn-add" class="btn btn-large btn-info">Add</a>        
        
        </div>
        
        @if ($message = Session::get('success'))
        <div class="col-md-11 alert alert-success">
            <p>{{ $message }}</p>
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
                        <td><a href="#postDetail" data-toggle="modal" data-target="#postDetail">{{ $data->title }}</a></td>
                        <td>{{ \Str::limit($data->description,50) }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{date_format($data->created_at,'Y-m-d')}} </td>
                        <td style="width:1px; white-space:nowrap;">
                            <form action="{{route('deletePost',$data->id)}}" method="POST">                               
                            <a class="btn btn-sm btn-warning" href="{{ route('updatePost',$data->id) }}">Edit</a>   
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
	




@endsection
