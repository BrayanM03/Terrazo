@extends('adminlte::page')



@section('title', 'New Order')

@section('content_header')
<div class="row justify-content-center">
    <div class="col-12 col-md-12 text-center">
    <h1>Contract Order</h1>
    <div class="row justify-content-center">
    <div class="col-12 col-md-3">
@stop

@section('content')
    <div class="row justify-content-center">
    <div class="col-12 col-md-12 text-center">
    <p>Generate a new work order Frome here.</p>
    
    <div class="row justify-content-center">
     <div class="col-12 col-md-12">
        <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12">
               <br/>
                <div class="card" id="primer_form">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-7 p-3">
                            <label for="customer">Customer:</label><br>
                            <select type="text" class="form-control" id="customer" name="customer">
                               {{--  <option value="null">Select a customer</option> --}}
                               
                            </select>   
                        </div>
                        <div class="col-12 col-md-3 p-3">
                            <label for="date">Date</label><br>
                            <input class="form-control" type="date" id="date" name="date">
                        </div>
                    </div>

                    <div class="row justify-3 justify-content-center">
                        <div class="col-12 col-md-7 p-3">
                            <label for="re">Re</label><br>
                            <input type="text" class="form-control" name="re" id="re" placeholder="Type asunt">
                        </div>

                        <div class="col-12 col-md-3 p-3">
                            <label for="re">Store number</label><br>
                            <input type="text" class="form-control disabled" name="store_number" id="store_number" placeholder="Store number" disabled>
                        </div>
                    </div>

                    <div class="row justify-3 justify-content-center mb-3">
                        <div class="col-12 col-md-10 p-3">
                            <label for="re">Sow</label><br>
                            <textarea type="text" class="form-control" name="sow" id="sow" placeholder="Type sow"></textarea>
                        </div>
                    </div>

                    <div class="row justify-3 justify-content-center mb-3">
                        <div class="col-12 col-md-10 p-3">
                            <a href="../orders"><div class="btn btn-danger mr-2">Cancel</div></a>
                            <button class="btn btn-primary" onclick="recogerInfomacion();">Next</button>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">  
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        .select2-selection{
            text-align: left;
        
        }

    .select2-selection__rendered {
        line-height: 31px !important;
        margin-top: -5px !important;
    }
    .select2-container .select2-selection--single {
        height: 35px !important;
    }
    .select2-selection__arrow {
        height: 34px !important;
    }
    
    </style>
@stop

@section('js')
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('eliminar') == 'ok')
     <script>
         Swal.fire(
            'Deleted!',
            'Your register has been deleted.',
            'success'
            )
     </script>
@endif

@if(session('actualizar') == 'ok')
     <script>
         Swal.fire(
            'Updated!',
            'Your register has been updated.',
            'success'
            )
     </script>
@endif

@if(session('agregar') == 'ok')
     <script>
         Swal.fire(
            'Added!',
            'Your register has been add.',
            'success'
            )
     </script>
@endif



<script>


var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


$('#customer').select2({
    placeholder: "Select a customer",
    allowClear: true,
            ajax: {
                
                dataType: 'json',
                url: "{{ route('getCustomers') }}",
                type: 'post',
               
                delay: 150,
              
                data: function(params) {
                    return {
                        _token: CSRF_TOKEN,
                        search: params.term
                    }
                },
                processResults: function (response) {
                  return {
                    results: response 
                  };
                },
                

                cache: true
            },  
            templateResult: formatRepo,   
            templateSelection: formatRepoSelection     

});

//Plantilla Select2
function formatRepo (repo) {
  if (repo.loading) {
    return repo.text;
  }

  var $container = $(
    "<div><div style='display:flex; justify-content:space-between; padding:4px;'>"+ repo.text +"<span class='badge badge-warning badge-pill'>"+ repo.code_store +"</span></div></div>" 
  );

  return $container;
}

function formatRepoSelection (repo) {
  $("#store_number").val(repo.code_store)  
  return repo.text || repo.code_store;
  
}

