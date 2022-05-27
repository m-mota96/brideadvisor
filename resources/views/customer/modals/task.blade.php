<!-- Modal -->
<div class = "modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="exampleModalCenter{{$task->id}}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Planea tu boda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('saveTask')}}">
                @csrf
            <div class="modal-body">
                    <input type="hidden" value="{{$task->id}}" name="id">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="status" id="status" {{ ($task->completed_at)  ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Marcar como terminada</label>
                    </div>
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date" value="{{$task->date}}" class="form-control" name="date" id="fecha" aria-describedby="fechaHelp">
                        <small id="fechaHelp" class="form-text text-muted">Ingresa la fecha planeada para esta tarea.</small>
                    </div>
                    <div class="form-group">
                        <label for="comentario">Comentario</label>
                        <textarea class="form-control" id="comentario" name="comment" rows="3">
                            {{$task->comment}}
                        </textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-pink-300">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
