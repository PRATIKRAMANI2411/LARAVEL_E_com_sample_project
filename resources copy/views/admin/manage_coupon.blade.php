@extends('admin/layout')
@section('page_title', 'Manage Coupon')
@section('container')

    <h1 class="mb10">Manage Coupon</h1>
    <a href="{{url('admin/coupon')}}">
        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Back</button>
    </a>
<div class="row m-t-30">
        <!-- DATA FORM-->
    <div class="col-lg-12">
    {{session('message')}}
        <div class="card">
            <div class="card-body">
                <form action="{{route('coupon.manege_coupon_process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="control-label mb-1">Title</label>
                        <input id="title" name="title" type="text" class="form-control" value="{{$title}}">
                        @error('title')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group has-success">
                        <label for="code" class="control-label mb-1">Code</label>
                        <input id="code" name="code" type="text" class="form-control" value="{{$code}}">
                        @error('code')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group has-success">
                                <label for="value" class="control-label mb-1">Value</label>
                                <input id="value" name="value" type="text" class="form-control" value="{{$value}}">
                                @error('value')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="type" class="control-label mb-1">Type</label>
                            <select id="type" name="type" type="text" class="form-control">
                                @if($type == 'value')
                                <option value="value" selected>value</option>
                                <option value="per">per</option>
                                @elseif($type == 'per')
                                <option value="value">Value</option>
                                <option value="per" selected>Per</option>
                                @else
                                <option value="value">Value</option>
                                <option value="per">Per</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-6">
                            <div class="form-group has-success">
                                <label for="min_order_amt" class="control-label mb-1">Min Order Amt</label>
                                <input id="min_order_amt" name="min_order_amt" type="text" class="form-control" value="{{$min_order_amt}}">
                                @error('min_order_amt')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="is_one_time" class="control-label mb-1">is one time</label>
                            <select id="is_one_time" name="is_one_time" type="text" class="form-control">
                                @if($is_one_time == '1')
                                <option value="1" selected>Yes</option>
                                <option value="0">No</option>
                                @else
                                <option value="1" >Yes</option>
                                <option value="0" selected>No</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">Submit</button>
                    </div>
                    <input type="hidden" name="id" value="{{$id}}">
                </form>
            </div>
        </div>
    </div>
        <!-- END DATA FORM-->
</div>


@endsection