//FIN funciones Select 2

function recogerInfomacion() { 

     customer = $("#customer").val();
     date = $("#date").val();
     re = $("#re").val();
     sow = $("#sow").val();
     store_number = $("#store_number").val();

     let datos = new FormData();
      
         datos.append("customer_id", customer);
         datos.append("_token", CSRF_TOKEN);
         datos.append("re", re)
         datos.append("date", date)
         datos.append("sow", sow)
         datos.append("store_number", store_number) 
         flag = 0; //Validador
         
/* 
         for (let [key, value] of datos) {

            if(value == null || value == ""){

                Swal.fire({
                        //position: 'top-end',
                        icon: 'warning',
                        title: 'Warning',
                        html: '<span>Fill the empty inputs</span>',
                        showConfirmButton: true,
                        timer: 5500
                        });
                 flag = 1;       
            }      
        }
         */
        //Si validacion OK entonces 
        if(flag == 0){

            $.ajax({
                    type: "POST",
                    url: "/saveGeneralDataOrder",
                    processData: false,
                    contentType: false,
                    data: datos,
                    dataType: "JSON",
                    success: function (response) {
                        console.log(response);
                    }
                });
            

                $("#primer_form").empty(); //Borramos el primer formulario

                //Hacer una peticion para comprobar la existencia de las tablas
                formDatas = new FormData();
                formDatas.append("_token", CSRF_TOKEN);
                $.ajax({
                    type: "POST",
                    url: "/checktables",
                    processData: false,
                    contentType: false,
                    data: formDatas,
                    dataType: "JSON",
                    success: function (response) {
                        console.log(response.msj);
                    }
                });


                $("#primer_form").append(`
                        <div class="contenedor animate__animated animate__headShake">
                               
                            <div class="row justify-content-center p-3">
                               

                                <div class="col-12 col-md-12">
                                    <b>Good, now add the order concepts</b><br>
                                    Search the concepts in the category search engine<br>  
                                      
                                </div>
                            </div>

                            <div class="row justify-content-center align-items-center">
                            <div class="col-12 col-md-10">

                            <div class="row justify-content-center p-3">
                                <div class="col-12 col-md-3"> 
                                    <p>Category</p>
                                    <select input class="form-control" id="category" name="category" onchange="ChangeCategory();">
                                        <option value="null">Select category</option>
                                        <option value="material">Materials</option>
                                        <option value="equiptment">Equiptments</option>
                                        <option value="labor">Labors</option>
                                        <option value="other">Other expenses</option>
                                    </select>      
                                </div>

                                <div class="col-12 col-md-5"> 
                                    <p>Concept</p>
                                    <select class="form-control" id="concept_select" name="concept_select" disabled>
                                      
                                    </select> 
                                    <div class="invalid-feedback">Choose a option</div>     
                                </div>

                                <div class="col-12 col-md-2">
                                    <p>Price</p> 
                                    <input class="form-control" id="price" name="price" placeholder="0.00">    
                                </div>

                                <div class="col-12 col-md-2">
                                    <p>Qty</p> 
                                    <input class="form-control" type="number" id="qty" name="qty" placeholder="0">  
                                    <div class="invalid-feedback">Set qty</div>   
                                </div>

                                <div class="col-12 col-md-2" style="margin-top:39px;"> 
                                    <div unit="" id_reg="" id="btn-add" class="btn btn-md btn-info" onclick="AddConcept()">Add</div>      
                                </div>

                            </div>
                            </div>
                            </div>

                            <div class="row mt-5 m-3 justify-content-center">
                                <div class="col-12 col-md-12">

                                        <div id="card-materials" class="card">
                                            <div class="card-header" style="background-color: #009846; color: white;">
                                                <h3 class="card-title">Materials table</h3>
                                                Total: $ <div class="badge badge-warning badge-pill" width="100" id="total_amount_material">0.00</div>
                                                <div class="card-tools">
                                                <button type="button" id="plus-btn-material" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                </div>
                                            </div>
                                
                                            <div class="card-body">
                                               <div class="contenedor">
                                                <table id="materials_table" class="table table-bordered table-hover">
                                                    <thead class="table-success">
                                                        <tr>
                                                        <th>#</th>
                                                        <th>Qty</th>
                                                        <th>Unit</th>
                                                        <th>Code</th>
                                                        <th>Materials</th>
                                                        <th>Unit Price</th>
                                                        <th>Amount</th>
                                                        <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    
                                                </table> 
                                               </div>
                                            </div>
                                        </div> 
                                                 
                                </div>


                                <div class="col-12 col-md-12">

                                    <div class="card">
                                            <div class="card-header" style="background-color: #FFE900; color: black;">
                                                <h3 class="card-title">Equiptments table</h3>
                                                Total: $ <div class="badge badge-primary badge-pill" width="100" id="total_amount_equiptment">0.00</div>
                                                <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                </div>
                                            </div>
                                
                                            <div class="card-body">
                                               
                                                <table id="equiptments_table" class="table table-bordered table-hover responsive">
                                                    <thead class="table-warning">
                                                        <th>#</th>
                                                        <th>Qty</th>
                                                        <th>Unity</th>
                                                        <th>Code</th>
                                                        <th>Equiptments</th>
                                                        <th>Unit Price</th>
                                                        <th>Amount</th>
                                                        <th>Actions</th>
                                                    </thead>
                                                
                                                </table>
                                                
                                            </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row m-3">
                                <div class="col-12 col-md-12">

                                    <div class="card">
                                            <div class="card-header" style="background-color: #0070B8; color: white">
                                                <h3 class="card-title">Labors table</h3>
                                                Total: $ <div class="badge badge-warning badge-pill" width="100" id="total_amount_labor">0.00</div>
                                                <div class="card-tools">    
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                </div>
                                            </div>
                                
                                            <div class="card-body">
                                                <table id="labors_table" class="table table-bordered table-hover responsive">
                                                    <thead class="table-primary">
                                                        <th>#</th>
                                                        <th>Qty</th>
                                                        <th>Unity</th>
                                                        <th>Code</th>
                                                        <th>Labors</th>
                                                        <th>Price per hour</th>
                                                        <th>Amount</th>
                                                        <th>Actions</th>
                                                    </thead>
                                                
                                                </table>
                                            </div>
                                            </div>      
                                </div>


                                <div class="col-12 col-md-12">

                                    <div class="card">
                                            <div class="card-header" style="background-color: #E60026; color: white">
                                                <h3 class="card-title">Other expenses table</h3>
                                                Total: $ <div class="badge badge-warning badge-pill" width="100" id="total_amount_other">0.00</div>
                                                <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                </div>
                                            </div>
                                
                                            <div class="card-body">
                                                <table id="other_table" class="table table-bordered table-hover responsive">
                                                    <thead class="table-danger">
                                                        <th>#</th>
                                                        <th>Qty</th>
                                                        <th>Unity</th>
                                                        <th>Code</th>
                                                        <th>Other expenses</th>
                                                        <th>Unit Price</th>
                                                        <th>Amount</th>
                                                        <th>Actions</th>
                                                    </thead>
                                                
                                                </table>
                                            </div>
                                        </div>          
                                </div>

                                
                                   
                                    <div class="col-12 col-md-4 mt-5 mb-4">
                                      
                                        <label>Sub total</label>
                                        <input class="form-control" id="sub_total" type="text" placeholder="sub total" disabled></input>
                                        
                                    </div> 

                                    <div class="col-12 col-md-4 mt-5 mb-4">
                                       
                                        <label>7% Subcontractor fee</label>
                                        <input class="form-control" id="contract" type="text" placeholder="Contract fee" disabled></input>
                                        
                                    </div> 

                                    <div class="col-12 col-md-4 mt-5 mb-4">
                                       
                                        <label>Grand total</label>
                                        <input class="form-control" type="text" id="grand_total" placeholder="Grand total" disabled></input>
                                       
                                    </div> 


                                        <div class="col-12 col-md-12 mt-4 mb-4">
                                        <div class="btn btn-success mr-3" onclick="Register()">Registrar</div>  
                                        </div>  
                        </div>

                         </div>`);

                        //Definiendo datatables
                         tab1 = $("#materials_table").DataTable({
 
                            processing: true,
                            serverSide: true,
                            "scrollY": "250px",
                            "responsive" : true,
                            "ajax": "{{route('datatable.material_tmp')}}",
                            "columns": [
                                {data: 'id'},
                                {data: 'qty'},
                                {data: 'unit'},
                                {data: 'code'},
                                {data: 'description'},
                                {data: 'price'},
                                {data: 'amount'},
                                {data: 'actions'},
                               
                            ],
                            "processing": true,
                            "language": {
                                  processing: '<i class="fa fa-spinner fa-spin fa-fw"></i><span class="sr-only">Loading...</span> '},
 
                            });

                            tab2 = $("#equiptments_table").DataTable({
 
                            processing: true,
                            serverSide: true,
                            "scrollY": "250px",
                            "responsive" : true,
                            "ajax": "{{route('datatable.equiptment_tmp')}}",
                            "columns": [
                                {data: 'id'},
                                {data: 'qty'},
                                {data: 'unit'},
                                {data: 'code'},
                                {data: 'description'},
                                {data: 'price'},
                                {data: 'amount'},
                                {data: 'actions'},
                               
                            ],
                            "processing": true,
                            "language": {
                                  processing: '<i class="fa fa-spinner fa-spin fa-fw"></i><span class="sr-only">Loading...</span> '},
 
                            });

                             tab3 = $("#labors_table").DataTable({
 
                            processing: true,
                            serverSide: true,
                            "scrollY": "250px",
                            "responsive" : true,
                            "ajax": "{{route('datatable.labor_tmp')}}",
                            "columns": [
                                {data: 'id'},
                                {data: 'qty'},
                                {data: 'unit'},
                                {data: 'code'},
                                {data: 'description'},
                                {data: 'price'},
                                {data: 'amount'},
                                {data: 'actions'},
                               
                            ],
                            "processing": true,
                            "language": {
                                  processing: '<i class="fa fa-spinner fa-spin fa-fw"></i><span class="sr-only">Loading...</span> '},
 
                            });

                             tab4 = $("#other_table").DataTable({
 
                            processing: true,
                            serverSide: true,
                            "scrollY": "250px",
                            "responsive" : true,
                            "ajax": "{{route('datatable.other_tmp')}}",
                            "columns": [
                                {data: 'id'},
                                {data: 'qty'},
                                {data: 'unit'},
                                {data: 'code'},
                                {data: 'description'},
                                {data: 'price'},
                                {data: 'amount'},
                                {data: 'actions'},
                               
                            ],
                            "processing": true,
                            "language": {
                                  processing: '<i class="fa fa-spinner fa-spin fa-fw"></i><span class="sr-only">Loading...</span> '},
 
                            });

                            $("#qty").keyup(function(){ 
                                    thisval = $("#qty").val();
                                    console.log(thisval);
                                    if(thisval == null || thisval == '' || thisval.length == 0 || thisval == 0){

                                    }else{
                                        $("#qty").removeClass("is-invalid");
                                    }
                                })


                                return datos;    

        }
    
 }

 

 function ChangeCategory(){
        category = $("#category").val();
      
        if(category == "null"){
            $("#concept_select").prop("disabled",true);
            $("#btn-add").attr("id_reg", null);
            $("#concept_select").val(null);
        }else{
            $("#concept_select").prop("disabled",false);

            compr = $("#concept_select").hasClass("is-invalid"); //Comprobamos la clase del description
                    console.log(compr);
                    if(compr == true){
                        $("#concept_select").removeClass("is-invalid");
                    }else{
                        //$("#concept_select").addClass("is-invalid");
                    }

            switch (category) {
                case "material":
                    route = "{{ route('getMaterials') }}"
                    break;

                case "equiptment":
                    route = "{{ route('getEquiptments') }}"
                    break;

                case "labor":
                    route = "{{ route('getLabors') }}"
                    break;

                case "other":
                    route = "{{ route('getOtherExpenses') }}"
                    break;            
            
                default:
                    break;
            }
        }


        $("#concept_select").select2({

            placeholder: "Select a concept",
           
            ajax: {
                
                dataType: 'json',
                url: route,
                type: 'post',      
                delay: 150,
              
                data: function(params) {
                    return {
                        _token: CSRF_TOKEN,
                        search: params.term
                    }
                },
                processResults: function (response) {
                  return {
                    results: response 
                  };
                },
                

                cache: true
            },  
            templateResult: formatRepos,   
            templateSelection: formatRepoSelections

        }).on('select2:selecting', function(event){
  
  $('#concept_select').find('option').remove();
});

           

 } 
 
          //Plantilla Select2
          function formatRepos (repo) {
            if (repo.loading) {
                return repo.description;
            }

            var $container = $(
                "<div><div style='display:flex; justify-content:space-between; padding:4px;'>"+ repo.description +"<span class='badge badge-warning badge-pill'>"+ repo.price +"</span></div></div>" 
            );

            return $container;
            }

            function formatRepoSelections (repo) {
            $("#price").val(repo.price); 
            $("#btn-add").attr("unit", repo.unit);
            $("#btn-add").attr("id_reg", repo.id);

            compr = $("#concept_select").hasClass("is-invalid"); //Comprobamos la clase del description
                    console.log(compr);
                    if(compr == true){
                        $("#concept_select").removeClass("is-invalid");
                    }else{
                        //$("#concept_select").addClass("is-invalid");
                    }
           
            return repo.description;
            
            }
 
 
 //Fin select2

 function AddConcept() {

                 category = $("#category").val();
                 description = $("#concept_select").val();
                 qty = $("#qty").val();
                 price = $("#price").val();  
                 unit = $("#btn-add").attr("unit");  
                 code = $("#btn-add").attr("id_reg");
                 console.log(description);

                 if(price == null || price == ""){  //Comprobamos si esta se selecciono concepto
                    
                    price = 0;
                 }

                 if(description == null || description == ""){  //Comprobamos si esta se selecciono concepto
                    
                    compr = $("#concept_select").hasClass("is-invalid");
                 
                    if(compr == true){
                        //$("#concept_select").has("is-invalid");
                    }else{
                        $("#concept_select").addClass("is-invalid");
                    }

                    return false;
                 }

                 if(qty== null || qty == "" || qty == 0){  //Comprobamos si esta se selecciono concepto
                    
                    compr = $("#qty").hasClass("is-invalid");
                    console.log(compr);
                    if(compr == true){
                        //$("#concept_select").has("is-invalid");
                    }else{
                        $("#qty").addClass("is-invalid");
                    }

                    return false;
                 }



                 var formData = new FormData();
                 formData.append("code", code);
                 formData.append("category", category);
                 formData.append("unit", unit);
                 formData.append("description", description);
                 formData.append("qty", qty);
                 formData.append("price", price);
                 formData.append("_token", CSRF_TOKEN);
                 

                /*  validar_collapse_card = $("#card-materials").hasClass("collapsed-card"); 
                 console.log(validar_collapse_card); */
                 
                 //validar_collapse_card == true ? $("#plus-btn-"+category).click() : console.log("Card abierto");

                $.ajax({
                    type: "POST",
                    url: "/insertdata",
                    processData: false,
                    contentType: false,
                    data: formData,
                    dataType: "JSON",
                    success: function (response) {
                        tab = response["datatable"];
                        console.log(response);
                        switch(tab){
                            case "tab1":
                                tab1.ajax.reload(false, null, true);
                                console.log(response["total_am"]);
                                $("#total_amount_material").text(response["total_am"]);
                                break;
                                
                                case "tab2":
                                tab2.ajax.reload(false, null, true);
                                $("#total_amount_equiptment").text(response["total_am"]);
                                break;

                                case "tab3":
                                tab3.ajax.reload(false, null, true);
                                $("#total_amount_labor").text(response["total_am"]);
                                break;

                                case "tab4":
                                tab4.ajax.reload(false, null, true);
                                $("#total_amount_other").text(response["total_am"]);
                                break;

                                default:break;
                        };

                        Swal.fire({
         
                        title: 'Added!',
                        text: "Registry added successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok!'
                        });

                        //Seteanod
                        $("#category option[value=null").attr("selected",true).change();
                        $("#btn-add").attr("id_reg", null);
                        $("#concept_select").val(null);
                        $("#qty").val('');

                        //Subtotal Subcontractor and Grand Total

                        $.ajax({
                    type: "POST",
                    url: "/getgrandtotal",
                    processData: false,
                    contentType: false,
                    data: formData,
                    dataType: "JSON",
                    success: function (response) {
                            $("#sub_total").val(response.sub_total);
                            $("#contract").val(response.contract_total);
                            $("#grand_total").val(response.grand_total);
                        }
                        });
                        

                    }
                });
                 
                /* $(".control-sidebar").append("concepto: " + description);
                 console.log(category); */
             }


 


  function Llamar(e, id, id_category){
     e.preventDefault();
     form = $("#"+id);
     Swal.fire({
         
         title: 'Are you sure to remove this concept?',
         text: "You won't be able to revert this! " + id_category,
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, delete it!'
         }).then((result) => {
         if (result.isConfirmed) {
             
           
            switch (id_category) {
                case 1:
                var category = "material";   
                    break;
                case 2:
                var category = "equiptment";   
                    break;
                case 3:    
                var category = "labor";   
                    break;
                case 4:
                var category = "other";   
                    break;
                default:
                    break;
            }
            var formData = new FormData();
                formData.append("id", id);
                formData.append("category", category);
                formData.append("_token", CSRF_TOKEN);

            $.ajax({
                    type: "POST",
                    url: "/deletedata",
                    processData: false,
                    contentType: false,
                    data: formData,
                    dataType: "JSON",
                    success: function (response) {
                        tab = response["datatable"];
                        switch(tab){
                            case "tab1":
                                tab1.ajax.reload(false, null, true);
                                $("#total_amount_material").text(response["total_am"]);
                                break;
                                
                                case "tab2":
                                tab2.ajax.reload(false, null, true);
                                $("#total_amount_equiptment").text(response["total_am"]);
                                break;

                                case "tab3":
                                tab3.ajax.reload(false, null, true);
                                $("#total_amount_labor").text(response["total_am"]);
                                break;

                                case "tab4":
                                tab4.ajax.reload(false, null, true);
                                $("#total_amount_other").text(response["total_am"]);
                                break;

                                default:break;
                        }

                        Swal.fire({
         
                            title: 'Deleted!',
                            text: "Registry deleted successfully.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok!'
                            });


                            //Acrtualizando canty
                            $.ajax({
                                type: "POST",
                                url: "/getgrandtotal",
                                processData: false,
                                contentType: false,
                                data: formData,
                                dataType: "JSON",
                                success: function (response) {
                                        $("#sub_total").val(response.sub_total);
                                        $("#contract").val(response.contract_total);
                                        $("#grand_total").val(response.grand_total);
                                    }
                                    });
                        
                    }
                });
         
         }
         })
  }



function Register(){

    data = new FormData();
    
    $.ajax({
                    type: "POST",
                    url: "/register",
                    processData: false,
                    contentType: false,
                    data: data,
                    dataType: "JSON",
                    success: function (response) {
                        console.log(response);
                    }
                });
            

}
 








</script>
            
@stop