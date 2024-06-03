<div class="modal fade"  id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="card-success">
            <div class="card-header">
              <div class="d-sm-flex align-items-center justify-content-between">
                <h4 class="card-title">Agregar vacuna <small> &nbsp;(*) Campos requeridos</small></h4>
                <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
            <form action="{{ route('vaccines.store') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="card">
                  <div class="card-header py-2 bg-secondary">
                    <h3 class="card-title">Datos de la vacuna</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fa fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="" class="form-label">Nombre(*)</label>
                          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Ingresa nombre (s)" value="{{ old('name') }}" required/>
                          @error('name')
                          <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="" class="form-label">Tipo(*)</label>
                          <input type="text" class="form-control @error('type') is-invalid @enderror" name="type" placeholder="Ingresa el tipo" value="{{ old('type') }}" required/>
                          @error('type')
                          <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="" class="form-label">Descripción(*)</label>
                          <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Ingresa una descripcion" value="{{ old('description') }}" required/>
                          @error('description')
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
                <button type="submit" id="save" class="btn btn-success">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div
    