@extends('adminlte::page')

@section('title', 'Admin')

@section('content')
<section class="content">
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Adoptante</h2>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-success" data-toggle='modal' data-target="#create"> <i class="fa fa-edit"></i> Registrar Adoptante
                            </button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="adopter" class="table table-striped display responsive nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>FOTO</th>
                                            <th>NOMBRE COMPLETO</th>
                                            <th>TELEFONO</th>
                                            <th>CORREO</th>
                                            <th>DIRECCIÓN</th>
                                            <th>TIPO</th>
                                            <th>OPCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($sheltermember) <= 0) <tr>
                                            <td colspan="4">No hay resultados</td>
                                            </tr>
                                            @else
                                            @foreach($sheltermember as $sheltermember)
                                            <tr>
                                                <td scope="row">{{$sheltermember->id}}</td>
                                                <td>
                                                    @if($sheltermember->getMedia('photos')->isNotEmpty())
                                                    @php
                                                    $photo = $sheltermember->getFirstMedia('photos');
                                                    @endphp
                                                    <img src="{{ $photo->getUrl() }}" alt="Photo not found" style="width: 50px; height: 50px; border-radius: 50%;">
                                                    @else
                                                    <img src="{{ asset('img/avatardefault.png') }}" style="width: 50px; height: 50px; border-radius: 50%;">
                                                    @endif
                                                </td>
                                                <td>{{$sheltermember->name}} {{$sheltermember->last_name}} {{$sheltermember->mother_lastname}}</td>
                                                <td>{{$sheltermember->phone}}</td>
                                                <td>{{$sheltermember->email}}</td>
                                                <td>{{ $sheltermember->address }} Col. {{ $sheltermember->colony }} {{ $sheltermember->city }} {{ $sheltermember->state }} C.P {{ $sheltermember->postal_code }}</td>
                                                <td>{{$sheltermember->typemember}}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Opciones">
                                                        <button type="button" class="btn btn-info mr-2" data-toggle="modal" data-target="#view{{$sheltermember->id}}">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-warning mr-2" data-toggle="modal" data-target="#edit{{$sheltermember->id}}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$sheltermember->id}}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                @include('sheltermembers.delete')
                                            </tr>
                                            @include('sheltermembers.view')
                                            @include('sheltermembers.info')
                                            @endforeach
                                            @endif
                                    </tbody>
                                    @include('sheltermembers.create')
                                </table>
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
        $('#adopter').DataTable({
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
