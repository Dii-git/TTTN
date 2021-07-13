<?php

namespace App\Http\Controllers\Vue;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VueController extends Controller
{
    public function vue()
    {
        return view('vue\front-end\post');
    }
}
