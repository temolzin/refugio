<!-- Modal -->
<div class="modal fade" id="edit{{$users->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EDITAR USUARIO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('users.update', $users->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
      <div class="modal-body">
        <div class="mb-3">
            <label for="" class="form-label">NOMBRE</label>
            <input
                type="text"
                class="form-control  @error('name') is-invalid @enderror"
                name="name"
                id=""
                aria-describedby="helpId"
                placeholder=""
                value="{{$users->name}}"
            />
            @error('name')
            <span class="invalid-feedback">
              <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">APELLIDO PATERNO</label>
            <input
                type="text"
                class="form-control @error('last_name') is-invalid @enderror"
                name="last_name"
                id=""
                aria-describedby="helpId"
                placeholder=""
                value="{{$users->last_name}}"
            />
            @error('last_name')
            <span class="invalid-feedback">
              <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">APELLIDO MATERNO</label>
            <input
                type="text"
                class="form-control  @error('maternal_lastName') is-invalid @enderror"
                name="maternal_lastName"
                id=""
                aria-describedby="helpId"
                placeholder=""
                value="{{$users->maternal_lastName}}"
            />
            @error('maternal_lastName')
            <span class="invalid-feedback">
              <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">TELEFONO</label>
            <input
                type="text"
                class="form-control  @error('phone') is-invalid @enderror"
                name="phone"
                id=""
                aria-describedby="helpId"
                placeholder=""
                value="{{$users->phone}}"
            />
            @error('phone')
            <span class="invalid-feedback">
              <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">EMAIL</label>
            <input
                type="text"
                class="form-control  @error('email') is-invalid @enderror"
                name="email"
                id=""
                aria-describedby="helpId"
                placeholder=""
                value="{{$users->email}}"
            />
            @error('email')
            <span class="invalid-feedback">
              <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">CONTRASEÑA</label>
            <input
                type="text"
                class="form-control  @error('password') is-invalid @enderror"
                name="password"
                id=""
                aria-describedby="helpId"
                placeholder=""
                value="{{$users->password}}"
            />
            @error('password')
            <span class="invalid-feedback">
              <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
        <button type="submit" class="btn btn-primary">GUARDAR</button>
      </div>
      </form>
    </div>
  </div>
</div>

