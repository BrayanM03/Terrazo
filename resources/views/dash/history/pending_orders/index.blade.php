@extends('adminlte::page')

@section('title', 'Material')

@section('content_header')
<div class="row justify-content-center">
    <div class="col-12 col-md-12 text-center">
    <h1>Pending orders</h1>
    <div class="row justify-content-center">
    <div class="col-12 col-md-3">
@stop

@section('content')
    <div class="row justify-content-center">
    <div class="col-12 col-md-12 text-center">
    <p>List of pending orders.</p>
    <div class="row justify-content-center">
     <div class="col-12 col-md-12">
        <div class="container">
        <div class="row justify-content-end">
            <div class="col-12 col-md-12">
                {{-- <a href="materials/create"><div class="btn btn-info">Add</div></a> --}}
            </div>    
        </div>   

        <div class="row mt-3 justify-content-center">
            <div class="col-12 col-md-12">
                
                 <table id="history_table" class="table table-bordered table-hover responsive">
                <thead class="thead-dark">
                     <th>#</th>
                     <th>Customer</th>
                     <th>Date</th>
                     <th>Store N</th>
                     <th>Re</th>
                     <th>Sow</th>
                     <th>Grand Total</th>
                     <th>Job Status</th>
                     <th>Pay Status</th>
                     <th>Created ad</th> 
                     <th>Actions</th>   

                </thead>
               {{--  <tbody class="bg-white">
                    @foreach ($materials as $material)
                        <tr>
                            <td>{{ $material->id}}</td>
                            <td>{{ $material->unit}}</td>
                            <td>{{ $material->description}}</td>
                            <td>{{ $material->unit_price}}</td>
                            <td>
                                <form action="{{ route ('materials.destroy', $material->id )}}" class="eliminar_material" method="POST" style="display:flex;">
                                <a class="btn btn-warning mr-2" href="materials/{{ $material->id}}/edit"><i class="fas fa-edit"></i></a>
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody> --}}
            </table>

            </div>    
        </div> 
           
        </div>
    </div>
    
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
@stop

@section('js')
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
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
 
 $("#history_table").DataTable({
 
 processing: true,
 serverSide: true,
 "scrollY": "400px",
 "responsive" : true,
 "ajax": "{{route('datatable.history')}}",
 "language": {
            processing: '<i class="fa fa-spinner fa-spin fa-fw"></i><span class="sr-only">Loading...</span> '},
 "columns": [
     {data: 'id'},
     {data: 'customer_id'},
     {data: 'fecha'},
     {data: 'store_number'},
     {data: 're'},
     {data: 'sow'},
     {data: 'grand_total'},
     /* {data: 'job_status'},
     {data: 'pay_status'}, */
     {data: 'job_status', render: function(data, row){
        return "<div class='btn btn-warning'>"+ data+"</div>"; +"</div>"
     }},
     {data: 'pay_status', render: function(data, row){
        return "<div class='btn btn-secondary'>"+ data +"</div>"; +"</div>"
     }},
     {data: 'created_at'},
     {data: 'actions'},
     /* {data: null, render: function(){
         return '<a class="btn btn-warning mr-2"><i class="fas fa-edit"></i></a>'+
                             '<button class="btn btn-danger"><i class="fas fa-trash"></i></button>'
     }}, */

 ]
  });


  function Llamar(e, id){
     e.preventDefault();
     form = $("#"+id);
     Swal.fire({
         
         title: 'Are you sure to remove this order?',
         text: "You won't be able to revert this!",
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


  //funcion para descargar el archivo

  function Download(e,id, type){
        e.preventDefault();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'); //Token

        var formData = new FormData();
        formData.append("_token", CSRF_TOKEN);
        
        $.ajax({
                    xhrFields: {
                        responseType: 'blob',
                    },
                    type: "POST",
                    url: "/download_order",
                    processData: false,
                    contentType: false,
                    data: formData,
                    dataType: "JSON",
                    success: function (result, status, xhr) {
                        
                        var disposition = xhr.getResponseHeader('content-disposition');
                        var matches = /"([^"]*)"/.exec(disposition);
                        var filename = (matches != null && matches[1] ? matches[1] : 'salary.xlsx');

                        // The actual download
                        var blob = new Blob([result], {
                            type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                        });
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = filename;

                        document.body.appendChild(link);

                        link.click();
                        document.body.removeChild(link);
                        }
                        });
  }










</script>
            
@stop