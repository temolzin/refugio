<div class="modal fade" id="edit{{ $animal->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-warning">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Editar Mascota <small> &nbsp;(*) Campos requeridos</small></h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('animals.update', $animal->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Datos de la Mascota</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 d-flex justify-content-center align-items-center">
                                        <div class="form-group text-center">
                                            @if ($animal->getFirstMediaUrl('animal_gallery'))
                                                <img src="{{ $animal->getFirstMediaUrl('animal_gallery') }}"
                                                    alt="foto Actual"
                                                    style="width: 120px; height: 120px; border-radius: 50%; margin-bottom: 20px;">
                                            @else
                                                <img src="{{ asset('img/avatardefault.png') }}"
                                                    style="width: 120px; height: 120px; border-radius: 50%; margin-bottom: 5px;">
                                            @endif
                                            <label for="logo" class="form-label"></label>
                                            <input type="file"
                                                class="form-control @error('photo') is-invalid @enderror" name="photo"
                                                id="photo" aria-describedby="helpId" placeholder=""
                                                value="{{ $animal->photo }}" style="height: 43px; width: 300px;">
                                            @error('logo')
                                                <span class="invalid-feedback" style="margin-top: -5px;">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="animal_name" class="form-label">Nombre(*)</label>
                                            <input type="text"
                                                class="form-control @error('animal_name') is-invalid @enderror"
                                                name="animal_name" placeholder="Ingresa el nombre del animal"
                                                value="{{ old('animal_name', $animal->animal_name) }}" required />
                                            @error('animal_name')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="specie_id" class="form-label">Especie(*)</label>
                                            <select name="specie_id"
                                                class="form-control @error('specie_id') is-invalid @enderror" required>
                                                @foreach ($species as $specie)
                                                    <option value="{{ $specie->id }}"
                                                        {{ $animal->specie_id == $specie->id ? 'selected' : '' }}>
                                                        {{ $specie->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('specie_id')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="breed" class="form-label">Raza</label>
                                            <input type="text"
                                                class="form-control @error('breed') is-invalid @enderror" name="breed"
                                                placeholder="Ingresa la raza del animal"
                                                value="{{ old('breed', $animal->breed) }}" />
                                            @error('breed')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="birth_date" class="form-label">Fecha de Nacimiento</label>
                                            <input type="date"
                                                class="form-control @error('birth_date') is-invalid @enderror"
                                                name="birth_date"
                                                value="{{ old('birth_date', $animal->birth_date) }}" />
                                            @error('birth_date')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="sex" class="form-label">Sexo</label>
                                            <select name="sex"
                                                class="form-control @error('sex') is-invalid @enderror">
                                                <option value="Macho" {{ $animal->sex == 'Macho' ? 'selected' : '' }}>
                                                    Macho</option>
                                                <option value="Hembra"
                                                    {{ $animal->sex == 'Hembra' ? 'selected' : '' }}>Hembra</option>
                                            </select>
                                            @error('sex')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="color" class="form-label">Color</label>
                                            <input type="text"
                                                class="form-control @error('color') is-invalid @enderror" name="color"
                                                placeholder="Ingresa el color del animal"
                                                value="{{ old('color', $animal->color) }}" />
                                            @error('color')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="weight" class="form-label">Peso</label>
                                            <input type="number" step="0.01"
                                                class="form-control @error('weight') is-invalid @enderror"
                                                name="weight" placeholder="Ingresa el peso del animal"
                                                value="{{ old('weight', $animal->weight) }}" />
                                            @error('weight')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="is_sterilized" class="form-label">Esterilizado</label>
                                            <select name="is_sterilized"
                                                class="form-control @error('is_sterilized') is-invalid @enderror">
                                                <option value="Si"
                                                    {{ $animal->is_sterilized == 'Si' ? 'selected' : '' }}>Si</option>
                                                <option value="No"
                                                    {{ $animal->is_sterilized == 'No' ? 'selected' : '' }}>No</option>
                                            </select>
                                            @error('is_sterilized')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="entry_date" class="form-label">Fecha de Ingreso</label>
                                            <input type="date"
                                                class="form-control @error('entry_date') is-invalid @enderror"
                                                name="entry_date"
                                                value="{{ old('entry_date', $animal->entry_date) }}" />
                                            @error('entry_date')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="origin" class="form-label">Origen</label>
                                            <select name="origin"
                                                class="form-control @error('origin') is-invalid @enderror">
                                                <option value="Rescatado"
                                                    {{ $animal->origin == 'Rescatado' ? 'selected' : '' }}>Rescatado
                                                </option>
                                                <option value="Transferido"
                                                    {{ $animal->origin == 'Transferido' ? 'selected' : '' }}>
                                                    Transferido</option>
                                                <option value="Abandonado"
                                                    {{ $animal->origin == 'Abandonado' ? 'selected' : '' }}>Abandonado
                                                </option>
                                            </select>
                                            @error('origin')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="behavior" class="form-label">Comportamiento</label>
                                            <select name="behavior"
                                                class="form-control @error('behavior') is-invalid @enderror">
                                                <option value="Amigable"
                                                    {{ $animal->behavior == 'Amigable' ? 'selected' : '' }}>Amigable
                                                </option>
                                                <option value="Timido"
                                                    {{ $animal->behavior == 'Timido' ? 'selected' : '' }}>Tímido
                                                </option>
                                                <option value="Agresivo"
                                                    {{ $animal->behavior == 'Agresivo' ? 'selected' : '' }}>Agresivo
                                                </option>
                                            </select>
                                            @error('behavior')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="history" class="form-label">Historia</label>
                                            <textarea class="form-control @error('history') is-invalid @enderror" name="history"
                                                placeholder="Ingresa la historia del animal">{{ old('history', $animal->history) }}</textarea>
                                            @error('history')
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" id="edit" class="btn btn-warning">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
