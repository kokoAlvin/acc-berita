<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function home(){
        return view('home');
    }

    public function aboutUs(){
        return view('aboutUs');
    }

    public function blog(){
        $Blog = new Blog;
        
        $blogs = $Blog
            ->with('user')
            ->paginate(10);

        return view('blog',compact('blogs'));
    }

}

