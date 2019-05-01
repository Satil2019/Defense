<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;
class TestController extends Controller
{

	//here i have used gate for multi level user
	//being registered on Provider/AuthServiceProvider
    public function index(){
    	if(!Gate::allows('isStudent')){
    		abort(404,"sorry , you can do this actions");
    	}else{
    		return 0;
    		
    	}
    }
    public function homepage(){
        return view('admin.Home.index');
    }
}
