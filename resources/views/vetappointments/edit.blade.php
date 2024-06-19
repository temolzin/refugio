<div class="modal fade" id="edit{{ $vet->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-warning">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Editar Cita Veterinaria<small> &nbsp;(*) Campos requeridos</small></h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('vets.update', $vet->id) }}" method="post" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Datos de la Cita</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="animal_id" class="form-label">ID Animal(*)</label>
                                            <select id="animal_id_select"
                                                class="form-control select2 @error('animal_id') is-invalid @enderror"
                                                name="animal_id" required>
                                                <option value="">Seleccione un animal</option>
                                                @foreach ($animals as $animal)
                                                    <option value="{{ $animal->id }}" {{ old('animal_id') == $animal->id ? 'selected' : '' }}>
                                                        {{ $animal->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('animal_id')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="appointment_date_and_time" class="form-label">Fecha y Hora de la
                                                Cita(*)</label>
                                            <input type="datetime-local"
                                                class="form-control @error('appointment_date_and_time') is-invalid @enderror"
                                                name="appointment_date_and_time" id="appointment_date_and_time"
                                                value="{{ $vet->appointment_date_and_time }}" required />
                                            @error('appointment_date_and_time')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="reason_for_appointment" class="form-label">Razón de la
                                                Cita(*)</label>
                                            <input type="text"
                                                class="form-control @error('reason_for_appointment') is-invalid @enderror"
                                                name="reason_for_appointment" id="reason_for_appointment"
                                                value="{{ $vet->reason_for_appointment }}" required />
                                            @error('reason_for_appointment')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="appointment_status" class="form-label">Estado de la
                                                Cita(*)</label>
                                            <select
                                                class="form-control @error('appointment_status') is-invalid @enderror"
                                                name="appointment_status" id="appointment_status" required
                                                style="height: 43px;">
                                                <option value="">Seleccione un estado</option>
                                                @foreach($status as $statu)
                                                    <option value="{{ $statu }}" {{ old('appointment_status', $vet->appointment_status ?? '') == $statu ? 'selected' : '' }}>
                                                        {{ $statu }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('appointment_status')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="observations" class="form-label">Observaciones</label>
                                            <textarea class="form-control @error('observations') is-invalid @enderror"
                                                name="observations" id="observations"
                                                rows="3">{{ $vet->observations }}</textarea>
                                            @error('observations')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="edit" class="btn btn-warning">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
