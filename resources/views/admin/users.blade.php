@extends('admin.layout')
@section('heads')
    <link rel="stylesheet" href="{{asset('datatables/datatables.min.css')}}">
@endsection
@section('content')
    <h2 class="mt-4">Usuarios</h2>
    <div class="row card ml-1 p-3 mr-2">
        <input type="hidden" value="{{URL::asset('')}}" id="URL">
        <table class="table table-striped" id="usersTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
          </table>
          @include('admin.modals.user')
    </div>
@endsection
@section('scripts')
    <script src="{{asset('datatables/datatables.js')}}"></script>
    <script src="{{asset('js/admin/users.js')}}"></script>
@endsection