@extends('adminlte::page')

@section('title', 'Admin')

@section('css')
<link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="/css/admin_custom.css">
@endsection

@section('content')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <br><br>
        <h3 class="mb-4 text-center">USUARIOS</h3>
        <div class="row mb-4">
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
                    <i class="fas fa-plus-circle"></i> REGISTRAR NUEVO USUARIO
                </button>
            </div>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table id="users" class="table">
        <thead class="table-dark text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">APELLIDO PATERNO</th>
                <th scope="col">APELLIDO MATERNO</th>
                <th scope="col">TELEFONO</th>
                <th scope="col">EMAIL</th>
                <th scope="col">CONTRASEÑA</th>
                <th scope="col">OPCIONES</th>
            </tr>
        </thead>
        <tbody>
            @if(count($users) <= 0)
            <tr>
                <td colspan="8">No hay resultados</td>
            </tr>
            @else
            @foreach($users as $users)
            <tr>
                <td scope="row">{{$users->id}}</td>
                <td>{{$users->name}}</td>
                <td>{{$users->last_name}}</td>
                <td>{{$users->maternal_lastName}}</td>
                <td>{{$users->phone}}</td>
                <td>{{$users->email}}</td>
                <td>{{$users->password}}</td>
                <td>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#view{{$users->id}}">
                        <i class="fas fa-eye"></i>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit{{$users->id}}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$users->id}}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
                @include('users.delete')
            </tr>
            @include('users.ver')
            @include('users.info')
            @endforeach
            @endif
        </tbody>
    </table>
    @include('users.create')
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function() {
        $('#users').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

        var successMessage = "{{ session('success') }}";

       
        if (successMessage) {
           
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: successMessage,
                confirmButtonText: 'Aceptar'
            });
        }
    });
</script>
@endsection
