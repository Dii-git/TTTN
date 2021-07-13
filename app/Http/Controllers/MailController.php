<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Mail;
use App\Models\User;


class MailController extends Controller
{
    public function sendMailUser()
    {
        $user = Auth::user();
        //send mail
        $to_name = $user->username;
        $to_email = $user->email;//send to this email
       
     
        $data = array("name"=>"Laravel Training","body"=>"You haven't logged in a while ago!"); //body of mail.blade.php
        
        Mail::send('user.emailUser',$data,function($message) use ($to_name,$to_email){

            $message->to($to_email)->subject('Test thử gửi mail google');//send this mail with subject
            $message->from($to_email,$to_name);//send from this mail

        });

    }
    

}
