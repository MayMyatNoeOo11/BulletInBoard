@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="custom-bc" >
  <ol class="breadcrumb"  >
    <li class="breadcrumb-item"><a href="{{ route('common') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('showAllUsers') }}">Users</a></li>
    <li class="breadcrumb-item active" aria-current="page">Profile</li>
  </ol>
</nav>

  <div class="row mt-1">
    <div class="col-md-12">      

    <div class="col-md-8 offset-md-2 mt-2">
        <div class="row card">
            <h4 class="text-center">User Profile</h4>
            <div class="card-body confirm-bg-color">
                <div class="row mb-2">                    
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <img class="profile_preview" src="{{URL::asset('/images/profile.jpeg')}}" id="preview_image"/>
                            </div>
                            <div class="col-md-1 offset-md-7">
                             <button class="btn btn-primary btn-lg">
                                 Edit
                             </button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                Name :
                            </div>
                            <div class="col-md-9">
                            Aye Nam
                            </div>
                        </div>   
                        <div class="row mb-3">
                            <div class="col-md-3">
                                Email :
                            </div>
                            <div class="col-md-9">
                            Aye Nam@gmail.com
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                Type :
                            </div>
                            <div class="col-md-9">
                            User
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                Phone :
                            </div>
                            <div class="col-md-9">
                            09798956235
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                Date of Birth :
                            </div>
                            <div class="col-md-9">
                            1997-11-11
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                Address :
                            </div>
                            <div class="col-md-9">
                            Aye Nam Street, Dagon Township ,Yangon
                            </div>
                        </div> 
                </div>
            </div>

        </div>
        <div class="row mt-2">
                <div class="col-md-5 offset-md-5">
                    <button type="button" class="btn btn-default btn-lg">
                        OK
                    </button>
                    
                </div>
            </div>
    </div> 
 
    </div>
  </div>
  @endsection