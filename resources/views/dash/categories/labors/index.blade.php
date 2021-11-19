@extends('adminlte::page')

@section('title', 'Labors')

@section('content_header')
<div class="row justify-content-center">
    <div class="col-12 col-md-12 text-center">
    <h1>Labors</h1>
    <div class="row justify-content-center">
    <div class="col-12 col-md-3">
@stop

@section('content')
    <div class="row justify-content-center">
    <div class="col-12 col-md-12 text-center">
    <p>List of labors, you can add more.</p>
    <div class="row justify-content-center">
     <div class="col-12 col-md-12">
        <div class="container">
        <div class="row justify-content-end">
            <div class="col-12 col-md-12">
                <a href="labors/create"><div class="btn btn-info">Add</div></a>
            </div>    
        </div>   

        <div class="row mt-3 justify-content-center">
            <div class="col-12 col-md-12">
                
                 <table id="labors_table" class="table table-bordered table-hover responsive">
                <thead class="thead-dark">
                    <th>#</th>
                    <th>Unity</th>
                    <th>Description</th>
                    <th>Price per hour</th>
                     <th>Actions</th>

                </thead>
                <tbody class="bg-white">
                    @foreach ($labors as $labor)
                        <tr>
                            <td>{{ $labor->id}}</td>
                            <td>{{ $labor->unit}}</td>
                            <td>{{ $labor->description}}</td>
                            <td>{{ $labor->price_per_hour}}</td>
                            <td>
                                <form action="{{ route ('labors.destroy', $labor->id )}}" class="eliminar_labor" method="POST" style="display:flex;">
                                <a class="btn btn-warning mr-2" href="labors/{{ $labor->id}}/edit"><i class="fas fa-edit"></i></a>
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
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
 
 table = $("#labors_table").DataTable({
 
    "scrollY": "400px",
    "responsive" : true

        });



$(".eliminar_labor").submit(function (e) { 

    e.preventDefault();

    Swal.fire({
            title: 'Are you sure to remove this labor?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
            
            this.submit();
            }
            })

 })






</script>
            
@stop