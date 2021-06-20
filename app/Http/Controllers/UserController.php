<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function index()
    {
        return view('user.index');
    }

    /**
     *  Common Screen View     
     * 
     */
    public function common()
    {
        return view('user.common');
    }
}
