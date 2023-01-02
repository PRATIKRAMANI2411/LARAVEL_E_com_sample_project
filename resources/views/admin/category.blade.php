@extends('admin/layout')
@section('page_title', 'Category')
@section('category_select', 'active')
@section('container')
    @if(session()->has('message'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            {{session('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    <h1 class="mb10">Category</h1>
    <a href="category/manage_category">
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
                        <th class="text-center">Category Name</th>
                        <th class="text-center">Category Slug</th>
                        <th class="text-center">status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td class="text-center">{{$list->category_name}}</td>
                        <td class="text-center">{{$list->category_slug}}</td>
                        <td class="text-center">
                        @if($list->status==1)
                            <a href="{{url('admin/category/status/0')}}/{{$list->id}}"><button class="btn btn-outline-info" type="submit">Activ</button></a>
                        @elseif($list->status==0)
                            <a href="{{url('admin/category/status/1')}}/{{$list->id}}"><button class="btn btn-outline-secondary" type="submit">Deactiv</button></a>
                        @endif
                        </td>
                        <td class="text-center">
                        <a href="{{url('admin/category/delete')}}/{{$list->id}}"><button class="btn btn-danger" type="submit">Delete</button></a>
                        <a href="{{url('admin/category/manage_category')}}/{{$list->id}}"><button class="btn btn-success" type="submit">Edit</button></a>
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