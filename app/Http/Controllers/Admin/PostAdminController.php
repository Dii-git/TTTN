<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use DB;
use Session;

class PostAdminController extends Controller
{

    public function listPost(Request $request)
    {
        $data = Post::all();
        $posts = Post::paginate(5);

        return view('admin\post\list_post', ['posts'=>$data])->with('posts', $posts);
    }


    public function deletePost($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/list_post')->with('Success', 'Post has been successfully delete!');
    }

    public function enabledPost($id)
    {
        
        DB::update(
            'update posts set voucher_enabled = 1 where id = ?',
            [$id]
        );
        Session::put('message', 'Enabled Successfully');
        return redirect('/list_post');
    }

    public function unenabledPost($id)
    {
        DB::update(
            'update posts set voucher_enabled = 0 where id = ?',
            [$id]
        );
        Session::put('message', 'Unenabled Successfully');
        return redirect('/list_post');
    }

}
