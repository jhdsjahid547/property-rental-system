<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() 
    {
        return inertia('Index/IndexPage', ['latest' => 'Came form controller']);
    }

    public function show()
    {
        return inertia('Index/ShowPage');
    }
}
