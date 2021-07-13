<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Voucherissue;
use App\Models\Voucher;
use DB;
use Session;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $data = array();
        $data['description'] = $request->desc_post;
        $data['user_id'] = Auth::user()->id;

        $this->validate($request,[
            'img' => '
                required|image|mimes:jpg,png,jpg,gif|max:2048'
        ]);
        $image = $request->file('img');
        $new_name = rand().'.'.$image->
            getClientOriginalExtension();
        $image->move(public_path("images"), $new_name);

        $data['image'] = $new_name;
        $data['voucher_id'] = $request->voucher_id;
        $data['view'] = $request->view_post;
        $data['voucher_enabled'] = $request->voucher_enabled;
        $data['voucher_quantity'] = $request->voucher_quantity;

        DB::table('posts')->insert($data);
        Session::put('message','Successfully');

        return redirect('/');
    }

    public function allPost()
    {
        $data_post = Post::all();
        $posts = Post::paginate(5);

        return view('post\home', ['posts'=>$data_post])
        ->with('posts', $posts);
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/')->with('Success', 'Post has been successfully delete!');
        
    }

    public function detail($id)
    {
        $post = Post::where('id',$id);
       
        DB::update(
            'update posts set view = view + 1 where id = ?',
            [$id]
        );

        $data = $post->with('voucherissue')->get();

        return view('post\detail', ['posts'=>$data]);
    }

    public function allPostUser()
    {
        $data = Post::where('user_id','=',Auth()->user()->id)->get();
        $posts = Post::paginate(5);

        return view('post\postUser', ['posts'=>$data])->with('posts', $posts);
        
    }

    public function getEdit($id)
    {
        $data = Post::find($id);        
        return View('post\edit', ['posts'=>$data]);
    }

    public function updatePost(Request $request, $id)
    {
        $post = Post::find($id);
        $post->description = $request->get('desc_post');

        $this->validate($request,[
            'img' => '
                required|image|mimes:jpg,png,jpg,gif|max:2048'
        ]);
        
        if ($request->hasFile('img')){
            $image = $request->file('img');
            $new_name = rand().'.'.$image->
                getClientOriginalExtension();
            $image->move(public_path("images"), $new_name);
            $post->image = $new_name;
        }

        $post->save();
        return view('post\edit')->with('status', 'Post has been successfully updated!');
    }
}
