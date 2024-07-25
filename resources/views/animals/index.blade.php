@extends('adminlte::page')

@section('title', 'Animales')

@section('favicon')

@section('content')
    <section class="content">
        <div class="right_col" role="main">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Mascotas</h2>
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <button class="btn btn-success" data-toggle='modal' data-target="#create"> <i
                                        class="fa fa-edit"></i> Registrar Mascota
                                </button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="animals" class="table table-striped display responsive nowrap"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>FOTO</th>
                                                <th>NOMBRE</th>
                                                <th>ESPECIE</th>
                                                <th>SEXO</th>
                                                <th>COLOR</th>
                                                <th>ESTERILIZADO</th>
                                                <th>OPCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($animals) <= 0)
                                                <tr>
                                                    <td colspan="14">No hay resultados</td>
                                                </tr>
                                            @else
                                                @foreach ($animals as $animal)
                                                    <tr>
                                                        <td scope="row">{{ $animal->id }}</td>
                                                        <td>
                                                            @if ($animal->getFirstMediaUrl('animalGallery'))
                                                                <img src="{{ $animal->getFirstMediaUrl('animalGallery') }}"
                                                                    alt="Foto de {{ $animal->name }}"
                                                                    style="width: 50px; height: 50px; border-radius: 50%;">
                                                            @else
                                                                <img src="{{ asset('img/animaldefault.png') }}"
                                                                    style="width: 50px; height: 50px; border-radius: 50%;">
                                                            @endif
                                                        </td>
                                                        <td>{{ $animal->name }}</td>
                                                        <td>{{ $animal->specie->name }}</td>
                                                        <td>{{ $animal->sex }}</td>
                                                        <td>{{ $animal->color }}</td>
                                                        <td>{{ $animal->is_sterilized == 1 ? 'Sí' : 'No' }}</td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Opciones">
                                                                <button type="button" class="btn btn-info mr-2"
                                                                    data-toggle="modal"
                                                                    data-target="#view{{ $animal->id }}">
                                                                    <i class="fas fa-eye"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-warning mr-2"
                                                                    data-toggle="modal"
                                                                    data-target="#edit{{ $animal->id }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-danger mr-2"
                                                                    data-toggle="modal"
                                                                    data-target="#delete{{ $animal->id }}">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                                <a type="button" class="btn btn-block bg-gradient-secondary mr-2"
                                                                    target="_blank"
                                                                    href="{{ route('animals.petProfile', Crypt::encrypt($animal->id)) }}">
                                                                    <i class="fas fa-dog"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                        @include('animals.edit', [
                                                            'animal' => $animal,
                                                            'species' => $species,
                                                        ])
                                                        @include('animals.delete')
                                                        @include('animals.show')
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    @include('animals.create')
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
            $('#animals').DataTable({
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
