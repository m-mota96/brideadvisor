@extends('provider.layout')
@section('head')
    <link rel="stylesheet" href="{{asset('css/provider/escaparate.css')}}">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center pt-5">
            <h1 class="font-weight-bold w-100 text-center">Mis pagos</h1>
            <h5 class="text-center description">
                En este apartado aparecerán sus pagos de stand para Bride Weekend Expo.
            </h5>
        </div>
        <div class="col-lg-6 offset-lg-3 card bg-gray-100 mt-4 p-0">
            <table class="table table-striped text-center w-100">
                <thead>
                    <tr>
                        <th scope="col">Fecha de pago</th>
                        <th scope="col">Clave</th>
                        <th scope="col">Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $pay)
                        <tr>
                            <td>{{$pay->date_parse}}</td>
                            <td>{{$pay->reference}}</td>
                            <td>${{$pay->amount}}.00</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th></th>
                        <th class="text-green">Total pagado</th>
                        <th class="text-green">${{$total_payed}}.00</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th class="text-orange">Total a pagar</th>
                        <th class="text-orange">${{$key->price}}.00</th>
                    </tr>
                </tbody>
              </table>
        </div>
    </div>
@endsection
@section('scripts')
    
@endsection