@extends('provider.layout')
@section('head')
    <link rel="stylesheet" href="{{asset('css/provider/escaparate.css')}}">
@endsection
@section('content')
    @include('provider.submenu')
    <div class="container">
        <div class="row justify-content-center pt-5">
            <h1 class="font-weight-bold w-100 text-center">Promociones</h1>
            {{-- <h5 class="text-center description">
                En este apartado aparecerán sus pagos de stand para Bride Weekend Expo.
            </h5> --}}
        </div>
        <div class="row card bg-gray-100 mt-4 pt-3 pb-4">
            <div class="col-lg-12 mt-3 text-center mb-3">
                <h3>Fechas y Horarios de atención</h3>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="checks" value="Sunday" id="check1"  @if ($days[0] == 'Sunday') checked @endif>
                        <label class="form-check-label" for="check1">
                            Domingo
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="checks" value="Monday" id="check2"  @if ($days[1] == 'Monday') checked @endif>
                        <label class="form-check-label" for="check2">
                            Lunes
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="checks" value="Tuesday" id="check3"  @if ($days[2] == 'Tuesday') checked @endif>
                        <label class="form-check-label" for="check3">
                            Martes
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="checks" value="Wednesday" id="check4"  @if ($days[3] == 'Wednesday') checked @endif>
                        <label class="form-check-label" for="check4">
                            Miércoles
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="checks" value="Thursday" id="check5"  @if ($days[4] == 'Thursday') checked @endif>
                        <label class="form-check-label" for="check5">
                            Jueves
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="checks" value="Friday" id="check6"  @if ($days[5] == 'Friday') checked @endif>
                        <label class="form-check-label" for="check6">
                            Viernes
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="checks" value="Saturday" id="check7"  @if ($days[6] == 'Saturday') checked @endif>
                        <label class="form-check-label" for="check7">
                            Sábado
                        </label>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-4 mt-4 text-center">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text">De:</span>
                        </div>
                        @if (isset($schedules->schedules))
                            <input type="time" class="form-control" id="initialTime" value="<?= substr($schedules->schedules, 0, 5) ?>">
                        @else
                            <input type="time" class="form-control" id="initialTime">
                        @endif
                        <div class="input-group-prepend">
                        <span class="input-group-text">a:</span>
                        </div>
                        @if (isset($schedules->schedules))
                            <input type="time" class="form-control" id="finalTime" value="<?= substr($schedules->schedules, 6, 5) ?>">
                        @else
                            <input type="time" class="form-control" id="finalTime">
                        @endif
                    </div>
                    <button class="btn bg-pink-400 text-white" id="saveSchedules">Guardar</button>
                </div>
            </div>
            <div class="col-lg-12 mt-3 text-center mb-3 mt-5">
                <h3>Crear promoción</h3>
            </div>
            <input type="hidden" value="{{URL::asset('')}}" id="URL">
            <form class="row pl-4 pr-4" id="formPromotions">
                <div class="col-lg-6 mt-3">
                    <label>Nombre de la promoción:</label>
                    <input class="form-control mb-2" type="text" id="name" required>
                    <label>Categoría:</label>
                    <select class="form-control mb-2" id="category" required>
                        <option value="" selected disabled>Elija una categoría</option>
                        @foreach ($categories as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                    <label>Precio sin descuento:</label>
                    <input class="form-control mb-2" type="number" id="price_initial" required>
                    <label>Precio con descuento:</label>
                    <input class="form-control mb-2" type="number" id="price_final" required>
                    <label>¿Cuándo termina?:</label>
                    <input class="form-control mb-2" type="date" id="date" required>
                    <label>Direcciones de sucursales: <span class="text-blue pointer" id="moreAddress">Nueva <i class="fas fa-plus"></i></span></label>
                    <div class="row pl-3 pr-3" id="divAddress">
                        <input class="form-control mb-2" type="text" id="address1" placeholder="Ingrese una dirección" required>
                    </div>
                </div>
                <div class="col-lg-6 mt-3">
                    <label>Descripción de la promoción:</label>
                    <textarea class="form-control mb-2" id="description" rows="6" required></textarea>
                    <label>Imágenes:</label>
                    <div class="col-lg-12 upload rounded pt-5 pb-5 mb-4" id="upload">
                        <text class="text-upload" div="drop">
                            <i class="fa fa-upload fa-2x valign "></i><br>
                            Suelte los archivos o haga click en el recuadro para cargar.
                        </text>
                    </div>
                </div>
                <div class="col-lg-12 mt-3 text-center">
                    <button class="btn bg-pink-400 text-white" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/dropzone.js')}}"></script>
    <script src="{{asset('js/provider/promociones.js')}}"></script>
@endsection