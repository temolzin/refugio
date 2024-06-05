<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-success">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Agregar albergue <small> &nbsp;(*) Campos requeridos</small></h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('shelters.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Datos del albergue</h3>
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
                                            <label for="logo" class="form-label"></label>
                                            <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                                name="logo" id="logo" aria-describedby="logoHelp"
                                                style="height: 43px; width: 450px; " />                                          
                                            <img id="logo-preview" src="#" alt="Vista previa del logo"
                                                style="display: none; max-width: 100%; max-height: 200px; margin-top: 10px;">
                                            @error('logo')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                  </div>                                   
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="user_id" class="form-label">Usuario(*)</label>
                                            <select class="form-control @error('user_id') is-invalid @enderror"
                                                id="user_id" name="user_id" required>
                                                <option value="">Seleccione un usuario</option>
                                                @foreach(App\Models\User::all() as $users)
                                                    <option value="{{ $users->id }}" {{ old('user_id') == $users->id ? 'selected' : '' }}>
                                                        {{ $users->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="form-label">Nombre(*)</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" placeholder="Ingresa nombre (s)" value="{{ old('name') }}"
                                                required />
                                            @error('name')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="form-label">Teléfono(*)</label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                name="phone" placeholder="Ingresa teléfono" value="{{ old('phone') }}"
                                                required />
                                            @error('phone')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="form-label">Facebook(*)</label>
                                            <input type="text"
                                                class="form-control @error('facebook') is-invalid @enderror"
                                                name="facebook" placeholder="Ingresa Facebook"
                                                value="{{ old('facebook') }}" required />
                                            @error('facebook')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="form-label">Tiktok(*)</label>
                                            <input type="text"
                                                class="form-control @error('tiktok') is-invalid @enderror" name="tiktok"
                                                placeholder="Ingresa Tiktok" value="{{ old('tiktok') }}" required />
                                            @error('tiktok')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="form-label">Estado(*)</label>
                                            <input type="text" class="form-control @error('state') is-invalid @enderror"
                                                name="state" placeholder="Ingresa estado" value="{{ old('state') }}"
                                                required />
                                            @error('state')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="form-label">Ciudad(*)</label>
                                            <input type="text" class="form-control @error('city') is-invalid @enderror"
                                                name="city" placeholder="Ingresa ciudad" value="{{ old('city') }}"
                                                required />
                                            @error('city')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="form-label">Colonia(*)</label>
                                            <input type="text"
                                                class="form-control @error('colony') is-invalid @enderror" name="colony"
                                                placeholder="Ingresa colonia" value="{{ old('colony') }}" required />
                                            @error('colony')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="form-label">Dirección(*)</label>
                                            <input type="text"
                                                class="form-control @error('address') is-invalid @enderror"
                                                name="address" placeholder="Ingresa dirección"
                                                value="{{ old('address') }}" required />
                                            @error('address')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="form-label">Código Postal(*)</label>
                                            <input type="text"
                                                class="form-control @error('postal_code') is-invalid @enderror"
                                                name="postal_code" placeholder="Ingresa código postal"
                                                value="{{ old('postal_code') }}" required />
                                            @error('postal_code')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
