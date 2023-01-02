<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $result['data'] = Coupon::all();
        return view('admin/coupon', $result);
    }


    public function manage_coupon(Request $request, $id='')
    {
        if ($id > 0) {
            $result = Coupon::where(['id' => $id])->get();
            $request['title'] = $result['0']->title;
            $request['code'] = $result['0']->code;
            $request['value'] = $result['0']->value;
            $request['type'] = $result['0']->type;
            $request['min_order_amt'] = $result['0']->min_order_amt;
            $request['is_one_time'] = $result['0']->is_one_time;
            $request['id'] = $result['0']->id;
        } else {
            $request['title'] = '';
            $request['code'] = '';
            $request['value'] = '';
            $request['type'] = '';
            $request['min_order_amt'] = '';
            $request['is_one_time'] = '';
            $request['id'] = 0;
        }
        return view('admin/manage_coupon', $request);
    }


    public function manage_coupon_process(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'code' => 'required|unique:coupons,code,' . $request->post('id'),
            'value' => 'required',
        ]);

        if ($request->post('id')) {
            $model = Coupon::find($request->post('id'));
            $msg = "Coupon Updated Successfuly!!";
        } else {
            $model = new Coupon();
            $msg = "Coupon Inserted Successfuly!!";
        }
        $model->title = $request->post('title');
        $model->code = $request->post('code');
        $model->value = $request->post('value');
        $model->type = $request->post('type');
        $model->min_order_amt = $request->post('min_order_amt');
        $model->is_one_time = $request->post('is_one_time');
        $model->status = 1;
        $model->save();
        $request->session()->flash('message', $msg);
        return redirect('admin/coupon');
    }

    public function delete(Request $request, $id)
    {
        $model = Coupon::find($id);
        $model->delete();
        $request->session()->flash('message', 'Coupon Deleted successfully');
        return redirect('admin/coupon');
    }
    
    public function status(Request $request, $status, $id)
    {
        $model = Coupon::find($id);
        $model->status= $status;
        $model->save();
        $request->session()->flash('message', 'Coupon Status Updated');
        return redirect('admin/coupon');
    }
}
