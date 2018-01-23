<?php

namespace App\Http\Controllers\TodoList;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Main extends Controller
{
    //
    function index()
    {
    	return view('todo');
    }
}
