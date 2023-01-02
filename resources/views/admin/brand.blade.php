@extends('admin/layout')
@section('page_title', 'Brand')
@section('brand', 'active')
@section('container')
    @if(session()->has('message'))
         <div class="alert au-alert-success alert-dismissible fade show au-alert au-alert--70per" role="alert">
        <i class="zmdi zmdi-check-circle"></i>
        <span class="content">{{session('message')}}</span>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
                <i class="zmdi zmdi-close-circle"></i>
            </span>
        </button>
    </div>
    @endif
    <h1 class="mb10">Brand</h1>
    <a href="brand/manage_brand">
        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Brand</button>
    </a>
<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th class="text-center">Brand</th>
                        <th class="text-center">image</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td class="text-center">{{$list->name}}</td>
                        <td class="text-center">
                            @if ($list->image != '')
                            <img width="80px;" src="{{asset('storage/media/'.$list->image)}}">
                            @endif
                        </td>
                        <td class="text-center">
                        <a href="{{url('admin/brand/delete')}}/{{$list->id}}"><button class="btn btn-danger" type="submit">Delete</button></a>
                        <a href="{{url('admin/brand/manage_brand')}}/{{$list->id}}"><button class="btn btn-success" type="submit">Edit</button></a>
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