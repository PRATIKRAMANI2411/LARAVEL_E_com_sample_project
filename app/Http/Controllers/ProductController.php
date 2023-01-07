<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $result['data'] = product::all();
        return view('admin/product', $result);
    }

    public function manage_product(Request $request, $id = "")
    {
        if ($id > 0) {
            $arr = product::where(['id' => $id])->get();
            $result['category_id'] = $arr['0']->category_id;
            $result['name'] = $arr['0']->name;
            $result['slug'] = $arr['0']->slug;
            $result['image'] = $arr['0']->image;
            $result['brand'] = $arr['0']->brand;
            $result['model'] = $arr['0']->model;
            $result['short_decs'] = $arr['0']->short_decs;
            $result['decs'] = $arr['0']->decs;
            $result['keywords'] = $arr['0']->keywords;
            $result['technical_specification'] = $arr['0']->technical_specification;
            $result['uses'] = $arr['0']->uses;
            $result['warranty'] = $arr['0']->warranty;
            $result['lead_time'] = $arr['0']->lead_time;
            $result['tax'] = $arr['0']->tax;
            $result['tax_type'] = $arr['0']->tax_type;
            $result['is_promo'] = $arr['0']->is_promo;
            $result['is_featured'] = $arr['0']->is_featured;
            $result['is_discounted'] = $arr['0']->is_discounted;
            $result['is_tranding'] = $arr['0']->is_tranding;
            $result['id'] = $arr['0']->id;

            $result['productAttrArr'] = DB::table('products_attr')->where(['products_id'=>$id])->get();
            $productImageArr = DB::table('product_images')->where(['products_id'=>$id])->get();
            
            if(!isset($productImageArr[0])){
                $result['productImageArr'][0]['id'] = '';
                $result['productImageArr'][0]['images'] = '';
            }else {
                $result['productImageArr']=$productImageArr;
            }
            // echo '<pre>';print_r($result['productImageArr']);echo '</pre>';die;

        } else {
            $result['category_id'] = '';
            $result['name'] = '';
            $result['slug'] = '';
            $result['image'] = '';
            $result['brand'] = '';
            $result['model'] = '';
            $result['short_decs'] = '';
            $result['decs'] = '';
            $result['keywords'] = '';
            $result['technical_specification'] = '';
            $result['uses'] = '';
            $result['warranty'] = '';
            $result['lead_time'] = '';
            $result['tax'] = '';
            $result['tax_type'] = '';
            $result['is_promo'] = '';
            $result['is_featured'] = '';
            $result['is_discounted'] = '';
            $result['is_tranding'] = '';
            $result['id'] = 0;

            $result['productAttrArr'][0]['id'] ='';
            $result['productAttrArr'][0]['products_id'] ='';
            $result['productAttrArr'][0]['sku'] ='';
            $result['productAttrArr'][0]['attr_image'] ='';
            $result['productAttrArr'][0]['mrp'] ='';
            $result['productAttrArr'][0]['price'] ='';
            $result['productAttrArr'][0]['qty'] ='';   
            $result['productAttrArr'][0]['size_id'] ='';   
            $result['productAttrArr'][0]['color_id'] ='';   

            $result['productImageArr'][0]['id'] ='';   
            $result['productImageArr'][0]['images'] ='';   
            // echo '<pre>';print_r($result['productAttrArr']);echo '</pre>';die;
        }
        $result['category']=DB::table('categories')->where(['status'=>1])->get();
        $result['size']=DB::table('sizes')->where(['status'=>1])->get();
        $result['color']=DB::table('colors')->where(['status'=>1])->get();
        $result['brands']=DB::table('brands')->where(['status'=>1])->get();
        return view('admin/manage_product', $result);
    }


    public function manage_product_process(Request $request)
    {
        // echo '<pre>';print_r($request->post());echo '</pre>';die;
        if ($request->post('id') > 0) {
            $image_validasion = 'mimes:jpeg,jpg,png';
        } else {
            $image_validasion = 'required|mimes:jpeg,jpg,png';
        }
        
        $request->validate([
            'name' => 'required',
            'image' => $image_validasion,
            'slug' => 'required|unique:products,slug,' . $request->post('id'),
            'attr_image.*' => 'mimes:jpg,jpeg,png',
            'images.*' => 'mimes:jpg,jpeg,png'
        ]);

            $Attrattr_image=$request->post('attr_image');
            $Attrpaid=$request->post('paid');
            $Attrsku=$request->post('sku');
            $Attrmrp=$request->post('mrp');
            $Attrsize=$request->post('size');
            $Attrprice=$request->post('price');
            $Attrcolor=$request->post('color');
            $Attrqty=$request->post('qty');
            
            foreach ($Attrsku as $key => $val) {
                $check=DB::table('products_attr')->
                where('sku','=',$Attrsku[$key])->
                where('id','!=', $Attrpaid[$key])->
                get();

                if(isset($check[0])){
                    $request->session()->flash('sku_error', $Attrsku[$key] .' SKU already used');
                    return redirect(request()->headers->get('referer'));
                }
            }
            // dd($check);

        if ($request->post('id')>0) {
            $model = product::find($request->post('id'));
            $msg = "Product Updated Successfuly!!";
        } else {
            $model = new product();
            $msg = "Product Inserted Successfuly!!";
        }
        if ($request->hasFile('image')) {
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name = time().'.'.$ext;
            $image->move(public_path('/uploadedimages'), $image_name);
            $model->image= $image_name;
        }

        $model->category_id = $request->post('category_id');
        $model->name = $request->post('name');
        $model->slug = $request->post('slug');
        $model->brand = $request->post('brand');
        $model->model = $request->post('model');
        $model->short_decs = $request->post('short_decs');
        $model->decs = $request->post('decs');
        $model->keywords = $request->post('keywords');
        $model->technical_specification = $request->post('technical_specification');
        $model->uses = $request->post('uses');
        $model->warranty = $request->post('warranty');  
        $model->lead_time = $request->post('lead_time');  
        $model->tax = $request->post('tax');  
        $model->tax_type = $request->post('tax_type');  
        $model->is_promo = $request->post('is_promo');  
        $model->is_featured = $request->post('is_featured');  
        $model->is_discounted = $request->post('is_discounted');  
        $model->is_tranding = $request->post('is_tranding');  
        $model->status = 1;
        $model->save();
        $pid=$model->id;

        /* Product Attr start */
        foreach ($Attrsku as $key => $val) {
            $productAttrArr['products_id']= $pid;
            $productAttrArr['sku']= $Attrsku[$key];
            $productAttrArr['mrp']= (int)$Attrmrp[$key];
            if($Attrsize[$key] == ''){
                $productAttrArr['size_id'] = 0;
            }else{
                $productAttrArr['size_id']= $Attrsize[$key];
            }

            if($Attrcolor[$key] == ''){
                $productAttrArr['color_id'] = 0;
            }else{
                $productAttrArr['color_id']= $Attrcolor[$key];
            }
            
            if($request->hasFile("attr_image.$key")){
                $rand = rand('111111111', '999999999');
                $attr_image = $request->file("attr_image.$key");
                $ext = $attr_image->extension();
                $image_name= $rand.'.'. $ext;
                $request->file("attr_image.$key")->storeAs('/public/media', $image_name);
                $productAttrArr['attr_image'] = $image_name;
            }else {
                $productAttrArr['attr_image'] = '';
            }

            $productAttrArr['price']= (int)$Attrprice[$key];
            $productAttrArr['qty']= (int)$Attrqty[$key];
            

            if($Attrpaid[$key] != ''){
                DB::table('products_attr')->where(['id'=>$Attrpaid[$key]])->update($productAttrArr);
            }else{
                DB::table('products_attr')->insert($productAttrArr);
            }

        }
        /* Product Attr end */


        /* product image start */

        $piidArr=$request->post('piid');
        foreach ($piidArr as $key => $val) {
            if ($request->hasFile("images.$key")) {
                $productImageArr['products_id'] = $pid;
                $rand = rand('111111111', '999999999');
                $images = $request->file("images.$key");
                $ext = $images->extension();
                $image_name = $rand . '.' . $ext;
                $request->file("images.$key")->storeAs('/public/media', $image_name);
                $productImageArr['images'] = $image_name;
            }

            if ($piidArr[$key] != '') {
                DB::table('product_images')->where(['id' => $piidArr[$key]])->update($productImageArr);
            } else {
                DB::table('product_images')->insert($productImageArr);
            }
        }

        /* product image end */


        $request->session()->flash('message', $msg);
        return redirect('admin/product');
    }

    public function delete(Request $request, $id)
    {
        $model = product::find($id);
        $model->delete();
        $request->session()->flash('message', 'Poduct Deleted successfully');
        return redirect('admin/product');
    }

    public function product_attr_delete(Request $request, $paid='', $pid='')
    {
        DB::table('products_attr')->where(['id'=>$paid])->delete();
        return redirect('admin/product/manage_product/'.$pid);
    }
    
    public function product_image_delete(Request $request, $paid='', $pid='')
    {
        DB::table('product_images')->where(['id'=>$paid])->delete();
        return redirect('admin/product/manage_product/'.$pid);
    }

    public function status(Request $request, $status, $id)
    {
        $model = product::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Product Status Updated');
        return redirect('admin/product');
    }
}
