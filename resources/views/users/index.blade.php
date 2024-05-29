@extends('adminlte::page')

@section('title', 'Admin')
@section('content')
<section class="content">
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Tabla de usuarios</h2>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-success" data-toggle='modal' data-target="#create"> <i
                                    class="fa fa-edit"></i> Registrar Usuario
                            </button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="users" class="table table-striped display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                            <th>APELLIDO </th>
                                            <th>TELEFONO</th>
                                            <th>EMAIL</th>
                                            <th>OPCIONES</th>
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
                                            <td>{{$users->phone}}</td>
                                            <td>{{$users->email}}</td>
                                            <td>
                                            <div class="btn-group" role="group" aria-label="Opciones">
                                                <button type="button" class="btn btn-info mr-2" data-toggle="modal" data-target="#view{{$users->id}}">
                                                    <i class="fas fa-eye"></i>
                                                <button type="button" class="btn btn-warning mr-2" data-toggle="modal" data-target="#edit{{$users->id}}">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('#users').DataTable({
            responsive: true,
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            dom: 'Bfrtip',
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
