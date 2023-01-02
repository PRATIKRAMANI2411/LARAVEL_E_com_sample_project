<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $result['data'] = Color::all();
        return view('admin/color', $result);
    }


    public function manage_color(Request $request, $id = "")
    {
        if ($id > 0) {
            $result = Color::where(['id' => $id])->get();
            $request['color'] = $result['0']->color;
            $request['id'] = $result['0']->id;
        } else {
            $request['color'] = '';
            $request['id'] = 0;
        }
        return view('admin/manage_color', $request);
    }


    public function manage_color_process(Request $request)
    {
        $request->validate([
            'color' => 'required|unique:colors,color,' . $request->post('id'),
        ]);

        if ($request->post('id')) {
            $model = Color::find($request->post('id'));
            $msg = "Color Updated Successfuly!!";
        } else {
            $model = new Color();
            $msg = "Color Inserted Successfuly!!";
        }
        $model->color = $request->post('color');
        $model->status = 1;
        $model->save();
        $request->session()->flash('message', $msg);
        return redirect('admin/color');
    }

    public function delete(Request $request, $id)
    {
        $model = Color::find($id);
        $model->delete();
        $request->session()->flash('message', 'Color Deleted successfully');
        return redirect('admin/color');
    }

    public function status(Request $request, $status, $id)
    {
        $model = Color::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'color Status Updated');
        return redirect('admin/color');
    }
}
