<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        # Passing a variable to a view
        # 1. return view('pages.index',compact('title'))
        # 2. return view('pages.index')->with("string",$variable);
        # return view('pages.index',compact('title'));
        # return view('pages.index')->with( "title" ,$title);
        
        $data = array(
                        "title" => "Home",
                        # "names" => array("root","shin","shan","kieraa")
                     );

        return view('pages.index')->with($data);
    
    }

    public function about()
    {
        return view('pages.about');
    }

    public function services()
    {
        return view('pages.services');
    }

    public function display_jitsi()
    {
        return view('pages.jitsi');
    }

}

