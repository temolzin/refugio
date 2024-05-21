<!-- Modal -->
<div class="modal fade" id="view{{ $users->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel{{ $users->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewModalLabel{{ $users->id }}">Información del Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>ID:</strong> {{ $users->id }}</p>
        <p><strong>Nombre:</strong> {{ $users->name }}</p>
        <p><strong>Apellido Paterno:</strong> {{ $users->last_name }}</p>
        <p><strong>Apellido Materno:</strong> {{ $users->maternal_lastName }}</p>
        <p><strong>Teléfono:</strong> {{ $users->phone }}</p>
        <p><strong>Email:</strong> {{ $users->email }}</p>
        <p><strong>Contraseña:</strong> {{ $users->password }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>