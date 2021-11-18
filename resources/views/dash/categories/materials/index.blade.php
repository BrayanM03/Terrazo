@extends('adminlte::page')

@section('title', 'Material')

@section('content_header')
<div class="row justify-content-center">
    <div class="col-12 col-md-12 text-center">
    <h1>Material</h1>
    <div class="row justify-content-center">
    <div class="col-12 col-md-3">
@stop

@section('content')
    <div class="row justify-content-center">
    <div class="col-12 col-md-12 text-center">
    <p>List of materials, you can add more.</p>
    <div class="row justify-content-center">
     <div class="col-12 col-md-12">
        <div class="container">
        <div class="row justify-content-end">
            <div class="col-12 col-md-12">
                <a href="materials/create"><div class="btn btn-primary">Add</div></a>
            </div>    
        </div>   

        <div class="row mt-3 justify-content-center">
            <div class="col-12 col-md-12">
                
                 <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <th>#</th>
                    <th>Unity</th>
                    <th>Description</th>
                    <th>Unit Price</th>
                     <th>Actions</th>

                </thead>
                <tbody class="bg-white">
                    @foreach ($materials as $material)
                        <tr>
                            <td>{{ $material->id}}</td>
                            <td>{{ $material->unit}}</td>
                            <td>{{ $material->description}}</td>
                            <td>{{ $material->unit_price}}</td>
                            <td style="display:flex;">
                                <a class="btn btn-warning mr-2" href="materials/{{ $material->id}}/edit"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            </div>    
        </div> 
           
        </div>
    </div>
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop