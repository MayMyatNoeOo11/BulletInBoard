@extends('layouts.app')

@section('content')

    <div class="col-md-8 offset-md-2 mt-2">
        <div class="row card">
            <h4 class="text-center">Update User Confirmation</h4>
            <div class="card-body confirm-bg-color">
                <div class="row mb-2">
                    <div class="col-md-8">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                Name :
                            </div>
                            <div class="col-md-9">
                                Aye Aye     
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                Email :
                            </div>
                            <div class="col-md-9">
                                aa@gmail.com
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                Password :
                            </div>
                            <div class="col-md-9">
                                aa@gmail.com
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                Type :
                            </div>
                            <div class="col-md-9">
                                aa@gmail.com
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                Phone :
                            </div>
                            <div class="col-md-9">
                                aa@gmail.com
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                Date of Birth :
                            </div>
                            <div class="col-md-9">
                                aa@gmail.com
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                Address :
                            </div>
                            <div class="col-md-9">
                                aa@gmail.com
                            </div>
                        </div>
                       
                   
                    
                    </div>
                    <div class="col-md-4">
                        <img class="profile_preview" src="{{URL::asset('/images/profile.jpeg')}}" id="preview_image"/>
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

@endsection