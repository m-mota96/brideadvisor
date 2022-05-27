@extends('layouts.app')
@section('title', ' Dashboard')
@push('styles')
    <link href="{{ asset('css/customer/index.css') }}" rel="stylesheet">
@endpush
@section('content')
    <x-card class="row">
        <div class="col-md-6 p-0 bg-pink-200 m-0">
            <img class="" style="max-width: 102%; border-top-right-radius: 120px; border-bottom-right-radius: 120px;" src="{{asset('media/content/customer/couple-home.jpg')}}">
        </div>
        <div class="col-md-6 text-center">
            <h1 class=" mt-4">{{$customerTasks->girlfriend_name}} & {{$customerTasks->boyfriend_name}}</h1>
            <hr class=" w-50 bg-pink-400">
            <p><i class="fas fa-calendar-week text-pink-200"></i> {{$date->day ?? ''}} de {{$date->monthName ?? ''}} {{$date->year ?? ''}}</p>
            <p><i class="fas fa-map-marker-alt text-pink-200"></i> {{$wedding->place ?? ''}}</p>
            <p><i class="fas fa-link text-pink-200"></i> <a href="#">https://brideadvisor.com/{{$customerTasks->girlfriend_name }}</a></p>
                <span class="shadow p-3 mb-5 bg-dark text-white">FALTAN: <span class="h3">{{$diff ?? ''}}</span> DÍAS</span>
        </div>
    </x-card>

    <h1 class="text-center">Tu Progreso</h1>
    <hr class="mb-0 pb-0 w-50" style="border: 2px solid deeppink">
    <div class="pb-4 d-flex justify-content-center ">
        <x-card class="row col-md-10 d-flex justify-content-around pt-2">
            <div>
                <x-progress_circle class="justify-content-md-center" data-percentage="10" style="width: 100px; height: 100px">
                    <div class="">
                        <h4 class="mb-0">50%</h4>
                        <i class="fas fa-arrow-right text-black-50"></i>
                    </div>
                </x-progress_circle>
                <p class="text-center">Checklist</p>
            </div>
            <div>
                <x-progress_circle class="justify-content-md-center" data-percentage="10" style="width: 100px; height: 100px">
                    <div class="">
                        <h4 class="mb-0">50%</h4>
                        <i class="fas fa-arrow-right text-black-50"></i>
                    </div>
                </x-progress_circle>
                <p class="text-center">Control de Invitados</p>
            </div>
            <div>
                <x-progress_circle class="justify-content-md-center" data-percentage="60" style="width: 100px; height: 100px">
                    <div class="">
                        <h4 class="mb-0">50%</h4>
                        <i class="fas fa-arrow-right text-black-50"></i>
                    </div>
                </x-progress_circle>
                <p class="text-center">Mi web</p>
            </div>
            <div>
                <x-progress_circle class="justify-content-md-center" data-percentage="50" style="width: 100px; height: 100px">
                    <div class="">
                        <h4 class="mb-0">50%</h4>
                        <i class="fas fa-arrow-right text-black-50"></i>
                    </div>
                </x-progress_circle>
                <p class="text-center">Optimización de presupuesto</p>
            </div>
            <div>
                <x-progress_circle class="justify-content-md-center" data-percentage="90" style="width: 100px; height: 100px">
                    <div class="">
                        <h4 class="mb-0">50%</h4>
                        <i class="fas fa-arrow-right text-black-50"></i>
                    </div>
                </x-progress_circle>
                <p class="text-center">Mesa de regalos</p>
            </div>
        </x-card>
    </div>

    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <x-card class="checklist">
                <h4 class="w-50 shadow text-center bg-pink-300 p-2 text-white" style="border-top-right-radius: 50rem; border-bottom-right-radius: 50rem;">CHECKLIST</h4>

            <div class="justify-content-md-center ml-2 pt-4">
                @foreach($customerTasks->tasks as $task)
                    <div class="row">
                        <div class="col-md-10">

                            @if($task->pivot->completed_at)
                                <i class="fas fa-check-circle mr-3"></i>
                            @else
                                <i class="far fa-circle mr-3"></i>
                            @endif
                                {{$task->name}}
                        </div>
                        <div class="col-md-2 mb-1">
                        <i class="col-md-2 fas fa-arrow-right"></i>
                        </div>
                    </div>
                    @break($task->id == 6)
                @endforeach
            </div>

                <div class="offset-md-4 pb-3"><a href="{{ route('customer.checklist')}}" ><u>Ver todas mis tareas</u></a></div>
            </x-card>
            <br>
            <x-card class="slide">
                <h4 class="w-75 shadow text-center bg-pink-300 p-2 text-white" style="border-top-right-radius: 50rem; border-bottom-right-radius: 50rem;">EXPLORAR PROVEEDORES</h4>
                @include('customer.carousel')
                <div class="offset-md-4 pb-3 pt-4"><a href="#" ><u>Ver todas las categorias</u></a></div>
            </x-card>
            <br>
            <x-card class="style">
                <h4 class="w-75 shadow text-center bg-pink-300 p-2 text-white" style="border-top-right-radius: 50rem; border-bottom-right-radius: 50rem;">ESTILO DE MI BODA</h4>
                <div class="row py-4 justify-content-center" style="font-size:12px">
                        <div class="mr-4">
                            <button type="button" class="btn btn-light btn-circle btn-xl "><i class="fas fa-plus fa-xs text-black-50"></i></button>
                            <p class="text-center">COLOR</p>
                        </div>
                        <div class="mr-4">
                            <button type="button" class="btn btn-light btn-circle btn-xl "><i class="fas fa-plus fa-xs text-black-50"></i></button>
                            <p class="text-center">VESTIDO</p>
                        </div>
                        <div class="mr-4">
                            <button type="button" class="btn btn-light btn-circle btn-xl "><i class="fas fa-plus fa-xs text-black-50"></i></button>
                            <p class="text-center">TEMPORADA</p>
                        </div>
                        <div class="mr-2">
                            <button type="button" class="btn btn-light btn-circle btn-xl "><i class="fas fa-plus fa-xs text-black-50"></i></button>
                            <p class="text-center">AMBIENTACIÓN</p>
                        </div>
                        <div class="">
                            <button type="button" class="btn btn-light btn-circle btn-xl "><i class="fas fa-plus fa-xs text-black-50"></i></button>
                            <p class="text-center">LUNA DE MIEL</p>
                        </div>

                </div>
            </x-card>
        </div>

        <div class="col-md-5">
            <x-card class=" shadow bg-white">
                <h4 class="text-center pt-2 text-pink-300"><b><u>Presupuesto</u></b></h4>
                <div class="d-flex justify-content-md-center">
                        <div class="col-sm-3  mx-2 col-md-6">
                            <x-progress_circle data-percentage="0" style="width: 150px; height: 150px">
                                <img class="" style="width: 25%" src="{{asset('Iconos/Presupuesto02.png')}}" alt="">
                                <p class="mb-0">COSTO TOTAL</p>
                                <p class="budget"><b>${{$expenseStat['costo']}}</b></p>
                            </x-progress_circle>
                        </div>
                        {{-- Monto Pagado --}}
                        <div class="col-sm-3  mx-2 col-md-6">
                            <x-progress_circle data-percentage="0" style="width: 150px; height: 150px">
                                <img class="" style="width: 25%; color: #6c757d" src="{{asset('Iconos/navbar/Presupuesto.png')}}" alt="">
                                <p class="mb-0">MONTO PAGADO</p>
                                <p class=""><b>${{$expenseStat['pagado']}}</b></p>
                            </x-progress_circle>
                        </div>
                </div>
                <div class="offset-md-4 pb-3"><a href="{{route('customer.expense')}}" >Actualizar presupuesto</a></div>
            </x-card>
            <br>
            <x-card class="gift">
                <h4 class="text-center pt-2 text-pink-300"><b><u>Mesa de regalo</u></b></h4>
                <div><img class="" style="max-width: 100%;" src="{{asset('media/content/customer/couple-beach-home.jpg')}}">
                </div>
                <div class="text-center">
                    <h1 class="m-0">$ 7000 </h1>
                    <p class="">Hasta ahora</p>
                </div>
                <div class="offset-md-2 pb-3"><a href="#" >Comparte tu mesa de regalo con tus invitados</a></div>
            </x-card>

            <br>

            <x-card class="app">
                <img class="" style="max-width: 100%;" src="{{asset('media/content/customer/descarga-app-home.jpg')}}">
            </x-card>
        </div>
    </div>
@push('scripts')
    <script src="{{ asset('js/customer/index.js') }}" defer></script>
@endpush
@endsection
