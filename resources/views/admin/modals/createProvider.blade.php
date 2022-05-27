<div class="modal fade" id="createProvider" tabindex="-1" role="dialog" aria-labelledby="createProviderLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProviderLabel">Datos del proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formProvider">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Nombre: </label><input class="form-control mb-2" type="text" id="modalName" required>
                            <label>Categoría: </label>
                            <select class="form-control mb-3" id="category" required>
                                <option value="" selected disabled>Elija una categoría</option>
                                @foreach ($categories as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                            <label>Descripción: </label><textarea class="form-control mb-2" id="description" rows="8"></textarea>
                        </div>
                        <div class="col-lg-4">
                            <label>Correo (usuario): </label><input class="form-control mb-2" type="text" id="modalUser" required>
                            <label>Contraseña: </label><input class="form-control mb-2" type="password" id="modalPassword" required>
                            <label>Confirmar contraseña: </label><input class="form-control mb-2" type="password" id="modalCPassword" required>
                            <label>Ciudad: </label>
                            <select class="form-control mb-3" id="selectCity" required>
                                <option value="" selected disabled>Elija una opción</option>
                                <option value="28082">Guadalajara</option>
                                <option value="48153">CDMX</option>
                                <option value="12905">Monterrey</option>
                                <option value="28852">Puebla</option>
                                <option value="28945">Queretaro</option>
                                <option value="48121">San Luis Potosi</option>
                            </select>
                            <label>Dirección </label><input class="form-control mb-2" type="text" id="address">
                        </div>
                        <div class="col-lg-4">
                            <label>Código postal: </label><input class="form-control mb-2" type="text" id="postalCode">
                            <label>Persona de contacto: </label><input class="form-control mb-2" type="text" id="contact">
                            <label>Teléfono: </label><input class="form-control mb-2" type="number" id="phone">
                            <label>Celular: </label><input class="form-control mb-2" type="number" id="cellphone">
                            <label>Correo (contacto): </label><input class="form-control mb-2" type="email" id="email">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="saveUser">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>