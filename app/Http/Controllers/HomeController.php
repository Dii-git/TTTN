<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Post;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Post::all();
        return view('post\home', ['posts'=>$data]);
    }


    public function store(Request $request)
    {
        if ($request->user()->can('create-posts')) {
            //Code goes here
        }
    }

    public function destroy(Request $request, $id)
    {   
        if ($request->user()->can('delete-posts')) {
        //Code goes here
        }

    }

}
