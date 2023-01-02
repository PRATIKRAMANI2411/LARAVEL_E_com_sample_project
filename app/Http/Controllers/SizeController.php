<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $result['data'] = Size::all();
        return view('admin/size', $result);
    }


    public function manage_size(Request $request, $id = "")
    {
        if ($id > 0) {
            $result = Size::where(['id' => $id])->get();
            $request['size'] = $result['0']->size;
            $request['id'] = $result['0']->id;
        } else {
            $request['size'] = '';
            $request['id'] = 0;
        }
        return view('admin/manage_size', $request);
    }


    public function manage_size_process(Request $request)
    {
        $request->validate([
            'size' => 'required|unique:sizes,size,' . $request->post('id'),
        ]);

        if ($request->post('id')) {
            $model = Size::find($request->post('id'));
            $msg = "Size Updated Successfuly!!";
        } else {
            $model = new Size();
            $msg = "Size Inserted Successfuly!!";
        }
        $model->size = $request->post('size');
        $model->status = 1;
        $model->save();
        $request->session()->flash('message', $msg);
        return redirect('admin/size');
    }

    public function delete(Request $request, $id)
    {
        $model = Size::find($id);
        $model->delete();
        $request->session()->flash('message', 'Size Deleted successfully');
        return redirect('admin/size');
    }

    public function status(Request $request, $status, $id)
    {
        $model = Size::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'size Status Updated');
        return redirect('admin/size');
    }

}
