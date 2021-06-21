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
            <a  name="search" id="btn-search" class="btn btn-large btn-info mr-2"><i class="bi bi-search"></i>&nbsp;&nbsp;Search</a>
            <a  href="{{route('createUserForm')}}" name="add" id="btn-add" class="btn btn-large btn-info"><i class="bi bi-plus-circle"></i>&nbsp;&nbsp;Add</a>        
        </form>
        </div>
        
        <div class="container">
        <table class="table table-responsive table-bordered mb-5">
                        <thead>
                    <tr class="table-success">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Created User</th>
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
                        <td>{{++$k}}</td>
                        <td><a href="#" data-toggle="modal" data-target="#userModal">{{$data->name}}</a></td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->created_user_name}}</td>
                        <td>{{$data->phone}}</td>
                        <td>{{$data->date_of_birth}}</td>
                        <td>{{ \Str::limit($data->address,15) }}</td>
                        <td>{{date('Y-m-d', strtotime($data->created_at))}}</td>
                       <td>{{date('Y-m-d', strtotime($data->updated_at))}}</td>
                       
                       <td>
                       <form>
                        <a class="btn btn-success btn-sm" href="#">Edit</a>
                        <button class="btn btn-danger btn-sm" >delete</button>
                       </form>
                       </td>
                       
                        
                  
                   </tr>
                   @endforeach
                </tbody>
            </table>
            

            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
            {{$userData->links()}}

            </div>
        </div>        
    </div>
</div>

<!-- Modal -->
<div class="modal fade  " id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
        <table class="table">
          <tbody>
            <tr class="first" >
              <td ><label >Name :</label></td>
              <td >HTML</td>
              <td ></td>
            </tr>
            <tr>
              <td><label for="">Email :</label></td>
              <td>may@gmail.com</td>
              <td></td>
            </tr>
            <tr>
              <td><label for="">User Type:</label></td>
              <td>Admin</td>
              <td></td>
            </tr>
            <tr>
              <td><label for="">Date of Birth :</label></td>
              <td>12-03-1998</td>
              <td></td>
            </tr>
            <tr>
              <td><label for="">Profile :</label></td>
              <td><img class="profile_preview" src="{{URL::asset('/images/profile.jpeg')}}" id="preview_image"/></td>
            </tr>
            <tr>
              <td><label for="">Address :</label></td></td>
              <td><textarea>No E1 ShwePone Nyut Street,Yangon</textarea></td>
              <td></td>
            </tr>
            <tr>
              <td><label for="">Phone :</label></td></td>
              <td>09-798956236</td>
              <td></td>
            </tr>
            <tr>
              <td><label for="">Created User :</label></td></td>
              <td>User1</td>
              <td></td>
            </tr>
            <tr>
              <td><label for="">Created at :</label></td></td>
              <td>12-06-2021</td>
              <td></td>
            </tr>
            <tr class="last">
              <td><label for="">Updated at :</label></td></td>
              <td>12-12-2020</td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
        
      </div>
    </div>
  </div>
</div>
<!-- End Modal-->
@endsection-