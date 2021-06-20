@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="custom-bc" >
  <ol class="breadcrumb"  >
  <li class="breadcrumb-item"><a href="{{ route('common') }}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('showAllUsers') }}">Users</a></li>   
  </ol>
</nav>
<div class="container">
    <div class="row justify-content-center">  
        <h2>Users List</h2>   
        <div class="col-md-12" style="background-color:light;padding-top:10px;padding-bottom:10px"> 
        <form class="form-inline">
            <input class="form-control mr-2" placeholder="Name" style="padding-left:2px" type="text" name="name" id="name" />
            <input class=" form-control mr-2"  placeholder="Email"  type="text" name="email" id="email" />          
            <input class="form-control mr-2"  placeholder="Created From Date"  type="text" name="created_from_date" id="created_from_date" />
            <input class="form-control mr-2"  placeholder="Created To Date"  type="text" name="created_to_date" id="created_to_date" />
            <a  name="search" id="btn-search" class="btn btn-large btn-info mr-2">Search</a>
            <a  href="{{route('createUser')}}" name="add" id="btn-add" class="btn btn-large btn-info">Add</a>        
        </form>
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
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Created User Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Birthday</th>
                        <th scope="col">Address</th>
                        <th scope="col">Created Date</th>
                        <th scope="col">Updated Date</th>
                        <th scope="col"></th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($userData as $key=>$data)
                    <tr>
                    
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
            
            </div>
        </div>        
    </div>
</div>
@endsection