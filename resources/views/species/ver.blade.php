<div class="modal fade" id="view{{ $species->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel{{ $species->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="card-info">
        <div class="card-header">
          <div class="d-sm-flex align-items-center justify-content-between">
            <h4 class="card-title">Información de la Especie </h4>
            <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
        <div class="modal-body">
          <div class="card">
            <div class="card-header py-2 bg-secondary">
              <h3 class="card-title">Datos de la Especie</h3>
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
                    <label>ID</label>
                    <input type="text" disabled class="form-control" value="{{ $species->id }}" />
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" disabled class="form-control" value="{{ $species->name }}" />
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Apellido</label>
                    <input type="text" disabled class="form-control" value="{{ $species->description }}" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>
