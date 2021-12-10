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
                   <div class="col-12 col-md-12">
                      <br/>
                       <div class="card p-3">
                           
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                  <span class="info-box-icon bg-warning"><i class="far fa-clock"></i></span>
                    
                                  <div class="info-box-content">
                                    <span class="info-box-text">Pending orders</span>
                                    <span class="info-box-number" id="pending">0</span>
                                  </div>
                                  <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                              </div>

                              <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                  <span class="info-box-icon bg-info"><i class="far fa-thumbs-up"></i></span>
                    
                                  <div class="info-box-content">
                                    <span class="info-box-text">Approved order</span>
                                    <span class="info-box-number" id="approved">0</span>
                                  </div>
                                  <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                              </div>

                              <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                  <span class="info-box-icon bg-success"><i class="fas fa-check"></i></span>
                    
                                  <div class="info-box-content">
                                    <span class="info-box-text">Termined orders</span>
                                    <span class="info-box-number" id="termined">0</span>
                                  </div>
                                  <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                              </div>

                              <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                  <span class="info-box-icon bg-secondary"><i class="fas fa-check"></i></span>
                    
                                  <div class="info-box-content">
                                    <span class="info-box-text">Canceled orders</span>
                                    <span class="info-box-number" id="canceled">0</span>
                                  </div>
                                  <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                              </div>
                        </div>

                        <div class="row mt-5">

                          <div class="col-12 col-md-12">
                            <img src="{{asset('img/banner.png')}}" alt="" style="max-width:250px;">
                           </div>
                           <div class="col-12 col-md-12 mb-5">
                            Illustration by <a href="https://icons8.com/illustrations/author/5eb50ac301d03600141ee1f9">Aleksandr Smetanov</a> from <a href="https://icons8.com/illustrations">Ouch!</a>
                          
                           </div>

                        </div>
                          
                        </div>  
                   </div>    
               </div>   
       
           
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> 

    
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
    datoss = new FormData();
    datoss.append("_token", CSRF_TOKEN);
    $.ajax({
                type: "POST",
                url: "/get_data_panel",
                processData: false,
                contentType: false,
                data: datoss,
                dataType: "JSON",
                success: function (response) {
                   $("#pending").text(response["pending_orders"]);
                   $("#approved").text(response["approved_orders"]);
                   $("#termined").text(response["termined_orders"]);
                   $("#canceled").text(response["canceled_orders"]);
                }
            });
    
    </script>
@stop