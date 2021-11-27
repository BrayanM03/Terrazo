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

     let datos = new Map();
      
         datos.set("customer_id", customer)
         datos.set("re", re)
         datos.set("date", date)
         datos.set("sow", sow)
         datos.set("store_number", store_number) 
         flag = 0; //Validador
         

      /*    for (let [key, value] of datos) {

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
        } */
        
        //Si validacion OK entonces 
        if(flag == 0){

                $("#primer_form").empty();

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
                                    <select input class="form-control" id="concept_select" name="concept_select" disabled>
                                      
                                    </select>      
                                </div>

                                <div class="col-12 col-md-1">
                                    <p>Price</p> 
                                    <input class="form-control" id="price" name="price" placeholder="0.00">    
                                </div>

                                <div class="col-12 col-md-1">
                                    <p>Qty</p> 
                                    <input class="form-control" id="qty" name="qty" placeholder="0">    
                                </div>

                                <div class="col-12 col-md-2" style="margin-top:39px;"> 
                                    <div unit="" id="btn-add" class="btn btn-md btn-info" onclick="AddConcept()">Add</div>      
                                </div>

                            </div>
                            </div>
                            </div>

                            <div class="row mt-5 m-3">
                                <div class="col-12 col-md-12">

                                        <div id="card-materials" class="card collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Materials table</h3>
                                                <div class="card-tools">
                                                <button type="button" id="plus-btn-material" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                
                                            <div class="card-body">
                                                <table id="materials_table" class="table table-bordered table-hover responsive">
                                                    <thead class="thead-dark">
                                                        <th>#</th>
                                                        <th>Qty</th>
                                                        <th>Unity</th>
                                                        <th>Materials</th>
                                                        <th>Unit Price</th>
                                                        <th>Actions</th>
                                                    </thead>
                                                    
                                                </table>
                                            </div>
                                        </div>           
                                </div>


                                <div class="col-12 col-md-12">

                                    <div class="card collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Equiptments table</h3>
                                                <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                
                                            <div class="card-body">
                                               
                                                <table id="equiptments_table" class="table table-warning table-bordered table-hover responsive">
                                                    <thead>
                                                        <th>#</th>
                                                        <th>Qty</th>
                                                        <th>Unity</th>
                                                        <th>Equiptments</th>
                                                        <th>Unit Price</th>
                                                        <th>Actions</th>
                                                    </thead>
                                                
                                                </table>
                                                
                                            </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row m-3">
                                <div class="col-12 col-md-12">

                                    <div class="card collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Labors table</h3>
                                                <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                
                                            <div class="card-body">
                                                <table id="labors_table" class="table table-primary table-bordered table-hover responsive">
                                                    <thead>
                                                        <th>#</th>
                                                        <th>Qty</th>
                                                        <th>Unity</th>
                                                        <th>Labors</th>
                                                        <th>Price per hour</th>
                                                        <th>Actions</th>
                                                    </thead>
                                                
                                                </table>
                                            </div>
                                            </div>      
                                </div>


                                <div class="col-12 col-md-12">

                                    <div class="card collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Other expenses table</h3>
                                                <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                
                                            <div class="card-body">
                                                <table id="other_table" class="table table-danger table-bordered table-hover responsive">
                                                    <thead>
                                                        <th>#</th>
                                                        <th>Qty</th>
                                                        <th>Unity</th>
                                                        <th>Other expenses</th>
                                                        <th>Unit Price</th>
                                                        <th>Actions</th>
                                                    </thead>
                                                
                                                </table>
                                            </div>
                                        </div>          
                                </div>
                            </div>

                         </div>`);

                         

        }
    
 }

 function ChangeCategory(){
        category = $("#category").val();
      
        if(category == "null"){
            $("#concept_select").prop("disabled",true);
        }else{
            $("#concept_select").prop("disabled",false);

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
           
            return repo.description;
            
            }
 
 
 //Fin select2

 function AddConcept() {

                 category = $("#category").val();
                 description = $("#concept_select").val();
                 qty = $("#qty").val();
                 price = $("#price").val();  
                 unit = $("#btn-add").attr("unit");  

                 var formData = new FormData();
                 formData.append("category", category);
                 formData.append("unit", unit);
                 formData.append("description", description);
                 formData.append("qty", qty);
                 formData.append("price", price);
                 formData.append("_token", CSRF_TOKEN);
                 

                 validar_collapse_card = $("#card-materials").hasClass("collapsed-card"); 
                 console.log(validar_collapse_card);
                 validar_collapse_card == true ? $("#plus-btn-"+category).click() : console.log("Card abierto");

                $.ajax({
                    type: "POST",
                    url: "/insertdata",
                    processData: false,
                    contentType: false,
                    data: formData,
                    dataType: "JSON",
                    success: function (response) {
                        console.log(response);
                    }
                });
                 
                /* $(".control-sidebar").append("concepto: " + description);
                 console.log(category); */
             }


/*  $("#materials_table").DataTable({
 
 processing: true,
 serverSide: true,
 "scrollY": "400px",
 "responsive" : true,
 "ajax": "{{route('datatable.material')}}",
 "columns": [
     {data: 'id'},
     {data: 'unit'},
     {data: 'description'},
     {data: 'unit_price'},
     {data: 'actions'},
     {data: null, render: function(){
         return '<a class="btn btn-warning mr-2"><i class="fas fa-edit"></i></a>'+
                             '<button class="btn btn-danger"><i class="fas fa-trash"></i></button>'
     }}, 
  ]
  });  */


/*   function Llamar(e, id){
     e.preventDefault();
     form = $("#"+id);
     Swal.fire({
         
         title: 'Are you sure to remove this labor?',
         text: "You won't be able to revert this! id: " + id,
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, delete it!'
         }).then((result) => {
         if (result.isConfirmed) {
         
         form.submit();
         }
         })
  }
 */









</script>
            
@stop