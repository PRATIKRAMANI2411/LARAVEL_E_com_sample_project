@extends('admin/layout')
@section('page_title', 'Manage Color')
@section('container')

    <h1 class="mb10">Manage Color</h1>
    <a href="{{url('admin/color')}}">
        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Back</button>
    </a>
<div class="row m-t-30">
        <!-- DATA FORM-->
    <div class="col-lg-12">
    {{session('message')}}
        <div class="card">
            <div class="card-body">
                <form action="{{route('color.manege_color_process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="color" class="control-label mb-1">Color</label>
                        <input id="color" name="color" type="text" class="form-control" value="{{$color}}">
                        @error('color')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
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