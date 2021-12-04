@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
<div class="row justify-content-center">
    <div class="col-12 col-md-12 text-center">
    <h1>Hi {{ auth()->user()->name }} </h1>
    <div class="row justify-content-center">
    <div class="col-12 col-md-3">
@stop

@section('content')
    <div class="row justify-content-center">
    <div class="col-12 col-md-12 text-center">
    <p>Welcome to your administration panel.</p>
    <div class="row justify-content-center">

        <div class="row justify-content-center">
            <div class="col-12 col-md-12">
               <div class="container-fluid mt-3">
               <div class="row justify-content-center">
                   <div class="col-12 col-md-8">
                      <br/>
                       <div class="card">
                           
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                  <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                    
                                  <div class="info-box-content">
                                    <span class="info-box-text">Messages</span>
                                    <span class="info-box-number">1,410</span>
                                  </div>
                                  <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                              </div>
                        </div>
                          
                        </div>  
                   </div>    
               </div>   
       
               <div class="row mt-3 justify-content-center">
                   <div class="col-12 col-md-12">
                      
       
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