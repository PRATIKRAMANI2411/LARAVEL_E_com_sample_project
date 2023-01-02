@extends('admin/layout')
@section('page_title', 'Coupon')
@section('coupon_select', 'active')
@section('container')
    @if(session()->has('message'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            {{session('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    <h1 class="mb10">Coupon</h1>
    <a href="coupon/manage_coupon">
        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Category</button>
    </a>
<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th class="text-center">Title</th>
                        <th class="text-center">Code</th>
                        <th class="text-center">value</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td class="text-center">{{$list->title}}</td>
                        <td class="text-center">{{$list->code}}</td>
                        <td class="text-center">{{$list->value}}</td>
                        <td>
                            @if($list->status==1)
                                <a href="{{url('admin/coupon/status/0')}}/{{$list->id}}"><button class="btn btn-outline-info" type="submit">Active</button></a>
                            @elseif($list->status==0)
                                <a href="{{url('admin/coupon/status/1')}}/{{$list->id}}"><button class="btn btn-outline-secondary" type="submit">Deactive</button></a>
                            @endif
                        </td>
                        <td>
                        <a href="{{url('admin/coupon/delete')}}/{{$list->id}}"><button class="btn btn-danger" type="submit">Delete</button></a>
                        <a href="{{url('admin/coupon/manage_coupon')}}/{{$list->id}}"><button class="btn btn-success" type="submit">Edit</button></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>


@endsection