@extends('layouts.app')
@section('menu')


@endsection
@section('content')
                    

            <div class="container">
            <h2 style="display:initial">SCM BulletinBoard</h2>                
                    <a href="#"  class="col-md-2 " ><i class="bi bi-person-circle"></i>Profile</a>
                    <a href="#"  class="col-md-1 " ><i class="bi bi-people-fill"></i>Users</a>
                    <a href="{{ route('showAllPosts') }}"  class="col-md-1" ><i class="bi bi-file-earmark-text"></i>Posts</a>              
            </div>
        
@endsection


