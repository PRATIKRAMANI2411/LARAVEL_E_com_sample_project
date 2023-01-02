@extends('admin/layout')
@section('page_title', 'Manage Size')
@section('container')

    <h1 class="mb10">Manage Sizey</h1>
    <a href="{{url('admin/size')}}">
        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Back</button>
    </a>
<div class="row m-t-30">
        <!-- DATA FORM-->
    <div class="col-lg-12">
    {{session('message')}}
        <div class="card">
            <div class="card-body">
                <form action="{{route('size.manege_size_process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="size" class="control-label mb-1">size</label>
                        <input id="size" name="size" type="text" class="form-control" value="{{$size}}">
                        @error('size')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
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