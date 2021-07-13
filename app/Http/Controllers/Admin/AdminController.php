<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Email;
use Carbon\Carbon;
use DB;
use Session;
use Mail;


class AdminController extends Controller
{
    public function listAdmin(Request $request)
    {
        $data_user = User::all();
        $users = User::paginate(5);

        $data_post = Post::all();
        $posts = Post::paginate(5);

        $now = Carbon::now();
        $now = $now->subDay();

        $email = Email::all();

        foreach ($data_user as $key => $item) {
            if ($item->last_login < $now | $item->last_login == $now && $item->level == 0) 
            {
                foreach($item->emails as $emails)
                {
                    if ($item->id == $emails->user_id && $emails->email_status == 1) {
                        DB::update(
                            'update emails set email_status = 0 where id = ?',
                            [$emails->id]
                        );
                    }
                }
            }
        }
        return view('admin\admin',  ['users'=>$data_user], 
                                    ['posts'=>$data_post], 
                                    ['nows'=>$now])
        ->with('users', $users)
        ->with('posts', $posts)
        ->with('nows', $now);
    }

    public function listUser(Request $request)
    {
        $data_user = User::all();
        $users = User::paginate(5);


        return view('admin\user\list_user',  ['users'=>$data_user])
        ->with('users', $users);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/list_user')->with('Success', 'User has been successfully delete!');
    }

}
