<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Datos de usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formUser">
                <div class="modal-body">
                    <input class="form-control" type="hidden" id="modalId" required>
                    <label>Nombre: </label><input class="form-control mb-2" type="text" id="modalName" required>
                    <label>Usuario: </label><input class="form-control mb-2" type="text" id="modalUser" required>
                    <label>Contraseña: </label><input class="form-control mb-2" type="password" id="modalPassword">
                    <label>Confirmar contraseña: </label><input class="form-control mb-2" type="password" id="modalCPassword">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="saveUser">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>