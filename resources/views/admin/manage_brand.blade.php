@extends('admin/layout')
@section('page_title', 'Manage Brand')
@section('container')

    <h1 class="mb10">Manage Brand</h1>
    <a href="{{url('admin/brand')}}">
        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Back</button>
    </a>
<div class="row m-t-30">
        <!-- DATA FORM-->
    <div class="col-lg-12">
    {{session('message')}}
        <div class="card">
            <div class="card-body">
                <form action="{{route('brand.manege_brand_process')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nmae" class="control-label mb-1">Brand</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{$name}}">
                        @error('color')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group has-success">
                        <label for="image" class="control-label mb-1">Image</label>
                        <input id="image" name="image" type="file" value="{{$image}}" class="form-control" required="" data-dashlane-rid="373a8fbf3d402aff" data-form-type="">
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