@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">  
        <h2>Posts</h2>   
        <div class="col-md-12" style="background-color:skyblue;padding-top:10px;padding-bottom:10px"> 
            <input  style="padding-left:5px" type="text" name="search" id="txt-search" />
            <button type="button" name="search" id="btn-search" class="btn btn-large btn-primary">Search</button>          
            <button type="button" name="upload" id="btn-upload" class="btn btn-large btn-primary">Upload</button>
            <button type="button" name="download" id="btn-download" class="btn btn-large btn-primary">Download</button>
            <button type="button" name="add" id="btn-add" class="btn btn-large btn-primary">Add</button>
           
            
            
            

        </div>        
    </div>
</div>
@endsection