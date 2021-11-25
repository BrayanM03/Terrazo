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
                <div class="card">
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
                        <div class="col-12 col-md-10 p-3">
                            <label for="re">Re</label><br>
                            <input type="text" class="form-control" name="re" id="re" placeholder="Type asunt">
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
                            <button class="btn btn-primary">Siguiente</button>
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

<style>
.select2-selection__rendered {
    line-height: 31px !important;
}
.select2-container .select2-selection--single {
    height: 35px !important;
}
.select2-selection__arrow {
    height: 34px !important;
}

</style>

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
        
            

})
 
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
     /* {data: null, render: function(){
         return '<a class="btn btn-warning mr-2"><i class="fas fa-edit"></i></a>'+
                             '<button class="btn btn-danger"><i class="fas fa-trash"></i></button>'
     }}, */

/*  ]
  }); */ 


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