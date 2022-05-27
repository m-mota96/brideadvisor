<div class="modal fade" id="modalCreateEvent" tabindex="-1" role="dialog" aria-labelledby="modalCreateEventLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateEventLabel">Crear evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('createEvent')}}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            {{ csrf_field() }}
                            <label>Nombre: </label><input class="form-control mb-3" type="text" name="nameEvent" required>
                            <label>Tipo de evento: </label>
                            <select class="form-control mb-3" name="selectType" id="selectType" required>
                                <option value="" selected disabled>Elija una opción</option>
                                @foreach ($type as $ty)
                                    <option value="{{$ty->id}}">{{$ty->type}}</option>
                                @endforeach
                            </select>
                            <label>Ciudad: </label>
                            <select class="form-control mb-3" name="selectCity" required>
                                <option value="" selected disabled>Elija una opción</option>
                                <option value="28082">Guadalajara</option>
                                <option value="48153">CDMX</option>
                                <option value="12905">Monterrey</option>
                                <option value="28852">Puebla</option>
                                <option value="28945">Queretaro</option>
                                <option value="48121">San Luis Potosi</option>
                                <option value="48155">Dallas</option>
                                <option value="48156">Houston</option>
                                <option value="48157">Los Angeles</option>
                                <option value="48154">New York</option>
                                <option value="48158">Chicago</option>
                            </select>
                            <label>Recinto: </label>
                            <select class="form-control mb-3" name="selectEnclosure" required>
                                <option value="" selected disabled>Elija una opción</option>
                                @foreach ($enclosure as $enc)
                                    <option value="{{$enc->id}}">{{$enc->name}}</option>
                                @endforeach
                            </select>
                            <label>Quien organiza: </label>
                            <select class="form-control mb-3" name="selectOrganized" required>
                                <option value="" selected disabled>Elija una opción</option>
                                <option value="plexon">Grupo Plexon</option>
                                <option value="externo">Externo</option>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label>Precio del boleto: </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">$</span>
                                </div>
                                <input type="text" class="form-control" name="priceTicket">
                                <div class="input-group-append">
                                  <span class="input-group-text">.00</span>
                                </div>
                            </div>
                            <label>Fecha inicial: </label><input class="form-control mb-3" type="date" name="initialDate">
                            <label>Fecha final: </label><input class="form-control mb-3" type="date" name="finalDate">
                            <label>Horario (fecha inicial): </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">De </span>
                                </div>
                                <input type="time" class="form-control" name="entrySat">
                                <div class="input-group-append">
                                  <span class="input-group-text"> a </span>
                                </div>
                                <input type="time" class="form-control" name="exitSat">
                            </div>
                            <label>Horario (fecha final): </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">De </span>
                                </div>
                                <input type="time" class="form-control" name="entrySun">
                                <div class="input-group-append">
                                  <span class="input-group-text"> a </span>
                                </div>
                                <input type="time" class="form-control" name="exitSun">
                            </div>
                        </div>
                        <div class="col-lg-4" id="treeColumn">
                            <label>Imágen principal:</label>
                            <input class="mb-4" type="file" name="imagePrincipal" accept=".png, .jpg">
                            <label>Imágen para PDF:</label>
                            <input class="mb-4" type="file" name="imagePdf" accept=".png, .jpg">
                            <label>Imágen de correos:</label>
                            <input class="mb-4" type="file" name="imageEmail" accept=".png, .jpg">
                            <label>Activar evento: </label>
                            <div class="col-lg-6 pl-4">
                                <input class="form-check-input" type="radio" name="radioActive" id="radioYes" value="1" checked>
                                <label class="form-check-label mr-5 mb-4" for="radioYes">
                                    Si
                                </label>
                                <input class="form-check-input" type="radio" name="radioActive" id="radioNo" value="0">
                                <label class="form-check-label mb-4" for="radioNo">
                                    No
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="saveUser">Crear evento</button>
                </div>
            </form>
        </div>
    </div>
</div>