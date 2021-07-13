<?php

namespace App\Console\Commands;

use App\Notifications\NotifyInactiveUser;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\User;
class EmailInactiveUsers extends Command
{

    protected $signature = 'email:inactive-users';

    protected $description = 'Email inactive users';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // $data = [
        //     'desc' => " Hello, {{ Auth::user()->username }}!
        //                 You haven't logged in a while ago!
        //                 Please Log in! "
        // ];

        // $user = User::email;
        // Mail::raw("{$data}", function ($mail) use ($user) {
        //     $mail->from('www.traininglaravel.edu.vn@gmail.com', 'Training Laravel');
        //     $mail->to($user)
        //         ->subject('Mail send to you');
        // });
        
        $limit = Carbon::now()->subDay(7);
        $inactive_user = User::where('last_login', '<', $limit)->get();

        foreach ($inactive_user as $user) {
            $user->notify(new NotifyInactiveUser());
        }
    }
}
