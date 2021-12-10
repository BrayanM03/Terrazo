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
    <p>List of approved orders.</p>
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
                     <th>ID</th>
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

 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');   
 
 tabla = $("#history_table").DataTable({
 
 processing: true,
 serverSide: true,
 "scrollY": "400px",
 "responsive" : true,
 "ajax": "{{route('datatable.history_approved')}}",
 "language": {
            processing: '<i class="fa fa-spinner fa-spin fa-fw"></i><span class="sr-only">Loading...</span> '},
 "columns": [
     {data: 'id'},
     {data: 'customer_name'},
     {data: 'fecha'},
     {data: 'store_number'},
     {data: 're'},
     {data: 'sow'},
     {data: 'grand_total'},
     /* {data: 'job_status'},
     {data: 'pay_status'}, */
     {data: 'job_status', render: function(data, type, row, meta ){

        if(row.job_status == 'Pending'){
            btn_color = "warning";
        }else if(row.job_status == 'Approved'){
            btn_color = "info";
        }else if(row.job_status == 'Completed'){
            btn_color = "success";
        }else if(row.job_status == 'Canceled'){
            btn_color = "secondary";
        }

        if(row.pay_status == 'Paid'){
            btn_pay_color = "success";
        }else if(row.pay_status == 'Unpaid'){
            btn_pay_color = "danger";
        }else if(row.pay_status == 'Canceled'){
            btn_pay_color = "secondary";
        }

        return "<div class='btn btn-"+ btn_color +"' onclick='changeStatus("+ row.id +")'>"+ data +"</div>"; +"</div>"
     }},
     {data: 'pay_status', render: function(data, index, row){
        return "<div class='btn btn-"+ btn_pay_color +"' onclick='changePayStatus("+ row.id +")'>"+ data +"</div>"; +"</div>"
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

  function changeStatus(id){

    Swal.fire({
         
         title: 'Change status',
         text: "You can change the status order, The order will be changed to another table!",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Change status!',
         html: '<select class="form-control" id="status" name="status">'+
                    '<option val="Pending">Pending</option>'+
                    '<option val="Approved">Approved</option>'+
                    '<option val="Completed">Completed</option>'+
                    '<option val="Canceled">Canceled</option>'+
               '</select>'
         }).then((result) =>{

            if(result.isConfirmed){

                $new_status = $("#status").val()
                datos = new FormData();
                datos.append("_token", CSRF_TOKEN);
                datos.append("id_order", id);
                datos.append("status", $new_status);

                $.ajax({
                    type: "POST",
                    url: "/changestatus",
                    processData: false,
                    contentType: false,
                    data: datos,
                    dataType: "JSON",
                    success: function (response) {
                        tabla.ajax.reload(null, false);
                    }
                });

            }

         })

  }


  function changePayStatus(id){

Swal.fire({
     
     title: 'Change Pay status',
     text: "You can change the pay status order here!",
     icon: 'info',
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Change status!',
     html: '<select class="form-control" id="pay_status" name="pay_status">'+
                '<option val="Paid">Paid</option>'+
                '<option val="Unpaid">Unpaid</option>'+
                '<option val="Canceled">Canceled</option>'+
           '</select>'
     }).then((result) =>{

        if(result.isConfirmed){

            new_status = $("#pay_status").val()
            datoss = new FormData();
            datoss.append("_token", CSRF_TOKEN);
            datoss.append("id_order", id);
            datoss.append("pay_status", new_status);

            $.ajax({
                type: "POST",
                url: "/changepaystatus",
                processData: false,
                contentType: false,
                data: datoss,
                dataType: "JSON",
                success: function (response) {
                    tabla.ajax.reload(null, false);
                }
            });

        }

     })

}

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