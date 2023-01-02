@extends('admin/layout')
@section('page_title', 'Manage Category')
@section('container')

    <h1 class="mb10">Manage Category</h1>
    <a href="{{url('admin/category')}}">
        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Back</button>
    </a>
<div class="row m-t-30">
        <!-- DATA FORM-->
    <div class="col-lg-12">
    {{session('message')}}
        <div class="card">
            <div class="card-body">
                <form action="{{route('category.manege_category_process')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="category_name" class="control-label mb-1">category</label>
                                <input id="category_name" name="category_name" type="text" class="form-control" value="{{$category_name}}">
                            </div>
                            <div class="col-md-4">
                                <label for="cc-name" class="control-label mb-1">category Slug</label>
                                <input id="category_slug" name="category_slug" type="text" class="form-control" value="{{$category_slug}}">
                                @error('category_slug')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="category" class="control-label mb-1">Parent category</label>
                                <select id="parent_category_id" name="parent_category_id" type="text" class="form-control" required>
                                    <option value="">Select category</option>
                                    @foreach ($category as $list)
                                    <option value="{{$list->id}}" @if ($parent_category_id==$list->id) selected @endif>{{$list->category_name}}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                {{-- <label for="category_image" class="control-label mb-1">Category Image</label> --}}
                                {{-- <input id="category_image" name="category_image[]" type="file" class="form-control"> --}}
                                {{-- @if ($pAAtt['category_image'] != '') --}}
                                    {{-- <img width="80px;" src="{{asset('storage/media/'.$pAAtt['category_image'])}}"> --}}
                                {{-- @endif --}}
                            </div>
                        </div>
                    </div>
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        Submit
                        </button>
                    </div>
                    <input type="hidden" name="id" value="{{$id}}">
                </form>
            </div>
        </div>
    </div>
        <!-- END DATA FORM-->
</div>


@endsection