@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="custom-bc" >
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('common') }}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('showAllUsers') }}">Users</a></li>   
  </ol>
</nav>
<div class="container">

@if ($message = Session::get('success'))
        <div class="col-md-11 alert alert-success">
            <span>{{ $message }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </button>
        </div>
@endif
@if ($message = Session::get('fail'))
        <div class="col-md-11 alert alert-danger">
            <span>{{ $message }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </button>
        </div>
@endif
        

    <div class="row justify-content-center">  
        <h2>Users List</h2>   
        <div class="col-md-12" style="background-color:light;padding-top:10px;padding-bottom:10px"> 
            <div class="form-inline">
                <input class="form-control mr-2" placeholder="Name" style="padding-left:2px" type="text" name="name" id="name" />
                <input class=" form-control mr-2"  placeholder="Email"  type="text" name="email" id="email" />          
                <input class="form-control mr-2"  placeholder="Created From Date"  type="text" name="created_from_date" id="created_from_date" />
                <input class="form-control mr-2"  placeholder="Created To Date"  type="text" name="created_to_date" id="created_to_date" />
                <a  name="search" id="btn-search" class="btn btn-large btn-info mr-2"><i class="bi bi-search"></i>&nbsp;&nbsp;Search</a>
                <a  href="{{route('createUserForm')}}" name="add" id="btn-add" class="btn btn-large btn-info"><i class="bi bi-plus-circle"></i>&nbsp;&nbsp;Add</a>        
            </div>
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
                        <td><a data-toggle="modal" id="btn-detail" data-target="#detailModal"
                                data-attr="{{route('showUser',$data->id)}}">{{ $data->name }}</a></td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->created_user_name}}</td>
                        <td>{{$data->phone}}</td>
                        <td>{{$data->date_of_birth}}</td>
                        <td>{{ \Str::limit($data->address,15) }}</td>
                        <td>{{date('Y-m-d', strtotime($data->created_at))}}</td>
                       <td>{{date('Y-m-d', strtotime($data->updated_at))}}</td>
                       
                       <td>
                       <form>
                            <a class="btn btn-success btn-sm" href="{{route('updateUser',$data->id)}}">Edit</a>
                            <a class="btn btn-danger btn-sm"data-toggle="modal" id="btn-delete" data-target="#deleteModal"
                                data-attr="{{route('delete',$data->id)}}">Delete</a>
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
	
    <!-- small detail modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-head-color">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="detailBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!--end detail modal-->

    <!-- delete modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-head-color">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="deleteBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!--end delete modal-->
  <script>
        // display a modal (small modal)
        $(document).on('click', '#btn-detail', function(event) {
            event.preventDefault();
            $('#detailBody').html('');
            let href = $(this).attr('data-attr');
           
            $.ajax({
                url: href,
                beforeSend: function() {
                  //  $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#detailModal').modal("show");
                    $('#detailBody').html(result).show();
                },
                complete: function() {
                   // $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    //$('#loader').hide();
                },
                timeout: 8000
            })
        });

        //display delete modal
         
         $(document).on('click', '#btn-delete', function(event) {
            event.preventDefault();
            $('#deleteBody').html('');
            let href = $(this).attr('data-attr');
           
            $.ajax({
                url: href,
                beforeSend: function() {
                 
                },
                // return the result
                success: function(result) {
                    $('#deleteModal').modal("show");
                    $('#deleteBody').html(result).show();
                },
                complete: function() {
            
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                  
                },
                timeout: 8000
            })
        });
</script>

@endsection