<!-- Modal -->
<div class="modal fade" id="delete{{$shelterMember->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header bg-danger">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar miembro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('shelterMember.destroy',$shelterMember->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
      <div class="modal-body text-center text-danger">
    ¿Estás seguro de eliminar al miembro <strong>{{$shelterMember->name}}?</strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger">Confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>
