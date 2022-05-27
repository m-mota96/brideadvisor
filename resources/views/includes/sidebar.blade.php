<div class="modal right fade in" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <form method="post" action="{{route('add.guest')}}">
                    @csrf
                <h1>Agregar Invitado</h1>
                <hr>
                <div class="form-row mb-3">
                    <div class="col-6">
                        <input class="form-control" name="firstname" type="text" placeholder="Nombre">
                    </div>
                    <div class="col-6">
                        <input class="form-control" name="lastname" type="text" placeholder="Apellido">
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="col-6">
                        <input class="form-control" name="cellphone" type="text" placeholder="telefono">
                    </div>
                    <div class="col-6">
                        <div>
                            <input class="form-control" name="email" type="text" placeholder="correo">
                        </div>
                    </div>
                </div>
                    <div class="col-12 py-2">
                        <input class="form-control" name="group" type="text" placeholder="Nombre del grupo">
                    </div>

                <div class="bg-gray-200 mb-3">
                    <span class="btn" id="btn-add"><i class="fas fa-plus-circle"></i> Agregar acompañante</span>
                </div>
                <div id="wrapper">


                </div>

                <div class="row">
                    <div class="col-6 offset-3">
                    <button type="submit" class="form-control bg-pink-400">Guardar</button>
                    </div>
                </div>
                </form>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->
</div>
