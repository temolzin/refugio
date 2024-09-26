@extends('adminlte::page')

@section('title', 'PatitasFelices | Padrino')

@section('content')
<section class="content">
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Padrino</h2>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-success" data-toggle='modal' data-target="#create"> <i class="fa fa-edit"></i> Registrar Padrino
                            </button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="godfather" class="table table-striped display responsive nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>FOTO</th>
                                            <th>NOMBRE COMPLETO</th>
                                            <th>TELEFONO</th>
                                            <th>OPCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($shelterMember) <= 0) <tr>
                                            <td colspan="4">No hay resultados</td>
                                            </tr>
                                            @else
                                            @foreach($shelterMember as $shelterMember)
                                            <tr>
                                                <td scope="row">{{$shelterMember->id}}</td>
                                                <td>
                                                    @if($shelterMember->getMedia('photos')->isNotEmpty())
                                                    @php
                                                    $photo = $shelterMember->getFirstMedia('photos');
                                                    @endphp
                                                    <img src="{{ $photo->getUrl() }}" alt="Photo not found" style="width: 50px; height: 50px; border-radius: 50%;">
                                                    @else
                                                    <img src="{{ asset('img/avatardefault.png') }}" style="width: 50px; height: 50px; border-radius: 50%;">
                                                    @endif
                                                </td>
                                                <td>{{$shelterMember->name}} {{$shelterMember->last_name}} </td>
                                                <td>{{$shelterMember->phone}}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Opciones">
                                                        <button type="button" class="btn btn-info mr-2" data-toggle="modal" title="Ver Detalles" data-target="#view{{$shelterMember->id}}">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-warning mr-2" data-toggle="modal" title="Editar Datos"  data-target="#edit{{$shelterMember->id}}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger mr-2" data-toggle="modal" title="Eliminar Registro" data-target="#delete{{$shelterMember->id}}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-success mr-2" data-toggle="modal" title="Registrar Apadrinamiento" data-target="#createSponsorship{{ $shelterMember->id }}">
                                                            <i class="fas fa-dollar-sign" ></i>
                                                        </button>
                                                        <button type="button" class="btn btn-secondary mr-2" data-toggle="modal" title="Ver Apadrinamientos" data-target="#indexSponsorship{{$shelterMember->id}}">
                                                            <i class="fas fa-search-dollar"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                @include('sponsorship.indexSponsorship')
                                                @include('shelterMembers.delete')
                                                @include('sponsorship.createSponsorship', ['shelterMember' => $shelterMember])
                                            </tr>
                                            @include('shelterMembers.view')
                                            @include('shelterMembers.info')
                                            @endforeach
                                            @endif
                                    </tbody>
                                    @include('shelterMembers.create')
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
    document.addEventListener("DOMContentLoaded", function() {
        var modalId = "{{ session('modal_id') }}";
        if (modalId) {
            $('#' + modalId).modal('show');
        }
    });

    $(document).ready(function() {
        $('#godfather').DataTable({
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

        $('[id^=createSponsorship]').on('shown.bs.modal', function() {
            $(this).find('.select2').select2({
                dropdownParent: $(this)
            });
        });
    });
    function closeCurrentModal(modalId) {
        $(modalId).modal('hide');
    }

</script>
@endsection
