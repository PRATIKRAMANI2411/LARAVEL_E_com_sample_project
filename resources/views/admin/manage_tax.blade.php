@extends('admin/layout')
@section('page_title', 'Manage Tax')
@section('container')

    <h1 class="mb10">Manage Tax</h1>
    <a href="{{url('admin/tax')}}">
        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Back</button>
    </a>
<div class="row m-t-30">
        <!-- DATA FORM-->
    <div class="col-lg-12">
    {{session('message')}}
        <div class="card">
            <div class="card-body">
                <form action="{{route('tax.manege_tax_process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="tax_desc" class="control-label mb-1">Tax desc</label>
                        <input id="tax_desc" name="tax_desc" type="text" class="form-control" value="{{$tax_desc}}">
                        @error('tax_desc')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tax_value" class="control-label mb-1">Tax value</label>
                        <input id="tax_value" name="tax_value" type="text" class="form-control" value="{{$tax_value}}">
                        @error('tax_value')
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