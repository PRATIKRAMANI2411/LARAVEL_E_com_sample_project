<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $result['data'] = Brand::all();
        return view('admin/brand', $result);
    }


    public function manage_brand(Request $request, $id = "")
    {
        if ($id > 0) {
            $result = Brand::where(['id' => $id])->get();
            $request['name'] = $result['0']->name;
            $request['image'] = $result['0']->image;
            $request['id'] = $result['0']->id;
        } else {
            $request['name'] = '';
            $request['image'] = '';
            $request['id'] = 0;
        }
        return view('admin/manage_brand', $request);
    }


    public function manage_brand_process(Request $request)
    {
        // echo '<pre>';print_r($request->post());echo '</pre>';die;
        $request->validate([
            'name' => 'required|unique:brands,name,' . $request->post('id'),
        ]);

        
        if ($request->post('id')) {
            $model = Brand::find($request->post('id'));
            $msg = "Brand Updated Successfuly!!";
        } else {
            $model = new Brand();
            $msg = "Brand Inserted Successfuly!!";
        }
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time() . '.' . $ext;
            $image->move(public_path('/uploadedimages'), $image_name);
            // $image->storeAs('/public/media', $image_name);
            $model->image = $image_name;
        }
        $model->name = $request->post('name');
        $model->status = 1;
        $model->save();
        $request->session()->flash('message', $msg);
        return redirect('admin/brand');
    }

    public function delete(Request $request, $id)
    {
        $model = Brand::find($id);
        $model->delete();
        $request->session()->flash('message', 'Brand Deleted successfully');
        return redirect('admin/brand');
    }

    public function status(Request $request, $status, $id)
    {
        $model = Brand::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Brand Status Updated');
        return redirect('admin/brand');
    }
}
