<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{

    public function index()
    {
        
        $result['data'] = Tax::all();
        return view('admin/tax', $result);
    }


    public function manage_tax(Request $request, $id = "")
    {
        if ($id > 0) {
            $result = Tax::where(['id' => $id])->get();
            $request['tax_desc'] = $result['0']->tax_desc;
            $request['tax_value'] = $result['0']->tax_value;
            $request['id'] = $result['0']->id;
        } else {
            $request['tax_desc'] = '';
            $request['tax_value'] = '';
            $request['id'] = 0;
        }
        return view('admin/manage_tax', $request);
    }


    public function manage_tax_process(Request $request)
    {
        // $request->validate([
        //     'color' => 'required|unique:colors,color,' . $request->post('id'),
        // ]);

        if ($request->post('id')) {
            $model = Tax::find($request->post('id'));
            $msg = "Tax Updated Successfuly!!";
        } else {
            $model = new Tax();
            $msg = "Tax Inserted Successfuly!!";
        }
        $model->tax_desc = $request->post('tax_desc');
        $model->tax_value = $request->post('tax_value');
        $model->status = 1;
        $model->save();
        $request->session()->flash('message', $msg);
        return redirect('admin/tax');
    }

    public function delete(Request $request, $id)
    {
        $model = Tax::find($id);
        $model->delete();
        $request->session()->flash('message', 'Tax Deleted successfully');
        return redirect('admin/tax');
    }

    public function status(Request $request, $status, $id)
    {
        $model = Tax::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Tax Status Updated');
        return redirect('admin/tax');
    }
    
}
