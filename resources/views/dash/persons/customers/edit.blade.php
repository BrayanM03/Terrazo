@extends('adminlte::page')

@section('title', 'Edit Material')

@section('content_header')
<div class="row justify-content-center">
    <div class="col-12 col-md-12 text-center">
    <h1>Edit Customer</h1>
    <div class="row justify-content-center">
    <div class="col-12 col-md-3">
@stop

@section('content')
    <div class="row justify-content-center">
    <div class="col-12 col-md-12 text-center">
    <p>From here you can edit the customer.</p>
    <div class="row justify-content-center">
     <div class="col-12 col-md-12">
        <div class="container">
        <div class="row justify-content-end">
            <div class="col-12 col-md-12">

                <form action="../{{$customer->id}}" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')
                   
                    <div class="row mb-3 justify-content-center">
                        <div class="col-12 col-md-3">
                                <label for="name" class="form-label">Store number</label>
                                <input type="text" class="form-control" placeholder="Type store code" name="store_number" value="{{$customer->store_number}}" id="store_number" tabindex="1" required>
                        </div>
                    </div>

                    <div class="row mb-3 justify-content-center">
                        <div class="col-12 col-md-5">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" placeholder="Type customer's name" name="name" value="{{$customer->name}}" id="name" tabindex="1" required>
                        </div>
                    </div>

                    <div class="row mb-3 justify-content-center">
                        <div class="col-12 col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <textarea type="text" class="form-control" placeholder="Type customer's address" name="address" id="address" tabindex="2" required>{{$customer->address}}</textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-3 justify-content-center">
                        <div class="col-12 col-md-3">
                            <label for="number" class="form-label">Number</label>
                            <input type="text" class="form-control" placeholder="Type customer's number" name="number" value="{{$customer->number}}" id="number" tabindex="3">
                        </div>
                    </div>

                    <div class="row mb-3 justify-content-center">
                        <div class="col-12 col-md-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" placeholder="Type customer's email" value="{{$customer->email}}" name="email" id="number" tabindex="3">
                        </div>
                    </div>

                    <a href="../../customers" class="btn btn-info mr-3">Cancel</a>
                    <button type="submit" class="btn btn-success" tabindex="4">Update</button>
                </form>
               
            </div>    
        </div>   

    
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop