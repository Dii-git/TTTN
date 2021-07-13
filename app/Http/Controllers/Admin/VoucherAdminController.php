<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Models\Voucherissue;
use DB;
use Session;

class VoucherAdminController extends Controller
{
    public function addVoucher()
    {
        return View('admin\vouchers\add_vou');
    }

    public function listVoucher(Request $request)
    {
        $data = Voucher::all();
        $vouchers = Voucher::paginate(5);

        return view('admin\vouchers\list_vou', ['vouchers'=>$data])->with('vouchers', $vouchers);
    }

    public function saveVoucher(Request $request)
    {
        $data = array();
        $data['voucher_name'] = $request->vou_name;
        $data['voucher_enabled'] = $request->vou_en;
        $data['voucher_quantity'] = $request->vou_qu;

        DB::table('vouchers')->insert($data);
        Session::put('message','Successfully');

        return redirect('/add_voucher');
    }

    public function deleteVou($id)
    {
        $vou = Voucher::find($id);
        $vou->delete();
        return redirect('/list_voucher')->with('Success', 'Voucher has been successfully delete!');
    }


    public function listVoucherIssue(Request $request)
    {
        $data = VoucherIssue::all();
        $voucherissues = VoucherIssue::paginate(5);

        return view('admin\vouchers\list_voucher_issue', ['voucherissue'=>$data])->with('voucherissue', $voucherissues);
    }
    public function enabledVou($id)
    {
        //DB::table('categories')->where('id',$cateId)->update('cate_status'->(int)$value);
        
        DB::update(
            'update vouchers set voucher_enabled = 1 where id = ?',
            [$id]
        );
        Session::put('message', 'Enabled Successfully');
        return redirect('/list_voucher');
    }

    public function unenabledVou($id)
    {
        DB::update(
            'update vouchers set voucher_enabled = 0 where id = ?',
            [$id]
        );
        Session::put('message', 'Unenabled Successfully');
        return redirect('/list_voucher');
    }
}
