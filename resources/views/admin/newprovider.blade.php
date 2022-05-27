@extends('admin.layout')
@section('heads')
    <link rel="stylesheet" href="{{asset('datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/admin.css')}}">
@endsection
@section('content')
    <h2 class="mt-4">Proveedores</h2>
    <div class="row card ml-1 p-3 mr-2">
        <input type="hidden" value="{{URL::asset('')}}" id="URL">
        <p class="col-lg-1 btn btn-primary mb-5" id="btncreate">Nuevo</p>
        <table class="table table-striped text-center" id="providersTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ciudades</th>
                    <th scope="col">Galería</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
          </table>
          @include('admin.modals.createProvider')
          @include('admin.modals.newCity')
    </div>
@endsection
@section('scripts')
    <script src="{{asset('datatables/datatables.js')}}"></script>
    <script src="{{asset('js/admin/createProvider.js')}}"></script>
@endsection