<div class="modal fade" id="newCityModal" tabindex="-1" role="dialog" aria-labelledby="newCityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCityModalLabel">Datos de ciudad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formNewCity">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Ciudad: </label>
                            <select class="form-control mb-2" id="newCitySelectCity" required>
                                <option value="" selected disabled>Elija una opción</option>
                                <option value="28082">Guadalajara</option>
                                <option value="48153">CDMX</option>
                                <option value="12905">Monterrey</option>
                                <option value="28852">Puebla</option>
                                <option value="28945">Queretaro</option>
                                <option value="48121">San Luis Potosi</option>
                            </select>
                            <label>Dirección: </label><input class="form-control mb-2" type="text" id="newCityAddress">
                            <label>Código postal: </label><input class="form-control mb-2" type="number" id="newCityPostalCode">
                            <label>Persona de contacto: </label><input class="form-control mb-2" type="text" id="newCityContact">
                        </div>
                        <div class="col-lg-6">
                            <label>Correo electrónico: </label><input class="form-control mb-2" type="email" id="newCityEmail">
                            <label>Teléfono: </label><input class="form-control mb-2" type="number" id="newCityPhone">
                            <label>Celular: </label><input class="form-control mb-2" type="number" id="newCityCellPhone">
                            <label>Sitio Web: </label><input class="form-control mb-2" type="text" id="newCityWebSite">
                            <input class="form-control mb-2" type="hidden" id="newCityProviderId">
                        </div>
                        <div class="col-lg-12 text-center mt-3">
                            <span>
                                <b>NOTA: </b>
                                Si quiere dar de alta una nueva ciudad solo debe seleccionarla y dar click en guardar <br>(puede o no completar los datos extra).<br>
                                "Las ciudades ya registradas para este proveedor le mostrarán la información perteneciente a ella".
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="saveNewCity">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>