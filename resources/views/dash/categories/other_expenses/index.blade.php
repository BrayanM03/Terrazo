@extends('adminlte::page')

@section('title', 'Other Expenses')

@section('content_header')
<div class="row justify-content-center">
    <div class="col-12 col-md-12 text-center">
    <h1>Other Expenses</h1>
    <div class="row justify-content-center">
    <div class="col-12 col-md-3">
@stop

@section('content')
    <div class="row justify-content-center">
    <div class="col-12 col-md-12 text-center">
    <p>List of other expenses, you can add more.</p>
    <div class="row justify-content-center">
     <div class="col-12 col-md-12">
        <div class="container">
        <div class="row justify-content-end">
            <div class="col-12 col-md-12">
                <a href="other_expenses/create"><div class="btn btn-info">Add</div></a>
            </div>    
        </div>   

        <div class="row mt-3 justify-content-center">
            <div class="col-12 col-md-12">
                
                 <table id="other_expenses_table" class="table table-bordered table-hover responsive">
                <thead class="thead-dark">
                    <th>#</th>
                    <th>Unity</th>
                    <th>Description</th>
                    <th>Unit Price</th>
                     <th>Actions</th>

                </thead>
              {{--   <tbody class="bg-white">
                    @foreach ($other_expenses as $other_expense)
                        <tr>
                            <td>{{ $other_expense->id}}</td>
                            <td>{{ $other_expense->unit}}</td>
                            <td>{{ $other_expense->description}}</td>
                            <td>{{ $other_expense->unit_price}}</td>
                            <td>
                                <form action="{{ route ('other_expenses.destroy', $other_expense->id )}}" class="eliminar_registro" method="POST" style="display:flex;">
                                <a class="btn btn-warning mr-2" href="other_expenses/{{ $other_expense->id}}/edit"><i class="fas fa-edit"></i></a>
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
 

 $("#other_expenses_table").DataTable({
 
 processing: true,
 serverSide: true,
 "scrollY": "400px",
 "responsive" : true,
 "ajax": "{{route('datatable.other_expenses')}}",
 "language": {
            processing: '<i class="fa fa-spinner fa-spin fa-fw"></i><span class="sr-only">Loading...</span> '},
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

 ]
  });


  function Llamar(e, id){
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






</script>
            
@stop