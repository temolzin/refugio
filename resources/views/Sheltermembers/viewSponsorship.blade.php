<div class="modal fade" id="viewSponsorship{{ $shelterMember->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-secondary">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Información de los apadrinamientos de {{ $shelterMember->name }}</h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header py-2 bg-secondary">
                            <h3 class="card-title">Datos del apadrinamiento</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-box table-responsive">
                            <table id="sponsorship" class="table table-striped display responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID </th>
                                        <th>Mascota</th>
                                        <th>Fecha de inicio</th>
                                        <th>Fecha de finalización</th>
                                        <th>Fecha de el pago</th>
                                        <th>Monto</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sponsorships[$shelterMember->id] ?? [] as $sponsorship)
                                        <tr>
                                            <td>{{ $sponsorship->id }}</td>
                                            <td>{{ $sponsorship->animal->name }}</td>
                                            <td>{{ $sponsorship->start_date }}</td>
                                            <td>{{ $sponsorship->finish_date }}</td>
                                            <td>{{ $sponsorship->payment_date }}</td>
                                            <td>${{ number_format($sponsorship->amount,2) }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Acciones">
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteSponsorship{{ $sponsorship->id }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <div class="modal fade" id="deleteSponsorship{{ $sponsorship->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger">
                                                        <h5 class="modal-title" id="deleteModalLabel">Eliminar Apadrinamiento</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Estás seguro de que deseas eliminar este apadrinamiento?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('sponsorship.destroy', $sponsorship->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">No hay apadrinamientos registrados.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
<script>
    $(document).ready(function() {
        $('#sponsorship').DataTable({
            responsive: true
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
