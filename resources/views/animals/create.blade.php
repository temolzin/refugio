<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-success">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Agregar Mascota <small> &nbsp;(*) Campos requeridos</small></h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('animals.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Datos de la Masocta</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8 offset-lg-2">
                                        <div class="form-group text-center">
                                            <div class="image-preview-container" style="display: flex; justify-content: center; margin-top: 10px;">
                                                <img id="photo-preview" src="#" alt="Vista previa de la foto"
                                                     style="display: none; width: 120px; height: 120px; border-radius: 50%; margin-bottom: 5px;">
                                            </div>
                                            <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo"
                                                   id="photo" aria-describedby="photoHelp"
                                                   style="height: 43px; width: 450px;" onchange="previewImage(event)" required />
                                            @error('photo')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Nombre(*)</label>
                                            <input type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                name="name" placeholder="Ingresa el nombre del animal"
                                                value="{{ old('name') }}" required />
                                            @error('name')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="specie_id" class="form-label">Especie(*)</label>
                                            <select class="form-control @error('specie_id') is-invalid @enderror"
                                                name="specie_id" required>
                                                <option value="">Selecciona una especie</option>
                                                @foreach ($species as $specie)
                                                    <option value="{{ $specie->id }}"
                                                        {{ old('specie_id') == $specie->id ? 'selected' : '' }}>
                                                        {{ $specie->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('specie_id')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="breed" class="form-label">Raza</label>
                                            <input type="text"
                                                class="form-control @error('breed') is-invalid @enderror" name="breed"
                                                placeholder="Ingresa la raza del animal" value="{{ old('breed') }}" required />
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
                                                name="birth_date" value="{{ old('birth_date') }}" required />
                                            @error('birth_date')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="sex" class="form-label">Sexo(*)</label>
                                            <select class="form-control @error('sex') is-invalid @enderror"
                                                name="sex" required>
                                                <option value="">Selecciona el sexo</option>
                                                @foreach ($sexes as $sex)
                                                    <option value="{{ $sex }}" {{ old('sex') == $sex ? 'selected' : '' }}>
                                                        {{ $sex }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('sex')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="color" class="form-label">Color</label>
                                            <input type="text"
                                                class="form-control @error('color') is-invalid @enderror"
                                                name="color" placeholder="Ingresa el color del animal"
                                                value="{{ old('color') }}" required />
                                            @error('color')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="weight" class="form-label">Peso</label>
                                            <input type="number" step="0.01"
                                                class="form-control @error('weight') is-invalid @enderror"
                                                name="weight" placeholder="Ingresa el peso del animal"
                                                value="{{ old('weight') }}" required />
                                            @error('weight')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="is_sterilized" class="form-label">¿Está
                                                Esterilizado?</label>
                                            <select class="form-control @error('is_sterilized') is-invalid @enderror"
                                                name="is_sterilized" required>
                                                <option value="">Selecciona una opción</option>
                                                <option value="1" {{ old('is_sterilized') == '1' ? 'selected' : '' }}>Sí</option>
                                                <option value="0" {{ old('is_sterilized') == '0' ? 'selected' : '' }}>No</option>
                                            </select>
                                            @error('is_sterilized')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="entry_date" class="form-label">Fecha de Ingreso</label>
                                            <input type="date"
                                                class="form-control @error('entry_date') is-invalid @enderror"
                                                name="entry_date" value="{{ old('entry_date') }}" required />
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
                                            <select class="form-control @error('origin') is-invalid @enderror" name="origin" required>
                                                <option value="">Selecciona el origen</option>
                                                @foreach ($origins as $origin)
                                                    <option value="{{ $origin }}" {{ old('origin') == $origin ? 'selected' : '' }}>
                                                        {{ $origin }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('origin')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="behavior" class="form-label">Comportamiento</label>
                                            <select class="form-control @error('behavior') is-invalid @enderror" name="behavior" required>
                                                <option value="">Selecciona el comportamiento</option>
                                                @foreach ($behaviors as $behavior)
                                                    <option value="{{ $behavior }}" {{ old('behavior') == $behavior ? 'selected' : '' }}>
                                                        {{ $behavior }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('behavior')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="history" class="form-label">Historia</label>
                                            <textarea class="form-control @error('history') is-invalid @enderror" name="history"
                                                placeholder="Ingresa la historia del animal" required>{{ old('history') }}</textarea>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" id="save" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function previewImage(event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function() {
            var dataURL = reader.result;
            var output = document.getElementById('photo-preview');
            output.src = dataURL;
            output.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
</script>
