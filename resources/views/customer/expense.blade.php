@extends('layouts.app')
@section('title', ' Presupuestador')
@push('styles')
    <link href="{{ asset('css/customer/expense.css') }}" rel="stylesheet">
@endpush
@section('content')
    <section id="tabs" class="project-tab">
            <div class="row">
                <div class="col-md-12">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Presupuestador</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Proveedores</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <p class="text-center pt-2">Manten el control de tus gastos y tu presupuesto total</p>
                            {{-- Costo total --}}
                            <div class="row justify-content-center">
                                <div class="col-sm-3  mx-3 col-md-2">
                                    <x-progress_circle data-percentage="{{$percentageCost}}" style="width: 150px; height: 150px">
                                            <img class="" style="width: 25%" src="{{asset('Iconos/Presupuesto02.png')}}" alt="">
                                            <p class="mb-0">COSTO TOTAL</p>
                                            <p class="budget"><b>${{$expenseStat['costo']}}</b></p>

                                    </x-progress_circle>
                                </div>
                                {{-- Monto Pagado --}}
                                <div class="col-sm-3  mx-3 col-md-2">
                                    <x-progress_circle data-percentage="{{$percentagePayed}}" style="width: 150px; height: 150px">
                                            <img class="" style="width: 25%; color: #6c757d" src="{{asset('Iconos/navbar/Presupuesto.png')}}" alt="">
                                            <p class="mb-0">MONTO PAGADO</p>
                                            <p class=""><b>${{$expenseStat['pagado']}}</b></p>

                                    </x-progress_circle>
                                </div>
                            </div>
                            <p class="text-center col pt-4">Establece un monto máximo</p>
                            <div class="row justify-content-center">
                                <input id="amount" type="number" min="15000" class="form-control col-md-2 @error('amount') is-invalid @enderror" name="email" value="{{$budget}}" value="" required autocomplete="amount" autofocus>
                            </div>

                            {{-- Table --}}
                            <hr>
                            <div class="row" id="gastos">
                                <div class="col-6">
                                    <h3 class="">Control de gastos</h3>
                                    <p>Total de gastos: {{$expenseStat['countCost']}} | Pagados: {{$expenseStat['countPayed']}} </p>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="qt" class="col-md-4 col-form-label text-md-right">{{ __('Mostrar') }}</label>

                                        <div class="col-md-4">
                                            <select id="qt" name="qt" class="form-control">
                                                <option disabled selected>Todo</option>
                                            </select>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <button data-toggle="modal" data-target="#exampleModalCenter" class="btn bg-pink-300" type="submit">Añadir gasto</button>
                                    </div>

                                </div>
                            </div>
                            <x-card>
                                <table class="table table-sm table-responsive ">
                                    <tr class="bg-pink-200">
                                        <td class="w-50">CONCEPTO</td>
                                        <td>COSTO</td>
                                        <td>PAGADO</td>
                                        <td></td>
                                    </tr>
                                    @foreach($expenses as $expense)
                                        <form method="post" action="{{ route('saveExpense') }}">
                                            @csrf
                                    <tr>
                                        <td class="">{{$expense->concept}}</td>
                                        <td class=" cost"><input class="form-control" type="text" value="{{$expense->pivot->cost}}" name="cost" id="cost{{$expense->id}}"></td>
                                        <td class=" payed"><input class="form-control" type="text"  value="{{$expense->pivot->payed}}" name="payed" id="payed{{$expense->id}}"></td>
                                        <td class="">
                                            <a class="gasto"><i class="fas fa-ellipsis-h fa-2x float-right text-blue-300"></i>
                                                <input type="hidden" class="id" value="{{$expense->id}}" name="id">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="info info{{$expense->id}}" style="font-size: 11px;">
                                        <td>
                                            <div class="form-group">
                                                <label for="comment{{$expense->id}}">Añadir Comentarios</label>
                                                <textarea name="comment" class="form-control" id="comment{{$expense->id}}" rows="3"></textarea>
                                            </div>
                                        </td>
                                        <td class="py-5">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="urgente{{$expense->id}}">
                                                <label class="form-check-label" for="urgente{{$expense->id}}">Marcar como urgente</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="check{{$expense->id}}">
                                                <label class="form-check-label" for="finalizado{{$expense->id}}">Marcar como finalizado</label>
                                            </div>
                                        </td>
                                        <td  class="ml-2 py-4">
                                            <div>
                                                <i class="fa fa-trash text-red-400"></i>
                                                <button type="submit" class="btn text-red-400" style="font-size: 11px;">
                                                    {{ __('Eliminar Gasto') }}
                                                </button>
                                            </div>
                                            <div>
                                                <i class="fa fa-check-circle pt-4 text-green-400"></i>
                                                <button type="submit" class="btn text-green-400 " style="font-size: 11px;">
                                                {{ __('Guardar Cambios') }}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                        </form>
                                    @endforeach

                                </table>
                            </x-card>
                            <x-modal type="" title="Registrar Gasto">
                                <form method="POST" action="{{route('expense.store')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="concepto">Concepto</label>
                                        <input type="text" name="concept" class="form-control" id="concepto" placeholder="Concepto del gasto">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label for="costo">Costo</label>
                                            <input type="number" name="cost" class="form-control" id="costo" placeholder="Costo del gasto">
                                        </div>
                                        <div class="col-6">
                                            <label for="pagado">Pagado</label>
                                            <input type="number" name="payed" class="form-control" id="pagado" placeholder="Monto pagado">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="comentario">Comentarios</label>
                                        <textarea class="form-control" id="comentario" name="comment" rows="3"></textarea>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="urgente" type="checkbox" id="inlineCheckbox1" value="urgente">
                                        <label class="form-check-label" for="inlineCheckbox1">Marcar como urgente</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input " name="finished" type="checkbox" id="inlineCheckbox2" value="finished">
                                        <label class="form-check-label"  for="inlineCheckbox2">Marcar como finalizado</label>
                                    </div>
                                    <div class="pt-3">
                                        <button type="submit" class="btn bg-pink-300">Guardar</button>
                                    </div>
                                </form>
                            </x-modal>
                        </div>

                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="text-center pt-2">
                                <p>Organiza fácilmente la selección de proveedores para tu boda.</p>
                                <p>¡ Contáctalos y solicita una cotizacíon!</p>
                                <p class="col-md-3 py-2 offset-md-5" style="border: pink 2px solid  " >Proveedores guardados: 0</p>
                            </div>
                            <hr style="border: deeppink solid 1px;">

                                <div class="row">
                                    @foreach($categoryProviders as $categoryProvider)
                                        @php
                                            $icon = str_replace(' ','_',strtolower($categoryProvider->name));
                                        @endphp
                                        <div class="col-md-6 col-lg-3 mb-5 zoom">
                                            <div class="row align-items-center h-100">
                                                <div class=" mx-auto">
                                                    <div class="text-center pt-4" id="inner">
                                                        <p class="mb-0">{{$categoryProvider->name}}</p>
                                                        <img class="" style="width: 30%" src="{{asset('Iconos/'.$icon.'.png')}}" alt="">
                                                        <div><button class="btn btn-light" type="submit"><i class="fas fa-search"></i> Buscar</button></div>
                                                        <p>0 seleccionado</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@push('scripts')
    <script src="{{ asset('js/customer/expense.js') }}" defer></script>
@endpush
@endsection
