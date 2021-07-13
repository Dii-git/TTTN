<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs\SendMail;

use App\Http\Controllers\Controller;

class JobsController extends Controller
{

    /**
     *
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function enqueue(Request $request)
    {
        $details = ['email' => 'recipient@example.com'];
        $emailJob = (new      SendEmail($details))->delay(Carbon::now()->addSeconds(10));
        dispatch($emailJob);
    }

}
