@extends('adminlte::page')

@section('title', 'Edit Material')

@section('content_header')
<div class="row justify-content-center">
    <div class="col-12 col-md-12 text-center">
    <h1>Edit Material</h1>
    <div class="row justify-content-center">
    <div class="col-12 col-md-3">
@stop

@section('content')
    <div class="row justify-content-center">
    <div class="col-12 col-md-12 text-center">
    <p>From here you can edit the material.</p>
    <div class="row justify-content-center">
     <div class="col-12 col-md-12">
        <div class="container">
        <div class="row justify-content-end">
            <div class="col-12 col-md-12">

                <form action="../{{$material->id}}" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')
                   
                    <div class="row mb-3 justify-content-center">
                        <div class="col-12 col-md-3">
                                <label for="unity" class="form-label">Unit</label>
                                <input type="text" class="form-control" placeholder="Unit" name="unit" id="unit" tabindex="1" value="{{$material->unit}}" required>
                        </div>
                    </div>

                    <div class="row mb-3 justify-content-center">
                        <div class="col-12 col-md-6">
                            <label for="unity" class="form-label">Description</label>
                            <textarea type="text" class="form-control" placeholder="Type description here" name="description" id="description" tabindex="2" required>{{$material->description}}</textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-3 justify-content-center">
                        <div class="col-12 col-md-3">
                            <label for="unity" class="form-label">Unit price</label>
                            <input type="number" class="form-control" step="any" placeholder="0.00" name="unit_price" id="unit_price" value="{{$material->unit_price}}" tabindex="3" required>
                        </div>
                    </div>

                    <a href="../../materials" class="btn btn-info mr-3">Cancel</a>
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