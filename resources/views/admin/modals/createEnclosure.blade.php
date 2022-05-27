<div class="modal fade" id="modalCreateEnclosure" tabindex="-1" role="dialog" aria-labelledby="modalCreateEnclosureLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateEnclosureLabel">Registrar recinto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('createEnclosure')}}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            {{ csrf_field() }}
                            <label>Nombre del recinto: </label><input class="form-control mb-3" type="text" name="nameEnclosure" required>
                            <label>Dirección: </label><input class="form-control mb-3" type="text" name="address" required>
                            <label>Descripción: </label><input class="form-control mb-3" type="text" name="description">
                        </div>
                        <div class="col-lg-6">
                            <label>Mapa (<a href="https://www.google.com.mx/maps" target="_blank">Google Maps</a>):</label>
                            <input class="form-control mb-3" type="text" name="map">
                            <label>Imágen del recinto: </label><input class="mb-4" type="file" name="imgEnclosure" accept=".png, .jpg" required>
                            <label>Logo del recinto: </label><input class="mb-4" type="file" name="imgLogo" accept=".png, .jpg" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="saveUser">Crear recinto</button>
                </div>
            </form>
        </div>
    </div>
</div>