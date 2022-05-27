@extends('admin.layout')
@section('heads')
    <link rel="stylesheet" href="{{asset('datatables/datatables.min.css')}}">
@endsection
@section('content')
    <h2 class="mt-4">Eventos</h2>
    <div class="row card ml-1 p-3 mr-2">
        <input type="hidden" value="{{URL::asset('')}}" id="URL">
        <button class="btn btn-primary col-lg-1" id="btnCreate">Crear</button>
        <br><br>
        <table class="table table-striped" id="eventsTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col"></th>
                    <th scope="col">Fecha inicial</th>
                    <th scope="col">Fecha final</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
          </table>
          @include('admin.modals.createEvents')
    </div>
@endsection
@section('scripts')
    <script src="{{asset('datatables/datatables.js')}}"></script>
    <script src="{{asset('js/admin/createEvents.js')}}"></script>
@endsection