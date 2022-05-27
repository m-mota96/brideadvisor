@extends('admin.layout')
@section('heads')
    <link rel="stylesheet" href="{{asset('datatables/datatables.min.css')}}">
@endsection
@section('content')
    <h2 class="mt-4">Staff de exposiotres</h2>
    <div class="row card ml-1 p-3 mr-2">
        <input type="hidden" value="{{URL::asset('')}}" id="URL">
        <select class="col-lg-4 form-control offset-lg-4" id="events">
            <option value="" selected disabled>Elija un evento</option>
            @foreach ($events as $ev)
                <option value="{{$ev->id}}">{{$ev->name.' '.$ev->city->city.' ('.$ev->initial_date.')'}}</option>
            @endforeach
        </select>
        <br><br>
        <table class="table table-striped" id="providersTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Cantidad de personal</th>
                    <th scope="col">Enviar correo</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('datatables/datatables.js')}}"></script>
    <script src="{{asset('js/admin/staff.js')}}"></script>
@endsection