<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use DB;
use Session;


class CategoryAdminController extends Controller
{
    public function addCate()
    {
        return View('admin\category\add_cate');
    }

    public function listCate()
    {
        $data = Category::all();
        return view('admin\category\list_cate', ['category'=>$data]);
    }

    public function saveCate(Request $request)
    {
        $data = array();
        $data['cate_name'] = $request->category_name;
        $data['cate_status'] = $request->status;

        DB::table('categories')->insert($data);
        Session::put('message','Successfully');

        return redirect('/add_cate');
    }

    public function editCate($id)
    {
        $data = Category::find($id);        
        return View('admin\category\edit_cate', ['categories'=>$data]);
    }

    public function saveEditCate(Request $request)
    {
        $data = array();
        $data['cate_name'] = $request->category_name;

        DB::table('categories')->update($data);
        Session::put('message','Successfully');

        return redirect('/list_cate');
    }

    public function deleteCate($id)
    {
        $cate = Category::find($id);
        $cate->delete();
        return redirect('/list_cate')->with('Success', 'Category has been successfully delete!');
    }

    public function activeCate($id)
    {
        //DB::table('categories')->where('id',$cateId)->update('cate_status'->(int)$value);
        
        DB::update(
            'update categories set cate_status = 1 where id = ?',
            [$id]
        );
        Session::put('message', 'Active Category Successfully');
        return redirect('/list_cate');
    }

    public function unactiveCate($id)
    {
        DB::update(
            'update categories set cate_status = 0 where id = ?',
            [$id]
        );
        Session::put('message', 'Unactive Category Successfully');
        return redirect('/list_cate');
    }
}
