<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Email;
use DB;
use Session;
use Mail;
use Carbon\Carbon;
use App\Mail\SendEmailQueue;

class EmailController extends Controller
{
    public function sendMailUser($id)
    {
        $user = User::find($id);
        //send mail
        $to_name = $user->username;
        $to_email = $user->email;//send to this email
       
     
        $data = array("name"=>"Laravel Training","body"=>"You haven't logged in a while ago!"); //body of mail.blade.php
        
        Mail::send('user.emailUser',$data,function($message) use ($to_name,$to_email){

        $message->to($to_email)->subject('Test thử gửi mail google');//send this mail with subject
        $message->from($to_email,$to_name);//send from this mail
        });

        DB::update(
            'update emails set email_status = 1 where id = ?',
            [$user->id]
        );

        return redirect('/list_email');
    }

    public function listEmail(Request $request)
    {
        $user = User::all();
        $data = Email::all();
        $email = Email::paginate(5);
        $now = Carbon::now();
        $now = $now->subDay();

        foreach ($user as $key => $item) {
            if ($item->last_login < $now | $item->last_login == $now && $item->level == 0) 
            {
                foreach($item->emails as $emails)
                {
                    if ($item->id == $emails->user_id) {
                        DB::update(
                            'update emails set email_status = 0 where id = ?',
                            [$emails->id]
                        );
                    }
                }
            }
        }
        return view('admin\email\email_list', ['emails'=>$data])
                    ->with('emails', $email);
    }

    public function addEmailQueue()
    {
        $user = User::all();
        $email = Email::all();
        $now = Carbon::now();
        $now = $now->subDay();

        foreach ($user as $key => $item) {
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
                    else
                    {
                        Email::create([
                            "user_id"   => $item->id,
                            "email_status" => '0',
                        ]);
                    }
                }
            }
        }

        return redirect('/admin');
    }

    public function sendQueue()
    {
        $email = Email::all();
        foreach ($email as $key => $item) {
            if ($item->email_status == 0) {

                Mail::to($item->user->email)
                ->queue(new SendEmailQueue($item->user->email));

                DB::update(
                    'update emails set email_status = 1 where user_id = ?',
                    [$item->user->id]
                );
            }
        }
        return redirect("/list_email")->with(['msg' => 'Email sent successfully']);
    }
}
