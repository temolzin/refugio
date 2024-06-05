<!-- Modal -->
<div class="modal fade" id="edit{{$users->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="card-warning">
        <div class="card-header">
          <div class="d-sm-flex align-items-center justify-content-between">
            <h4 class="card-title">Editar usuario<small> &nbsp;(*) Campos requeridos</small></h4>
            <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
        </div>
        <form action="{{route('users.update', $users->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="card-body">
            <div class="card">
              <div class="card-header py-2 bg-secondary">
                <h3 class="card-title">Datos del Usuario</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fa fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="" class="form-label">Nombre(*)</label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" aria-describedby="helpId" placeholder="" value="{{$users->name}}" required/>
                      @error('name')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="" class="form-label">Apellido(*)</label>
                      <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name"  aria-describedby="helpId" placeholder="" value="{{$users->last_name}}" required/>
                      @error('last_name')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="form-group">
                      <label for="" class="form-label">Telefono (*)</label>
                      <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"  aria-describedby="helpId" placeholder="" value="{{$users->phone}}"required/>
                      @error('phone')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="" class="form-label">Email (*)</label>
                      <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"  aria-describedby="helpId" placeholder="" value="{{$users->email}}"required/>
                      @error('email')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-warning">Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
