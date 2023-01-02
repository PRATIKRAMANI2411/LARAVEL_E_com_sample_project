@extends('admin/layout')
@section('page_title', 'Manage Product')
@section('container')

@if ($id>0)
    {{$image_required = ''}}
@else
    {{$image_required = "required"}}
@endif
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>

    @if(session()->has('sku_error'))
    <div class="alert au-alert-success alert-dismissible fade show au-alert au-alert--70per" role="alert">
        <i class="zmdi zmdi-check-circle"></i>
        <span class="content">{{session('sku_error')}}</span>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
                <i class="zmdi zmdi-close-circle"></i>
            </span>
        </button>
    </div>
    @endif
    @error('attr_image.*')
        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @enderror
    @error('images.*')
        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @enderror
    <h1 class="mb10">Manage Product</h1>
    <a href="{{url('admin/product')}}">
        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Back</button>
    </a>
    <!-- DATA FORM-->
    <div class="row m-t-30">
        <form action="{{route('product.manege_product_process')}}" method="post" enctype="multipart/form-data">
            <div class="col-lg-12">
                {{session('message')}}
                <div class="card">
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="control-label mb-1">Name</label>
                            <input id="name" name="name" type="text" class="form-control" value="{{$name}}">
                            @error('name')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group has-success">
                            <label for="slug" class="control-label mb-1">Slug</label>
                            <input id="slug" name="slug" type="text" class="form-control" value="{{$slug}}">
                            @error('slug')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group has-success">
                            <label for="image" class="control-label mb-1">Image</label>
                            <input id="image" name="image" type="file" class="form-control" value="{{$image}}"{{$image_required}}>
                            @error('image')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="category" class="control-label mb-1">category</label>
                                    <select id="category_id" name="category_id" type="text" class="form-control" required>
                                        <option value="">Select category</option>
                                        @foreach ($category as $list)
                                        <option value="{{$list->id}}" @if ($category_id==$list->id) selected @endif>{{$list->category_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            
                                <div class="col-md-4">
                                    <label for="brand" class="control-label mb-1">Brand</label>
                                    <select id="brand" name="brand" type="text" class="form-control" required>
                                        <option value="">Select Brand</option>
                                        @foreach ($brands as $list)
                                        <option value="{{$list->id}}" @if ($brand==$list->id) selected @endif>{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('brand')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                    
                                <div class="col-md-4">
                                    <label for="model" class="control-label mb-1">Model</label>
                                    <input id="model" name="model" type="text" class="form-control" value="{{$model}}">
                                    @error('model')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <label for="short_decs" class="control-label mb-1">Short description</label>
                            <textarea id="short_decs" name="short_decs" type="text" class="form-control" required>{{$short_decs}}</textarea>
                            @error('short_decs')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group has-success">
                            <label for="decs" class="control-label mb-1">Description</label>
                            <textarea id="decs" name="decs" type="text" class="form-control" required>{{$decs}}</textarea>
                            @error('decs')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group has-success">
                            <label for="keywords" class="control-label mb-1">keywords</label>
                            <textarea id="keywords" name="keywords" type="text" class="form-control" required>{{$keywords}}</textarea>
                            @error('keywords')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group has-success">
                            <label for="uses" class="control-label mb-1">Technical specification</label>
                            <textarea id="technical_specification" name="technical_specification" type="text" class="form-control" required>{{$technical_specification}}</textarea>
                            @error('technical_specification')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group has-success">
                            <label for="uses" class="control-label mb-1">uses</label>
                            <textarea id="uses" name="uses" type="text" class="form-control" required>{{$uses}}</textarea>
                            @error('uses')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group has-success">
                            <label for="warranty" class="control-label mb-1">Warranty</label>
                            <textarea id="warranty" name="warranty" type="text" class="form-control" required>{{$warranty}}</textarea>
                            @error('warranty')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="lead_time" class="control-label mb-1">Lead Time</label>
                                    <input type="text" id="lead_time" name="lead_time" value="{{$lead_time}}" class="form-control">
                                    @error('lead_time')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="tax" class="control-label mb-1">Tax</label>
                                    <input type="text" id="tax" name="tax" value="{{$tax}}" class="form-control">
                                    @error('tax')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="tax_type" class="control-label mb-1">Tax Type</label>
                                    <input type="text" id="tax_type" name="tax_type" value="{{$tax_type}}" class="form-control">
                                    @error('tax_type')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="is_promo" class="control-label mb-1">iS Promo</label>
                                    <select id="is_promo" name="is_promo" type="text" class="form-control" required>
                                        @if($is_promo == '1')
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                        @else
                                        <option value="1" >Yes</option>
                                        <option value="0" selected>No</option>
                                        @endif
                                    </select>
                                    @error('is_promo')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="is_featured" class="control-label mb-1">iS Featured</label>
                                    <select id="is_featured" name="is_featured" type="text" class="form-control" required>
                                        @if($is_featured == '1')
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                        @else
                                        <option value="1" >Yes</option>
                                        <option value="0" selected>No</option>
                                        @endif
                                    </select>
                                    @error('is_featured')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="is_discounted" class="control-label mb-1">iS Discounted</label>
                                    <select id="is_discounted" name="is_discounted" type="text" class="form-control" required>
                                        @if($is_discounted == '1')
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                        @else
                                        <option value="1" >Yes</option>
                                        <option value="0" selected>No</option>
                                        @endif
                                    </select>
                                    @error('is_discounted')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="is_tranding" class="control-label mb-1">iS Tranding</label>
                                    <select id="is_tranding" name="is_tranding" type="text" class="form-control" required>
                                        @if($is_tranding == '1')
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                        @else
                                        <option value="1" >Yes</option>
                                        <option value="0" selected>No</option>
                                        @endif
                                    </select>
                                    @error('is_tranding')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{$id}}">
                    </div>
                </div>
            </div> 
            <h2 class="pl-3">Product Images</h2>
            <div class="col-lg-12" id="product_images_box">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row" id="product_image_box">
                                <?php $loop_count_num=1;?>
                                @foreach ($productImageArr as  $key=>$val)
                                <?php $piArr =(array)$val; 
                                    $loop_count_prev=$loop_count_num; 
                                ?>
                                    <input id="piid" name="piid[]" type="hidden" class="form-control" value="{{$piArr['id']}}">
                                    <div class="col-md-4 product_images_{{$loop_count_num++}}">
                                        <label for="images" class="control-label mb-1">Image</label>
                                        <input id="images" name="images[]" type="file" class="form-control">
                                        @if ($piArr['images'] != '')
                                            <img width="80px;" src="{{asset('storage/media/'.$piArr['images'])}}">
                                        @endif
                                        @if ($loop_count_num == 2)    
                                        <button type="button" class="btn btn-primary" onclick="add_images_more()"><i class="fa-solid fa-circle-plus"></i>&nbsp; Add</button>
                                        @else
                                        <a href="{{url('admin/product/product_image_delete/')}}/{{$piArr['id']}}/{{$id}}">
                                            <button type="button" class="btn btn-danger" onclick="remove_images_more({{$loop_count_prev}})"><i class="fa-solid fa-circle-plus"></i>&nbsp; Remove</button></a>
                                        @endif
                                     </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <h2 class="pl-3">Product Attributes</h2>
            <div class="col-lg-12" id="product_attr_box">
                <?php $loop_count_num=1;?>
                @foreach ($productAttrArr as  $key=>$val)
                <?php $pAAtt =(array)$val; 
                    $loop_count_prev=$loop_count_num; 
                ?>
                <input id="paid" name="paid[]" type="hidden" class="form-control" value="{{$pAAtt['id']}}">
                    <div class="card" id="product_attr_{{$loop_count_num++}}">
                        <div class="card-body">
                            <div class="form-group">    
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="sku" class="control-label mb-1">SKU</label>
                                        <input id="sku" name="sku[]" type="text" class="form-control" value="{{$pAAtt['sku']}}" required>
                                    </div>
                            
                                    <div class="col-md-2">
                                        <label for="mrp" class="control-label mb-1">MRP</label>
                                        <input id="mrp" name="mrp[]" type="text" class="form-control" value="{{$pAAtt['mrp']}}" required>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="price" class="control-label mb-1">Price</label>
                                        <input id="price" name="price[]" type="text" class="form-control" value="{{$pAAtt['price']}}" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="size" class="control-label mb-1">Size</label>
                                        <select id="size_id" name="size[]" type="text" class="form-control" required>
                                            <option value="">Select size</option>
                                            @foreach ($size as $list)
                                                @if ($pAAtt['size_id'] == $list->id)
                                                    <option value="{{$list->id}}" selected>{{$list->size}}</option>
                                                @else
                                                    <option value="{{$list->id}}">{{$list->size}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="color" class="control-label mb-1">Color</label>
                                        <select id="color_id" name="color[]" type="text" class="form-control" required>
                                            <option value="">Select color</option>
                                            @foreach ($color as $list)
                                            @if ($pAAtt['color_id'] == $list->id)
                                                <option value="{{$list->id}}" selected>{{$list->color}}</option>
                                                @else
                                                <option value="{{$list->id}}">{{$list->color}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('color')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label for="qty" class="control-label mb-1">Qty</label>
                                        <input id="qty" name="qty[]" type="text" class="form-control" value="{{$pAAtt['qty']}}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="attr_image" class="control-label mb-1">Image</label>
                                        <input id="attr_image" name="attr_image[]" type="file" class="form-control">
                                        @if ($pAAtt['attr_image'] != '')
                                            <img width="80px;" src="{{asset('storage/media/'.$pAAtt['attr_image'])}}">
                                        @endif
                                    </div>
                                </div>
                                @if ($loop_count_num == 2)    
                                <button type="button" class="btn btn-primary" onclick="add_more()"><i class="fa-solid fa-circle-plus"></i>&nbsp; Add</button>
                                @else
                                <a href="{{url('admin/product/product_attr_delete/')}}/{{$pAAtt['id']}}/{{$id}}"><button type="button" class="btn btn-danger" onclick="remove_more({{$loop_count_prev}})"><i class="fa-solid fa-circle-plus"></i>&nbsp; Remove</button></a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach 
            </div>
            <div>
                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                Submit
                </button>
            </div>
        </form>
    </div>
    <!-- END DATA FORM-->
<script>
    var loop_count=1;
    function add_more() {
        loop_count++;
        var html = '<input id="paid" name="paid[]" type="hidden" class="form-control" value=""><div class="card" id="product_attr_'+loop_count+'"><div class="card-body"><div class="form-group"><div class="row">';

            html += '<div class="col-md-2"><label for="sku" class="control-label mb-1">SKU</label><input id="sku" name="sku[]" type="text" class="form-control" value="" required></div>';

            html += '<div class="col-md-2"><label for="mrp" class="control-label mb-1">MRP</label><input id="mrp" name="mrp[]" type="text" class="form-control" value=""required></div>';

            html += '<div class="col-md-2"><label for="price" class="control-label mb-1">Price</label><input id="price" name="price[]" type="text" class="form-control" value="" required></div>';

            var size_id_html = $('#size_id').html();
            var size_id_html = size_id_html.replace("selected", "");
            html +='<div class="col-md-2"><label for="size" class="control-label mb-1">Size</label><select id="size_id" name="size[]" type="text" class="form-control" required>'+ size_id_html +'</select></div>'
            
            var color_id_html = $('#color_id').html();
            var color_id_html = color_id_html.replace("selected", "");
            html += '<div class="col-md-3"><label for="color" class="control-label mb-1">Color</label><select id="color_id" name="color[]" type="text" class="form-control" required>'+ color_id_html +'</select></div>';

            html += '<div class="col-md-2"><label for="qty" class="control-label mb-1">Qty</label><input id="qty" name="qty[]" type="text" class="form-control" value=""></div>';

            html += '<div class="col-md-4"><label for="attr_image" class="control-label mb-1">Image</label><input id="attr_image" name="attr_image[]" type="file" class="form-control" value="" required></div>';

            html += '<div class="col-md-2"><label for="attr_image" class="control-label mt-5"></label> <button type="button" class="btn btn-danger btn-lg" onclick=remove_more("'+ loop_count +'")><i class="fa-solid fa-circle-minus"></i>&nbsp; Remove</button></div>';

            html+='</div></div></div></div>';

            $('#product_attr_box').append(html);
    }
    function remove_more(loop_count){
        $('#product_attr_'+loop_count).remove();
    }

    loop_image_count=1;
    function add_images_more() {
        loop_image_count++;
        var html = '<div class="col-md-4 product_images_'+loop_image_count+'"><input id="piid" type="hidden" name="piid[]" value=""><label for="images" class="control-label mb-1">Image</label><input id="images" name="images[]" type="file" class="form-control" value="" required></div>';

        html += '<div class="col-md-2 product_images_'+loop_image_count+'"><label for="images" class="control-label mt-5"></label> <button type="button" class="btn btn-danger" onclick=remove_image_more("'+ loop_image_count +'")><i class="fa-solid fa-circle-minus"></i>&nbsp; Remove</button></div>';

        $('#product_image_box').append(html);
    }

    function remove_image_more(loop_image_count){
        $('.product_images_'+loop_image_count).remove();
    }
</script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor 4
    // instance, using default configuration.
    CKEDITOR.replace( 'short_decs' );
    CKEDITOR.replace( 'decs' );
    CKEDITOR.replace( 'technical_specification' );
</script>
@endsection