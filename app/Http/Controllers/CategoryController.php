<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    
    public function index()
    {
        $result['data'] = Category::all();
        return view('admin/category', $result);
    }

    
    public function manage_category(Request $request, $id="")
    {
        if($id>0){
            $result = Category::where(['id'=>$id])->get();
            $request['category_name'] = $result['0']->category_name;
            $request['category_slug'] = $result['0']->category_slug;
            $request['parent_category_id'] = $result['0']->parent_category_id;
            // $request['category_image'] = $result['0']->category_image;
            $request['id'] = $result['0']->id;
        }else {  
            $request['category_name'] = '';
            $request['category_slug'] = ''; 
            $request['parent_category_id'] = ''; 
            // $request['category_image'] = '';
            $request['id'] = 0; 
        }
        $request['category'] = DB::table('categories')->where(['status' => 1])->get();
        return view('admin/manage_category', $request);
    }


    public function manage_category_process(Request $request)
    {
        $request->validate([
            'category_name'=>'required',
            'category_slug'=> 'required|unique:categories,category_slug,' . $request->post('id'),
            // 'category_image.*' => 'mimes:jpg,jpeg,png',
        ]);

        if($request->post('id')){
            $model= Category::find($request->post('id'));
            $msg = "Category Updated Successfuly!!";
        }else {    
           $model=new Category();
            $msg = "Category Inserted Successfuly!!";
        }
        
        // if ($request->hasFile('category_image')) {
        //     $image = $request->file('category_image');
        //     echo '<pre>';print_r($image);echo '</pre>';die;
        //     $ext = $image->extension();
        //     $image_name = time() . '.' . $ext;
        //     $image->storeAs('/public/media/category', $image_name);
        //     $model->category_image=$image_name;
        // }
        $model->category_name=$request->post('category_name');
        $model->category_slug=$request->post('category_slug');
        $model->parent_category_id=$request->post('parent_category_id');
        
        $model->status=1;
        $model->save();
        $request->session()->flash('message', $msg);
        return redirect('admin/category');
    }
    
    public function delete(Request $request, $id){
        $model= Category::find($id);
        $model->delete();
        $request->session()->flash('message', 'Category Deleted successfully');
        return redirect('admin/category');
    }
    
    public function status(Request $request, $status, $id){
        $model= Category::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message', 'Category Status Updated');
        return redirect('admin/category');
    }

}
