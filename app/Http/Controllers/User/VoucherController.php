<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\User;
use App\Models\Voucher;
use App\Models\Voucherissue;
use DB;
use Session;

class VoucherController extends Controller
{
    public function createVoucher(Request $request)
    {
        $voucher = Voucher::find($request->voucher);
        if($voucher->voucher_enabled == 1 && $voucher->voucher_quantity != 0)
        {
            $voucher_num = 8;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';

            for ($i = 0; $i < $voucher_num; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }
            //Add voucher code
            Voucherissue::create([
                "voucher_code" => $randomString,
                "post_id"   =>  $request->post_id,
                "user_id"   => Auth::user()->id,
            ]);



            DB::update(
                'update posts set voucher_enabled = 0 where id = ?',
                [$request->post_id]
            );

            DB::update(
                'update posts set voucher_quantity = voucher_quantity+1 where id = ?',
                [$request->post_id]
            );


            DB::update(
                'update posts set voucher_id = ? where id = ?',
                [$request->voucher, $request->post_id]
            );

            DB::update(
                'update vouchers set voucher_quantity = voucher_quantity-1 where id = ?',
                [$request->voucher]
            );

            return redirect('/');
        }
        else
        {
            Session::put('message', 'There is no more available voucher.');
            return redirect('/');
        }
    }

    public function allVoucher()
    {
        $data_voucher = Voucher::all();
        $vouchers = Voucher::paginate(5);

        return view('post\home', ['vouchers'=>$data_voucher])
        ->with('vouchers', $vouchers);
    }
}
